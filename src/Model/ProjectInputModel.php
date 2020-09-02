<?php
namespace App\Model;

use App\Data\CommandResultData;
use App\Data\ProjectData;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class ProjectInputModel
{
    public function createProject(ProjectData $project)
    {
        $errors = $this->validator->validate($project);

        $result = new CommandResultData();

        if (count($errors) > 0) {
            $result->result_list = $errors;
        } else {
            $result->result_list = ["Project was successfully created."];
        }
    }
}