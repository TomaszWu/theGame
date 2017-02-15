<?php

namespace AppBundle\Controller;

use AppBundle\Form\EnvelopesType;
use AppBundle\Form\QuestionsType;
use AppBundle\Form\AnswersType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Questions;

class AdminController extends Controller {

    public function indexAction() {
        return $this->render('AppBundle:Admin:default.html.twig');
    }

    public function addEnvelopeAction(Request $request) {
        $form = $this->createForm(new EnvelopesType(), null, [
            'method' => 'POST'
        ]);
        $form->add('submit', 'submit', [
            'attr' => [
                'value' => 'Zapisz'
            ]
        ]);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $this->get('envelope.model')->save($form->getData());

            return new RedirectResponse($this->generateUrl('admin_list_envelope'));
        }
        return $this->render("@App/Admin/envelopeForm.html.twig", ['form' => $form->createView()]);
    }

    public function envelopeListAction() {
        $envelopes = $this->get('envelope.model')->getAllEnvelopes();
        return $this->render('@App/Admin/envelopeList.html.twig', ['envelopes' => $envelopes]);
    }

    public function addQuestionAction(Request $request) {
        $form = $this->createForm(new QuestionsType(), null, [
            'method' => 'POST'
        ]);
        $form->add('submit', 'submit', [
            'attr' => [
                'value' => 'Dodaj pytanie'
            ]
        ]);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $questionId = $this->get('question.model')->save($form->getData());
            return new RedirectResponse($this->generateUrl('admin_add_answer', array('id' => $questionId)));
        }
        return $this->render("@App/Admin/questionForm.html.twig", ['form' => $form->createView()]);
    }

    public function addAnAnswerToTheQuestionAction(Request $request, Questions $question) {
        $form = $this->createForm(new AnswersType(), null, [
            'method' => 'POST'
        ]);
        $form->add('submit', 'submit', [
            'attr' => [
                'value' => 'Dodaj odpowiedź'
            ]
        ])
        ;

        $form->handleRequest($request);
        if ($form->isValid()) {
            $this->get('answers.model')->save($form->getData()->setQuestion($question));
        }

        $previousAnswers = $this->get('answers.model')->getAllAnswersByQuestionId($question);
        if (count($previousAnswers) == 4) {
            return new RedirectResponse($this->generateUrl('admin_list_question'));
        }
        return $this->render("@App/Admin/answerForm.html.twig", ['form' => $form->createView(),
                    'question' => $question, 'previousAnswers' => $previousAnswers,
                    'answerNum' => count($previousAnswers) + 1]);
    }

    public function getAllAnswersByQuestionIdAction(Questions $question) {
        $previousAnswers = $this->get('answers.model')->getAllAnswersByQuestionId($question);
        return $this->render("@App/Admin/showAnswers.html.twig", [ 'previousAnswers' => $previousAnswers ]);
    }

    public function questionListAction() {
        $questions = $this->get('question.model')->getAllQuestion();
        return $this->render('@App/Admin/questionList.html.twig', ['questions' => $questions]);
    }

    public function deleteQuestionAction(Questions $question) {
        $this->get('question.model')->delete($question);
        return new RedirectResponse($this->generateUrl('admin_list_question'));
    }
    
    

}
