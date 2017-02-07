<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction()
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        if($this->isGranted('ROLE_ADMIN',$user)){
            return new RedirectResponse($this->generateUrl('admin_homepage'));
        }
        return new RedirectResponse($this->generateUrl('player_homepage'));
    }
}
