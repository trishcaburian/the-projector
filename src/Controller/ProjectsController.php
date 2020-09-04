<?php
namespace App\Controller;

use App\Model\AssignmentInputModel;
use App\Model\ProjectInputModel;
use App\Model\ProjectsViewModel;
use App\Services\ProjectService;
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
    private $projectService;

    public function __construct(Security $security, EntityManagerInterface $entityManager, ProjectService $projectService)
    {
        $this->security = $security;
        $this->entityManager = $entityManager;
        $this->projectService = $projectService;
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
    public function createProjectGet()
    {
        return $this->render('projects/create.html.twig');
    }

    /**
     * @Route("/projects/create", name="process_project", methods={"POST"})
     */
    public function createProjectPost(Request $request)
    {        
        $input_model = new ProjectInputModel($request);
        $result = $this->projectService->createProject($input_model);

        if ($result->isValid) {
            return $this->redirect($this->generateUrl('homepage'));
        }

        return new Response($this->renderView('projects/create.html.twig', ['errors' => $result->getMessages()]));
    }

    /**
     * @Route("/projects/assignments/{id}", name="view_assignments", methods={"GET"})
     */
    public function viewAssignments(int $id)
    {
        $project_view_model = new ProjectsViewModel($this->entityManager, $this->security);

        return $this->render('projects/assignments.html.twig', $project_view_model->getProjectData($id));
    }

    /**
     * @Route("/projects/assign", name="assign_person", methods={"POST"} )
     */
    public function assignPersonCtrl(Request $request)
    {
        $input_model = new AssignmentInputModel($request);
        $result = $this->projectService->assignPerson($input_model);

        if ($result->isValid) {
            $project_view_model = new ProjectsViewModel($this->entityManager, $this->security);
            return $this->render("responses/member.html.twig",  $project_view_model->getProjectData($input_model->project_id));
        }

        return $this->render("responses/error.html.twig",  ['errors' => $result->getMessages()]);
    }

    /**
     * @Route("/projects/unassign", name="unassign_person", methods={"POST"})
     */
    public function removePersonCtrl(Request $request)
    {
        $input_model = new AssignmentInputModel($request);
        $result = $this->projectService->unassignPerson($input_model);

        if ($result->isValid) {
            $project_view_model = new ProjectsViewModel($this->entityManager, $this->security);
            return $this->render("responses/non_member.html.twig",  $project_view_model->getProjectData($input_model->project_id));
        }

        return $this->render("responses/error.html.twig",  ['errors' => $result->getMessages()]);
    }
}