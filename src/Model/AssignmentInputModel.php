<?php
namespace App\Model;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Constraints as Assert;

class AssignmentInputModel
{
    /**
     * @Assert\NotNull
     * 
     * @Assert\Type(
     *      type = "integer",
     *      message = "Person ID can only be an integer."
     * )
     */
    public $person_id;

    /**
     * @Assert\NotNull
     * 
     * @Assert\Type(
     *      type = "integer",
     *      message = "Project ID can only be an integer."
     * )
     */
    public $project_id;

    public function __construct(Request $request)
    {
        if (!is_null($request)) {
            $this->person_id = (int) $request->request->get('person_id');
            $this->project_id = (int) $request->request->get('project_id');
        }
    }
}