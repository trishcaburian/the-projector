<?php
namespace App\Data;

use Symfony\Component\Validator\Constraints as Assert;

class UserData
{
    /**
     * @Assert\Email(
     *      message = "{{ value }} is not a valid username."
     * )
     * 
     * @Assert\Length(
     *      min = 5,
     *      max = 200,
     *      minMessage = "The username cannot be less than {{ limit }} characters long.",
     *      maxMessage = "The username cannot be more than {{ limit }} characters long.",
     *      allowEmptyString = false
     * )
     * 
     * @Assert\NotBlank(
     *      message = "The username cannot be blank"
     * )
     */
    public $username;

    /**
     * @Assert\Length(
     *      min = 7,
     *      max = 11,
     *      minMessage = "The password cannot be less than {{ limit }} characters long.",
     *      maxMessage = "The password cannot be more than {{ limit }} characters long.",
     *      allowEmptyString = false
     * )
     * 
     * @Assert\NotBlank(
     *      message = "The password cannot be blank"
     * )
     */
    public $password;
}