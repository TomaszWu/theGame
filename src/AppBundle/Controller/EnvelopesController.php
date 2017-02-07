<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Envelopes;

class EnvelopesController extends Controller {

    public function chooseTheEnvelopeAction(Request $request) {
        $value = ['100', '200', '300', '400', '500'];

        $form = $this->createFormBuilder()
                ->add('Koperta', 'choice', [
                    'choices' => $value,
                    'expanded' => true
                ])
                ->add('envelope', 'submit', array('label' => 'Wybierz kopertę'))
                ->getForm();
        
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            var_dump($_POST);
            echo 'tak';
        }

        return $this->render("@App/Envelopes/chooseTheEnvelope.html.twig", ['form' => $form->createView()]);
    }

}
