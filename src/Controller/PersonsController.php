<?php
namespace App\Controller;

use App\Model\PersonInputModel;
use App\Model\PersonViewModel;
use App\Services\PersonService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

use Doctrine\ORM\EntityManagerInterface;

class PersonsController extends AbstractController
{
    private $entityManager;
    private $personService;

    public function __construct(EntityManagerInterface $entityManager, PersonService $personService)
    {
        $this->entityManager = $entityManager;
        $this->personService = $personService;
    }

    /**
     * @Route("/persons/create", name="render_create_person", methods={"GET"})
     */
    public function createPersonGet()
    {
        $person_vm = new PersonViewModel($this->entityManager);

        return $this->render('persons/create.html.twig', ['users' => $person_vm->getUserList()]);
    }

    /**
     * @Route("/persons/create", name="process_person", methods={"POST"})
     */
    public function createPersonPost(Request $request)
    {
        $input_model = new PersonInputModel($request);
        $result = $this->personService->createPerson($input_model);

        if ($result->isValid) {
            return $this->redirect($this->generateUrl('homepage'));
        }

        $person_vm = new PersonViewModel($this->entityManager);
        return $this->render('persons/create.html.twig', [
            'users' => $person_vm->getUserList(),
            'errors'=> $result->getMessages()
        ]);
    }
}