<?php
namespace App\Controller;

use App\Model\PersonInputModel;
use App\Services\PersonService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use Doctrine\ORM\EntityManagerInterface;
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
        return $this->render('persons/create.html.twig');
    }

    /**
     * @Route("/persons/create", name="process_person", methods={"POST"})
     */
    public function processPerson(Request $request)
    {
        $person_input_model = new PersonInputModel($this->entityManager, $this->validator);
        $person_service = new PersonService();
        $result = $person_input_model->createPerson($person_service->generatePersonData($request));

        if ($result->isValid) {
            return $this->redirect($this->generateUrl('homepage'));
        } else {
            return new Response($this->renderView('persons/create.html.twig', ['errors' => $result->result_list]));
        }
    }
}