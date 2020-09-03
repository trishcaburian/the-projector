<?php
namespace App\Services;

use App\Data\ProjectData;
use Symfony\Component\HttpFoundation\Request;

class ProjectService
{
    public function generateProjectData(Request $request)
    {
        $project_data = new ProjectData();

        if (!is_null($request)) {
            $project_data->code = $request->request->get('code');
            $project_data->name = $request->request->get('name');
            $project_data->remarks = $request->request->get('remarks');
            $project_data->budget = $request->request->get('budget');
        }

        return $project_data;
    }
}