<?php
namespace App\Model;

use App\Data\CommandResultData;
use App\Data\PersonData;
use App\Data\ProjectData;
use App\Entity\Person;
use App\Entity\Project;
use App\Entity\User;
use App\Services\QueryService;
use Doctrine\Migrations\Query\Query;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProjectInputModel
{
    private $entityManager;
    private $validator;

    public function __construct(EntityManagerInterface $entityManager, ValidatorInterface $validator)
    {
        $this->entityManager = $entityManager;
        $this->validator = $validator;
    }

    public function createProject(ProjectData $project)
    {
        $errors = $this->validator->validate($project);

        $result = new CommandResultData();

        if (count($errors) > 0) {
            $result->result_list = $errors;
            $result->isValid = false;
        } else {
            $project_entity = new Project();
            $project_entity->setCode($project->code);
            $project_entity->setName($project->name);
            $project_entity->setRemarks($project->remarks);
            $project_entity->setBudget($project->budget);

            $this->entityManager->persist($project_entity);

            $this->entityManager->flush();

            $result->result_list = ["Project was successfully created."];
            $result->isValid = true;
        }

        return $result;
    }

    public function createPerson(PersonData $person)
    {
        $errors = $this->validator->validate($person);

        $result = new CommandResultData;

        if (count($errors) > 0) {
            $result->result_list = $errors;
            $result->isValid = false;

            return $result;
        }


        $person_entity = new Person();
        $person_entity->setFirstName($person->first_name);
        $person_entity->setLastName($person->last_name);

        $this->entityManager->persist($person_entity);
        $this->entityManager->flush();

        $result->result_list = ["Person is created."];
        $result->isValid = true;
        return $result;
    }
}