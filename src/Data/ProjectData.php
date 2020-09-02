<?php
namespace App\Data;

use Symfony\Component\HttpFoundation\Request;
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

    public function __construct(Request $request = null)
    {
        if (!is_null($request)) {
            $this->code = $request->request->get('code');
            $this->name = $request->request->get('name');
            $this->remarks = $request->request->get('remarks');
            $this->budget = $request->request->get('budget');
        }
    }
}