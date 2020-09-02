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
            'first_name' => $this->getFirstName($user->getId()),
            'projects' => $this->getAllProjects()
        ];
    }
    
    private function getFirstName($id)
    {
        $sql = "SELECT first_name FROM persons WHERE user_id = :user_id limit 1";

        $user_object = $this->queryService->genericSQL($sql, ['user_id' => $id]);

        return $user_object[0];
    }

    private function getAllProjects()
    {
        $sql = "SELECT * FROM projects";

        return $this->queryService->genericSQL($sql);
    }
}