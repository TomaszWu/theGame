<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Envelopes;
use AppBundle\Model\EnvelopeModel;
use AppBundle\Model\GameModel;
use AppBundle\Entity\Game;
use Symfony\Component\HttpFoundation\RedirectResponse;

class EnvelopesController extends Controller {

    public function chooseTheEnvelopeAction(Request $request) {
        $envelopesColours = ['Czerwona', 'Zielona', 'Żółta', 'Niebieska', 'Różowa'];
        shuffle($envelopesColours);
        $form = $this->createFormBuilder()
                ->add('Koperty:', 'choice', [
                    'choices' => ($envelopesColours),
                    'expanded' => true
                ])
                ->add('envelope', 'submit', array('label' => 'Wybierz kopertę'))
                ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $gameId = $this->get('session')->get('gameId');
            $game = $this->get('game.model')->getGameById($gameId);
            $choosenEnvelope = new Envelopes;
            $envelopeValue = $this->get('envelope.model')->determineTheValueOfTheEnvelope();
            $session = $request->getSession();
            $alreadyAskedQuestions = $game->getQuestions();
            $arrayOfAlreadyAskedQuestions = $alreadyAskedQuestions->toArray();
            $drawnQuestion = $this->get('question.model')->drawAUnAskedQuestion($arrayOfAlreadyAskedQuestions);
            // all details like questionId and envelope value have to be determine here, otherwise 
            // when the next action was taken and the page page was refreshed it gave the chance to change
            // question or envelope value. 
            $session->set('questionId', $drawnQuestion->getId());
            $choosenEnvelope->setValue($envelopeValue);
            $session->set('choosenEnvelope', $choosenEnvelope);

            return new RedirectResponse($this->generateUrl('game_get_question'));
        }

        return $this->render("@App/Envelopes/chooseTheEnvelope.html.twig", ['form' => $form->createView()]);
    }

}
