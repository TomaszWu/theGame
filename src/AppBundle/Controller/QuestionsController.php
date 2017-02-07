<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Questions;
use AppBundle\Entity\Answers;
use AppBundle\Model\QuestionModel;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;

class QuestionsController extends Controller {

    public function drawAQuestionAction(Request $request) {
//        $question = $this->get('question.model')->aRandomQuestion();
        $gameId = $this->get('session')->get('gameId');
        $game = $this->get('game.model')->getGameById($gameId);
//
        $questions = $this->get('game.model')->getAlreadyAskedQuestions($game);
        
        $test = $this->get('question.model')->drawAnUnaskedQuestion($questions);
        var_dump($test);
        exit;



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
                    $question));
    }

}
