<?php
namespace App\Data;

use Symfony\Component\Validator\Constraints as Assert;

class ProjectData
{
    /**
     * @Assert\NotBlank(
     *      message = "{{ value }} cannot be blank"
     * )
     */
    public $code;

    /**
     * @Assert\NotBlank(
     *      message = "{{ value }} cannot be blank"
     * )
     */
    public $name;

    /**
     * @Assert\NotBlank(
     *      message = "{{ value }} cannot be blank"
     * )
     */
    public $remarks;

    /**
     * @Assert\NotBlank(
     *      message = "{{ value }} cannot be blank"
     * )
     */
    public $budget;
}