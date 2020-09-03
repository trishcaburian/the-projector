<?php
namespace App\Model;

use App\Services\QueryService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class ProjectsViewModel
{
    private $entityManager;
    private $security;
    private $queryService;

    public function __construct(EntityManagerInterface $entityManager, Security $security)
    {
        $this->entityManager = $entityManager;
        $this->security = $security;

        $this->queryService = new QueryService($entityManager);
    }

    public function getHomeViewData()
    {
        $user = $this->security->getUser();

        return [
            'first_name' => $user->getUsername(),
            'projects' => $this->getAllProjects()
        ];
    }

    public function getProjectData($project_id)
    {
        $members = $this->getMembersOfProject($project_id);
    }
    
    private function getFirstName($id)
    {
        $sql = "SELECT first_name FROM person WHERE user_id = :user_id limit 1";

        $user_object = $this->queryService->genericSQL($sql, ['user_id' => $id]);

        return $user_object[0]['first_name'];
    }

    private function getAllProjects()
    {
        $sql = "SELECT * FROM project";

        return $this->queryService->genericSQL($sql);
    }

    private function getMembersOfProject($project_id)
    {
        $sql = "SELECT p.* FROM person AS p 
                JOIN projectassignments as pa
                WHERE pa.project_id = :project_id
                AND pa.person_id = p.id";

        $member_list = $this->queryService->genericSQL($sql, ['project_id' => $project_id]);

        return $member_list;
    }
}