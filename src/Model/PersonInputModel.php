<?php
namespace App\Model;

use App\Data\CommandResultData;
use App\Data\PersonData;
use App\Entity\Person;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PersonInputModel
{
    private $entityManager;
    private $validator;

    public function __construct(EntityManagerInterface $entityManager, ValidatorInterface $validator)
    {
        $this->entityManager = $entityManager;
        $this->validator = $validator;
    }

    public function createPerson(PersonData $person)
    {
        $errors = $this->validator->validate($person);

        $result = new CommandResultData();

        if (count($errors) > 0) {
            $result->isValid = false;
            $result->result_list = $errors;
        } else {
            $person_entity = new Person();
            $person_entity->setFirstName($person->first_name);
            $person_entity->setLastName($person->last_name);

            $this->entityManager->persist($person_entity);
            $this->entityManager->flush();

            $result->isValid = true;
            $result->result_list = ["Successfully created Person."];
        }

        return $result;
    }
}