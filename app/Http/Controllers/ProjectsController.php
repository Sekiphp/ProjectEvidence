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
    /** @var array Pole do sablony */
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
    public function getList() {
        $this->render['projects'] = Project::all();

        return view('projects.list', $this->render);
    }

    /**
     * Novy projekt
     */
    public function getNew() {
        // data do selectboxu
        $this->render['project_types'] = ProjectType::pluck('name', 'id');

        return view('projects.new', $this->render);
    }

    /**
     * Novy projekt - POST
     *
     * @param  ProjectRequest $request Zajisti validaci formulare
     */
    public function postNew(ProjectRequest $request) {
        $project = new Project();
        $project->name = $request->name;
        $project->end_date = $request->end_date;
        $project->project_type = (int) $request->project_type;
        $project->is_web = (bool) $request->is_web;

        if ($project->save()) {
            return redirect('/project/new')->with('success', "Právě byl založen nový projekt.");
        } else {
            return redirect('/project/new')->with('warning', "Projekt se nepodařilo založit!");
        }
    }

    /**
     * Smazani projektu
     *
     * @param  int $id ID projektu
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

        return self::getList();
    }

    /**
     * Zobrazit editaci projektu
     *
     * @param  int $id ID projektu
     */
    public function getEdit(int $id)
    {
        $this->render['project'] = Project::find($id);
        $this->render['project_types'] = ProjectType::pluck('name', 'id');

        return view('projects.edit', $this->render);
    }

    /**
     * Editace projektu
     *
     * @param  int $id ID projektu
     * @param  ProjectRequest $request Zajisti validaci formulare
     */
    public function postEdit(ProjectRequest $request, int $id)
    {
        $project = Project::find($id);
        $project->name = $request->name ?? '';
        $project->end_date = $request->end_date;
        $project->project_type = (int) $request->project_type;
        $project->is_web = (bool) $request->is_web;

        if ($project->save()) {
            return redirect("/project/edit/{$id}")->with('success', "Projekt byl úspěšně upraven.");
        } else {
            return redirect("/project/edit/{$id}")->with('warning', "Nepodařilo se upravit projekt!");
        }
    }
}
