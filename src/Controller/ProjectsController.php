<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Routing\Annotation\Route;

class ProjectsController extends AbstractController
{
    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    /**
     * @Route("/projects", name="homepage", methods={"GET"})
     */
    public function projectsPage()
    {
        return $this->render('projects/home.html.twig', ['user' => $this->security->getUser()]);
    }
}