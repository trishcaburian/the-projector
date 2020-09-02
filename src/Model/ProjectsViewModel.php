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

    public function getViewData()
    {
        $view_data = [];
        $user = $this->security->getUser();

        $view_data['first_name'] = $this->getFirstName($user->getId());
        $view_data['projects'] = $this->getAllProjects();

        return $view_data;
    }
    
    private function getFirstName($id)
    {
        $sql = "SELECT first_name FROM persons WHERE user_id = :user_id limit 1";

        $user_object = $this->genericSQL($sql, ['user_id' => $id]);

        return $user_object[0];
    }

    private function getAllProjects()
    {
        $sql = "SELECT * FROM projects";

        return $this->genericSQL($sql);
    }

    //move outside
    private function genericSQL($sql, $params = null)
    {
        $conn = $this->entityManager->getConnection();
        
        $stmt = $conn->prepare($sql);
        $stmt->execute($params);

        $result = $stmt->fetchAll();

        $conn->close();

        return $result;
    }
}