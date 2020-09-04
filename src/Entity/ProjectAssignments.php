<?php

namespace App\Entity;

use App\Repository\ProjectAssignmentsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProjectAssignmentsRepository::class)
 */
class ProjectAssignments
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $person_id;

    /**
     * @ORM\Column(type="integer")
     */
    private $project_id;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPersonId(): ?int
    {
        return $this->person_id;
    }

    public function setPersonId(int $person_id): self
    {
        $this->person_id = $person_id;

        return $this;
    }

    public function getProjectId(): ?int
    {
        return $this->project_id;
    }

    public function setProjectId(int $project_id): self
    {
        $this->project_id = $project_id;

        return $this;
    }
}
