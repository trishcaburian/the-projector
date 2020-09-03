<?php
namespace App\Controller;

use App\Model\ProjectInputModel;
use App\Model\ProjectsViewModel;
use App\Services\ProjectService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProjectsController extends AbstractController
{
    private $security;
    private $entityManager;
    private $validator;

    public function __construct(Security $security, EntityManagerInterface $entityManager, ValidatorInterface $validator)
    {
        $this->security = $security;
        $this->entityManager = $entityManager;
        $this->validator = $validator;
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
        $project_input_model = new ProjectInputModel($this->entityManager, $this->validator);
        $project_service = new ProjectService();
        $result = $project_input_model->createProject($project_service->generateProjectData($request));

        if ($result->isValid) {
            return $this->redirect($this->generateUrl('homepage'));
        } else {
            return new Response($this->renderView('projects/create.html.twig', ['errors' => $result->result_list]));
        }
    }

    /**
     * @Route("/projects/assignments/{id}", name="view_assignments", methods={"GET"})
     */
    public function viewAssignments(int $id)
    {
        var_dump($id);die;
    }
}