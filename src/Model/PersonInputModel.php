<?php
namespace App\Model;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class PersonInputModel
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
     * 
     * @Assert\Regex(
     *      pattern = "/^[a-zA-Z\s]*$/",
     *      message = "First name can only have letters and spaces."
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
     * 
     * @Assert\Regex(
     *      pattern = "/^[a-zA-Z\s]*$/",
     *      message = "Last name can only have letters and spaces."
     * )
     */
    public $last_name;
    
    /**
     * @Assert\Type(
     *      type="integer",
     *      message = "User ID can only be a number."
     * )
     * 
     * @Assert\NotBlank(
     *      message = "User ID cannot be blank."
     * )
     */
    public $user_id;

    public function __construct(Request $request)
    {
        if (!is_null($request)) {
            $this->first_name = $request->request->get('first_name');
            $this->last_name = $request->request->get('last_name');
            $this->user_id = (int) $request->request->get('user_id');
        }
    }
}