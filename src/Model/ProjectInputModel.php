<?php
namespace App\Model;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class ProjectInputModel
{
    /**
     * @Assert\NotBlank(
     *      message = "{{ value }} cannot be blank"
     * )
     * 
     * @Assert\Type(
     *      type="alnum",
     *      message = "Code can only have alphanumeric characters. (A-Z, 0-9)"
     * )
     * 
     * @Assert\Length(
     *      max = 50,
     *      maxMessage = "Code cannot be longer than {{ limit }} characters"
     * )
     */
    public $code;

    /**
     * @Assert\NotBlank(
     *      message = "{{ value }} cannot be blank"
     * )
     * 
     * @Assert\Regex(
     *      pattern = "/^[a-zA-Z0-9 ]*$/",
     *      message = "Name can only have alphanumeric characters (A-Z, 0-9) and spaces."
     * )
     * 
     * @Assert\Length(
     *      max = 50,
     *      maxMessage = "Name cannot be longer than {{ limit }} characters"
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
     * 
     * @Assert\Type(
     *      type="numeric",
     *      message = "Budget can only be a number."
     * )
     */
    public $budget;

    /**
     * @Assert\NotBlank(
     *      message = "{{ value }} cannot be blank"
     * )
     */
    public $currency;
    
    public function __construct(Request $request)
    {
        if (!is_null($request)) {
            $this->code = $request->request->get('code');
            $this->name = $request->request->get('name');
            $this->remarks = $request->request->get('remarks');
            $this->budget = $request->request->get('budget');
            $this->currency = $request->request->get('currency');
        }
    }
}