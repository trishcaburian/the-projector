<?php
namespace App\Data;

use Symfony\Component\Validator\Constraints as Assert;

class PersonData
{
    /**
     * @Assert\NotBlank(
     *      message = "First Name cannot be blank."
     * )
     * 
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "First name cannot be shorter than {{ limit }} letters.",
     *      maxMessage = "First name cannot be longer than {{ limit }} letters."
     * )
     */
    public $first_name;

    /**
     * @Assert\NotBlank(
     *      message = "Last Name cannot be blank."
     * )
     * 
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "Last name cannot be shorter than {{ limit }} letters.",
     *      maxMessage = "Last name cannot be longer than {{ limit }} letters."
     * )
     */
    public $last_name;

    public $user_id;
}