<?php
namespace App\Data;

use Symfony\Component\Validator\Constraints as Assert;

class PersonData
{
    /**
     * @Assert\NotBlank(
     *      message = "{{ value }} cannot be blank."
     * )
     * 
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "First name must be at least {{ limit }} characters long.",
     *      maxMessage = "First name cannot be longer than {{ limit }} characters long."
     * )
     */
    public $first_name;
    
    /**
     * @Assert\NotBlank(
     *      message = "{{ value }} cannot be blank."
     * )
     * 
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "First name must be at least {{ limit }} characters long.",
     *      maxMessage = "First name cannot be longer than {{ limit }} characters long."
     * )
     */
    public $last_name;
    
    // public $user_id;
}