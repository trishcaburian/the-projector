<?php
namespace App\Model;

use Doctrine\ORM\EntityManagerInterface;

class ProjectsViewModel
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getAllProjects()
    {
        $sql = "SELECT * FROM projects";

        return $this->genericSQL($sql);
    }

    private function genericSQL($sql)
    {
        $conn = $this->entityManager->getConnection();

        $stmt = $conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }
}