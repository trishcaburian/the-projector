<?php
namespace App\Controller;

use App\Data\PersonData;
use App\Model\PersonModel;
use App\Model\ProjectInputModel;
use App\Services\PersonService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Symfony\Component\Validator\Validator\ValidatorInterface;

class PersonsController extends AbstractController
{
    private $entityManager;
    private $validator;

    public function __construct(EntityManagerInterface $entityManager, ValidatorInterface $validator)
    {
        $this->entityManager = $entityManager;
        $this->validator = $validator;
    }

    /**
     * @Route("/persons/create", name="render_create_person", methods={"GET"})
     */
    public function renderCreatePerson()
    {
        $person_model = new PersonModel($this->entityManager);
        $result = $person_model->getUserData();
        return $this->render('persons/create.html.twig', $result);
    }

    /**
     * @Route("/persons/create", name="process_person", methods={"POST"})
     */
    public function processPerson(Request $request)
    {
        $project_input_model = new ProjectInputModel($this->entityManager, $this->validator);
        $person_service = new PersonService();
        $result = $project_input_model->createPerson($person_service->generatePersonData($request));

        if ($result->isValid) {
            return $this->redirect($this->generateUrl('homepage'));
        } else {
            return new Response($this->renderView('persons/create.html.twig', ['errors' => $result->result_list]));
        }
    }
}