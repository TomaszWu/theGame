<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PlayerController extends Controller {

    public function indexAction() {
        return $this->render('AppBundle:User:dashboard.html.twig');
    }

    

}
