<?php
namespace App\Model;

use App\Entity\Project;
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
            'projects' => $this->getAllProjects()
        ];
    }

    public function getProjectData($project_id)
    {
        return [
            'project_info' => $this->entityManager->getRepository(Project::class)->findOneBy(['id' => $project_id]),
            'members' => $this->getMembersOfProject($project_id),
            'non_members' => $this->getNonMembers($project_id)
        ];
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

    private function getNonMembers($project_id)
    {
        $sql = "SELECT p.*
                FROM person p
                LEFT JOIN projectassignments pa
                ON p.id = pa.person_id
                AND pa.project_id = :project_id
                WHERE pa.person_id IS NULL";
        
        $non_members = $this->queryService->genericSQL($sql, ['project_id' => $project_id]);

        return $non_members;
    }
}