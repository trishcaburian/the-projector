<?php
namespace App\Controller;

use App\Model\ProjectsViewModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Routing\Annotation\Route;

class ProjectsController extends AbstractController
{
    private $security;
    private $projectsViewModel;

    public function __construct(Security $security, ProjectsViewModel $projectsViewModel)
    {
        $this->security = $security;
        $this->projectsViewModel = $projectsViewModel;
    }

    /**
     * @Route("/projects", name="homepage", methods={"GET"})
     */
    public function projectsPage()
    {
        $user_object = $this->projectsViewModel->getFirstNameByUserId();
        $available_projects = $this->projectsViewModel->getAllProjects();

        return $this->render('projects/home.html.twig', [
            'user' => $user_object,
            'projects' => $available_projects
        ]);
    }
}