<?php


namespace AppBundle\Controller;


class StaticController extends SiteBaseController
{
    public function officesAction()
    {
        return $this->render(':site:offices.html.twig');
    }
}