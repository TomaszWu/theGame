<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Envelopes;
use Symfony\Component\HttpFoundation\RedirectResponse;

class EnvelopesController extends Controller {

    public function chooseTheEnvelopeAction(Request $request) {
        $value = ['1', '2', '3', '4', '5'];

        $form = $this->createFormBuilder()
                ->add('Koperta', 'choice', [
                    'choices' => $value,
                    'expanded' => true
                ])
                ->add('envelope', 'submit', array('label' => 'Wybierz kopertę'))
                ->getForm();
        
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            return new RedirectResponse($this->generateUrl('game_get_question'));
        }

        return $this->render("@App/Envelopes/chooseTheEnvelope.html.twig", ['form' => $form->createView()]);
    }

}
