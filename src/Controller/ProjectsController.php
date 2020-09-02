<?php
namespace App\Controller;

use App\Data\ProjectData;
use App\Model\ProjectInputModel;
use App\Model\ProjectsViewModel;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use Doctrine\ORM\EntityManagerInterface;

class ProjectsController extends AbstractController
{
    private $security;
    private $entityManager;

    public function __construct(Security $security, EntityManagerInterface $entityManager)
    {
        $this->security = $security;
        $this->entityManager = $entityManager;
    }

    /**
     * @Route("/projects", name="homepage", methods={"GET"})
     */
    public function projectsPage()
    {
        $projects_vm = new ProjectsViewModel($this->entityManager, $this->security);

        return $this->render('projects/home.html.twig', $projects_vm->getHomeViewData());
    }

    /**
     * @Route("/projects/create", name="render_create_project", methods={"GET"})
     */
    public function renderCreateProject()
    {
        return $this->render('projects/create.html.twig');
    }

    /**
     * @Route("/projects/create", name="process_project", methods={"POST"})
     */
    public function processProject(Request $request)
    {
        $project_input_model = new ProjectInputModel($this->entityManager);
        $result = $project_input_model->createProject(new ProjectData($request));

        if ($result->isValid) {
            //redirect to home page, read up on flash session maybe?
        } else {
            //refresh create project site with message above
        }
    }
}