<?php
namespace App\Services;

use App\Data\PersonData;
use Symfony\Component\HttpFoundation\Request;

class PersonService
{
    public function generatePersonData(Request $request)
    {
        $person_data = new PersonData();

        if (!is_null($request)) {
            $person_data->first_name = $request->request->get('first_name');
            $person_data->last_name = $request->request->get('last_name');
            $person_data->user_id = $request->request->get('user');
        }

        return $person_data;
    }
}