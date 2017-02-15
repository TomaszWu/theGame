<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Aswers;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class AnswersController extends Controller {

//    public function ifAnswerIsCorrect(Request $request, Answers $answers) {
//        
//        if($request->isMethod('POST')){
//            $answerToCheck = $request->request->get('answerToCheck');
//            $answerCorrectnessToCheck = $this->get('answers.model')->getAnswerById($answers);
//            if($answerCorrectnessToCheck){
//                return new JsonResponse(['success' => true]);
//            } else {
//                return new JsonResponse(['false' => false]);
//            }
//        }
//        
//    }

}
