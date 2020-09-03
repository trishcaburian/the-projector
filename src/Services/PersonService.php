<?php
namespace App\Services;

use App\Data\CommandResultData;
use App\Entity\Person;
use App\Model\PersonInputModel;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class PersonService
{
    private $entityManager;
    private $validator;

    public function __construct(EntityManagerInterface $entityManager, ValidatorInterface $validator)
    {
        $this->entityManager = $entityManager;
        $this->validator = $validator;
    }

    public function createPerson(PersonInputModel $person)
    {
        $errors = $this->validator->validate($person);

        $result = new CommandResultData();

        if (count($errors) > 0) {
            $result->isValid = false;
            $result->setMessageList($errors);
            return $result;
        }

        $person_entity = new Person();
        $person_entity->setFirstName($person->first_name);
        $person_entity->setLastName($person->last_name);
        $person_entity->setUserId($person->user_id);

        $this->entityManager->persist($person_entity);
        $this->entityManager->flush();

        $result->isValid = true;
        $result->addMessage("Successfully created Person.");
        
        return $result;
    }
}