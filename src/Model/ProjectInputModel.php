<?php
namespace App\Model;

use App\Data\CommandResultData;
use App\Data\ProjectData;
use App\Services\QueryService;
use Doctrine\Migrations\Query\Query;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProjectInputModel
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;    
    }

    public function createProject(ProjectData $project)
    {
        $errors = $this->validator->validate($project);

        $result = new CommandResultData();

        if (count($errors) > 0) {
            $result->result_list = $errors;
            $result->isValid = false;
        } else {
            $query_service = new QueryService($this->entityManager);
            $result->result_list = ["Project was successfully created."];
            $result->isValid = true;
        }

        return $result;
    }
}