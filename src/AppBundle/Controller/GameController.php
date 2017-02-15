<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use AppBundle\Entity\Game;

class GameController extends Controller {

    public function chooseTheEnvelopeAction() {

        return $this->render("@App/Game/game.html.twig");
    }

//    function testAction(Request $request) {
//        if($request->isMethod('POST')){
//            $test = $request->request->get('test');
//
//            return new JsonResponse(['success' => true, 'message' => 'Thank you']);
//        } else {
//            return $this->render("@App/Game/game.html.twig");
//        }
//    }
    
    
    function startANewGameAction(Request $request){
         $form = $this->createFormBuilder()
                ->add('Zacznij grę', 'submit', array('label' => 'Zacznij grę'))
                ->getForm();
         
         $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $user = $this->getUser();
            $game = new Game;
            $game->setUsers($user);
            $game->setMoney(0);
            $this->get('game.model')->save($game);
            $session = $request->getSession();
            $session->set('gameId', $game->getId());
            $session->set('envelopeValue', 0);
            return new RedirectResponse($this->generateUrl('choose_the_envelope'));
        }
        return $this->render("@App/Game/startANewGame.html.twig", ['form' => $form->createView()]);
    }

}
