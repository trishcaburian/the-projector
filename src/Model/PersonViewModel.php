<?php
namespace App\Model;

use App\Services\QueryService;
use Doctrine\ORM\EntityManagerInterface;

class PersonViewModel
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getUserList()
    {
        $query = new QueryService($this->entityManager);
        $sql = "SELECT u.id, u.username
                FROM user u
                    LEFT JOIN person p ON u.id = p.user_id
                WHERE p.user_id IS NULL;";
        
        return $query->genericSQL($sql);
    }
}