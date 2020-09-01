<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Routing\Annotation\Route;

class SignInController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @Route("/signin", name="app_login", methods={"GET"})
     */
    public function renderLogin()
    {
        if (!is_null($this->security->getUser())) {
            //redirect to home page
        }

        return $this->render('pages/login.html.twig');
    }
}