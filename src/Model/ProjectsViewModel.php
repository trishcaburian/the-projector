<?php
namespace App\Model;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

class ProjectsViewModel
{
    private $entityManager;
    private $security;

    public function __construct(EntityManagerInterface $entityManager, Security $security)
    {
        $this->entityManager = $entityManager;
        $this->security = $security;
    }
    
    public function getFirstNameByUserId()
    {
        $user = $this->security->getUser();

        $sql = "SELECT * FROM persons WHERE user_id = :user_id limit 1";

        $user_object = $this->genericSQL($sql, ['user_id' => $user->getId()]);

        return $user_object[0];
    }

    public function getAllProjects()
    {
        $sql = "SELECT * FROM projects";

        return $this->genericSQL($sql);
    }

    private function genericSQL($sql, $params = null)
    {
        $conn = $this->entityManager->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->execute($params);

        return $stmt->fetchAll();
    }
}