<?php
namespace App\Model;

use App\Services\QueryService;
use Doctrine\ORM\EntityManagerInterface;

class PersonModel
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    public function getUserData()
    {
        $query = new QueryService($this->entityManager);

        $sql = "SELECT username, id FROM user WHERE person_id IS NULL";

        $result = $query->genericSQL($sql);

        return ['users' => $result];
    }
}