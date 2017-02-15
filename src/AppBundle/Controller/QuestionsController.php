<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Questions;
use AppBundle\Entity\Answers;
use AppBundle\Model\QuestionModel;
use AppBundle\Entity\Game;
use AppBundle\Model\GameModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class QuestionsController extends Controller {

    public function drawAQuestionAction(Request $request) {
        $session = $this->get('session');
        $gameId = $session->get('gameId');
        $envelopeValue = $session->get('choosenEnvelope')->getValue();
        $game = $this->get('game.model')->getGameById($gameId);
        $questionId = $session->get('questionId');
        $question = $this->get('question.model')->getQuestionById($questionId);
        $currentWinnings = $this->get('game.model')->checkTheCurrentWinnings($game);
        if ($question) {
        } else {
            echo 'end of the game';
        }
        if ($request->isMethod('POST')) {
//            $answerToCheck = $request->request->get('answerToCheck');
            $answerCorrectnessToCheck = $this->get('answers.model')
                    ->getAnswerById($request->request->get('answerToCheck'));
            if ($answerCorrectnessToCheck->getIsCorrect()) {
                $choosenEnvelope = $session->get('choosenEnvelope');
                $this->get('envelope.model')->save($choosenEnvelope);
                $game->addEnvelope($choosenEnvelope);
                $game->addQuestion($question);
                $this->get('game.model')->save($game);
                return new JsonResponse(['answer' => 'good', 'envelopeValue' => 
                    $envelopeValue, 'currentWinnings' => $currentWinnings]);
            } else {
                return new JsonResponse(['answer' => 'wrong']);
            }
        }


        return $this->render('@App/Question/question.html.twig', array('question' =>
                    $question, 'envelopeValue' => $envelopeValue,
                    'currentWinnings' => $currentWinnings));
    }

    function testAction(Request $request) {
        $test = $request->request->get('test');

        return new JsonResponse(['success' => true, 'message' => 'Thank you']);
    }

}
