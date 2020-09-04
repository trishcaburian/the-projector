<?php
namespace App\Services;

use Doctrine\ORM\EntityManagerInterface;

class QueryService
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function genericSQL($sql, $params = null)
    {
        $conn = $this->entityManager->getConnection();
        
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);

        $result = $stmt->fetchAll();

        $conn->close();

        return $result;
    }

    public function executeOnly($sql, $params = null)
    {
        $conn = $this->entityManager->getConnection();
        
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);

        $conn->close();

        return true;
    }
}