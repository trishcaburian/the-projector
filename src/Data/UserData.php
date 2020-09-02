<?php
namespace App\Data;

use Symfony\Component\Validator\Constraints as Assert;

class UserData
{
    /**
     * @Assert\Email(
     *      message = "{{ value }} is not a valid username."
     * )
     * @Assert\Length(
     *      min = 5,
     *      max = 200,
     *      minMessage = "The username cannot be less than {{ limit }} characters long.",
     *      maxMessage = "The username cannot be more than {{ limit }} characters long.",
     *      allowEmptyString = false
     * )
     */
    private $username;

    /**
     * @Assert\Length(
     *      min = 7,
     *      max = 11,
     *      minMessage = "The password cannot be less than {{ limit }} characters long.",
     *      maxMessage = "The password cannot be more than {{ limit }} characters long.",
     *      allowEmptyString = false
     * )
     */
    private $password;

    // getters
    public function getUsername(): string
    {
        return $this->username;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    // setters
    public function setUsername(string $username)
    {
        $this->username = $username;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }
}