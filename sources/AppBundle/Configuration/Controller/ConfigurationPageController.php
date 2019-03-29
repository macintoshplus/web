<?php
/**
 * @copyright Macintoshplus (c) 2019
 * Added by : Macintoshplus at 29/03/19 22:42
 */

namespace AppBundle\Configuration\Controller;


use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Twig_Environment;
use AppBundle\Configuration\Repository\ConfigRepository;

class ConfigurationPageController
{
    private $twig;
    private $repository;
    private $formFactory;

    public function __construct(Twig_Environment $twig, ConfigRepository $repository, FormFactoryInterface $formFactory)
    {
        $this->twig = $twig;
        $this->repository = $repository;
        $this->formFactory = $formFactory;
    }

    public function __invoke(Request $request)
    {

        $form = $this->formFactory->createBuilder(FormType::class, [])
            ->add('afup_raison_sociale', TextType::class)
            ->getForm()
        ;


        return new Response($this->twig->render(':admin/configuration:index.html.twig', ['title'=> 'Configuration', 'form'=>$form->createView()]));
    }
}
