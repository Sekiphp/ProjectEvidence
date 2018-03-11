<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\ProjectType;
use Illuminate\Http\Request;
use App\Http\Requests\ProjectRequest;

class ProjectsController extends Controller
{
    private $render = [];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Seznam projektu
     *
     * @return \Illuminate\Http\Response
     */
    function list() {
        $this->render['projects'] = Project::with('project_type')->get();

        return view('projects.list', $this->render);
    }

    /**
     * Novy projekt
     *
     * @param  ProjectRequest $request
     */
    function new(ProjectRequest $request) {
        // data do selectboxu
        $this->render['project_types'] = ProjectType::pluck('name', 'id');

        // zpracovani formulare
        // $input = $request->all();
        if ($_POST) {
            $project = new Project();
            $project->name = $request->name ?? '';
            $project->end_date = $request->end_date;
            $project->project_type = (int) $request->project_type;
            $project->is_web = (bool) $request->is_web;

            if ($project->save()) {
                $this->render['success'] = "Právě byl založen nový projekt.";
            }
            else {
                $this->render['warning'] = "Projekt se nepodařilo založit!";
            }
        }

        return view('projects.new', $this->render);
    }

    /**
     * Smazani projektu
     *
     * @param  int    $id ID projektu
     */
    public function delete(int $id)
    {
        $project = Project::find($id);

        if ($project != null) {
            $project->delete();

            $this->render['success'] = "Projekt byl smazán.";
        } else {
            $this->render['warning'] = "nelze smazat projekt protože neexistuje!";
        }

        return self::list();
    }

    /**
     * Editace projektu
     *
     * @param  int    $id ID projektu
     */
    public function edit(int $id)
    {
        $project = Project::find($id);

    }
}
