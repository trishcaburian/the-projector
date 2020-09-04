<?php
namespace App\Services;

use App\Data\CommandResultData;
use App\Entity\Project;
use App\Entity\ProjectAssignments;
use App\Model\AssignmentInputModel;
use App\Model\ProjectInputModel;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use App\Services\QueryService;

class ProjectService
{
    private $entityManager;
    private $validator;

    public function __construct(EntityManagerInterface $entityManager, ValidatorInterface $validator)
    {
        $this->entityManager = $entityManager;
        $this->validator = $validator;
    }

    public function createProject(ProjectInputModel $project)
    {
        $errors = $this->validator->validate($project);

        $result = new CommandResultData();

        if (count($errors) > 0) {
            $result->setMessageList($errors);
            $result->isValid = false;
            return $result;
        }

        if ($this->isExistingProject($project->code)) {
            $result->addMessage("That Project Code is already taken.");
            $result->isValid = false;
            return $result;
        }

        $project_entity = new Project();
        $project_entity->setCode($project->code);
        $project_entity->setName($project->name);
        $project_entity->setRemarks($project->remarks);
        $project_entity->setBudget($project->budget);

        $this->entityManager->persist($project_entity);

        $this->entityManager->flush();

        $result->addMessage("Project was successfully created.");
        $result->isValid = true;

        return $result;
    }

    public function isExistingProject($code)
    {
        $result = $this->entityManager->getRepository(Project::class)->findOneBy(['code' => $code]);

        if (!empty($result) || !is_null($result)) {
            return true;
        }

        return false;
    }

    public function assignPerson(AssignmentInputModel $project_assignment)
    {
        $errors = $this->validator->validate($project_assignment);

        $result = new CommandResultData();

        if (count($errors) > 0) {
            $result->setMessageList($errors);
            $result->isValid = false;
            return $result;
        }

        $assignment_entity = new ProjectAssignments();
        $assignment_entity->setPersonId($project_assignment->person_id);
        $assignment_entity->setProjectId($project_assignment->project_id);

        $this->entityManager->persist($assignment_entity);
        $this->entityManager->flush();

        $result->addMessage("Person is now a member of Project.");
        $result->isValid = true;

        return $result;
    }

    public function unassignPerson(AssignmentInputModel $project_assignment)
    {
        $errors = $this->validator->validate($project_assignment);

        $result = new CommandResultData();

        if (count($errors) > 0) {
            $result->setMessageList($errors);
            $result->isValid = false;
            return $result;
        }

        $query = new QueryService($this->entityManager);

        $sql = "DELETE FROM project_assignments 
                WHERE project_id = :project_id
                AND person_id = :person_id";
        
        $query->executeOnly($sql, [
            'person_id' => $project_assignment->person_id,
            'project_id' => $project_assignment->project_id
        ]);

        $result->addMessage('Person is unassigned from project.');
        $result->isValid = true;
        return $result;
    }
}