<?php

namespace Scourgen\PersonFinderBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;


class DefaultController extends Controller
{
//    /**
//     * @Route("/")
//     * @Template()
//     */
    public function indexAction()
    {
//        return $this->render('ScourgenPersonFinderBundle:Default:index.html.twig');
        return array();
    }
}
