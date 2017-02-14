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

    public function drawAQuestionAction(Request $request, $envelopeValue) {
        $gameId = $this->get('session')->get('gameId');
        $game = $this->get('game.model')->getGameById($gameId);
        $alreadyAskedQuestions = $game->getQuestions();
        $arrayOfAlreadyAskedQuestions = $alreadyAskedQuestions->toArray();

        $question = $this->get('question.model')->drawAUnAskedQuestion($arrayOfAlreadyAskedQuestions);
        if ($question) {
            $game->addQuestion($question);
            $this->get('game.model')->save($game);
        } else {
            echo 'end of the game';
        }
//        var_dump($question->getAnswers());exit;


        if ($request->isMethod('POST')) {
//            $answerToCheck = $request->request->get('answerToCheck');
            $answerCorrectnessToCheck = $this->get('answers.model')
                    ->getAnswerById($request->request->get('answerToCheck'));
            if ($answerCorrectnessToCheck->getIsCorrect()) {
                return new JsonResponse(['success' => true]);
            } else {
                return new JsonResponse(['false' => false]);
            }
        }
        return $this->render('@App/Question/question.html.twig', array('question' =>
                    $question, 'envelopeValue' => $envelopeValue));
    }

    function testAction(Request $request) {
        $test = $request->request->get('test');

        return new JsonResponse(['success' => true, 'message' => 'Thank you']);
        
    }
}