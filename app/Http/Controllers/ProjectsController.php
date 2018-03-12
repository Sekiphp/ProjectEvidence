<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProjectRequest;
use App\Models\Project;
use App\Models\ProjectType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
     */
    public function list() {
        $this->render['projects'] = DB::table('projects as p')
            ->join('project_types as pt', 'p.project_type', '=', 'pt.id')
            ->select("p.*", "pt.name as pt_name")
            ->get();
        //$this->render['projects'] = Project::withProjectType()->get();

        return view('projects.list', $this->render);
    }

    public function showNew() {
        // data do selectboxu
        $this->render['project_types'] = ProjectType::pluck('name', 'id');

        return view('projects.new', $this->render);
    }

    /**
     * Novy projekt
     *
     * @param  ProjectRequest $request
     */
    public function postNew(ProjectRequest $request) {
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
            } else {
                $this->render['warning'] = "Projekt se nepodařilo založit!";
            }
        }

        return redirect('/project/new');
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
    public function edit(int $id, Request $request)
    {
        // zpracovani formulare
        // $input = $request->all();
        if ($_POST) {
            $project = Project::find($id);
            $project->name = $request->name ?? '';
            $project->end_date = $request->end_date;
            $project->project_type = (int) $request->project_type;
            $project->is_web = (bool) $request->is_web;

            if ($project->save()) {
                $this->render['success'] = "Projekt byl úspěšně upraven.";
            } else {
                $this->render['warning'] = "Nepodařilo se upravit projekt!";
            }
        }

        $project = Project::findOrFail($id);

        $this->render['project_types'] = ProjectType::pluck('name', 'id');
        $this->render['project'] = $project;

        return view('projects.edit', $this->render);
    }
}
