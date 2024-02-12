<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();

        $project = new Project();
        $project->fill($data);

        $project->slug = Str::of($project->title)->slug('-');

        switch ($data['application_type']) {
            case '1':
                $project->is_frontend = true;
                break;
            case '2':
                $project->is_backend = true;
                break;
            case '3':
                $project->is_monolith = true;
                break;
        }

        if (!empty($data['project_img'])) {
            $project->project_img = Storage::put('uploads', $data['project_img']);
        }

        $project->save();

        if (!empty($data['technologies'])) {
            $project->technologies()->sync($data['technologies']);
        }

        return redirect()->route('admin.projects.index')->with('new_record', "Il progetto $project->title #$project->id è stato aggiunto ai tuoi progetti");
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {

        $data = $request->validated();

        if (!empty($data['project_img'])) {
            if ($project->project_img) {
                Storage::delete($project->project_img);
            }
            $project->project_img = Storage::put('uploads', $data['project_img']);
        }

        if (isset($data['technologies'])) {
            $project->technologies()->sync($data['technologies']);
        } else {
            $project->technologies()->sync([]);
        }

        switch ($request['application_type']) {
            case '1':
                $project->is_frontend = true;
                $project->is_backend = false;
                $project->is_monolith = false;
                break;
            case '2':
                $project->is_frontend = false;
                $project->is_backend = true;
                $project->is_monolith = false;
                break;
            case '3':
                $project->is_frontend = true;
                $project->is_backend = true;
                $project->is_monolith = false;
                break;
        }

        $project->slug = Str::of($data['title'])->slug('-');

        $project->update($data);

        return redirect()->route('admin.projects.show', $project)->with('update_record', "Il progetto $project->title è stato aggiornato");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {

        $project->technologies()->sync([]);

        if ($project->project_img) {
            Storage::delete($project->project_img);
        }

        $project_deleted = $project->title;
        $project_deleted_id = $project->id;

        $project->delete();

        return redirect()->route('admin.projects.index')->with('delete_record', "Il progetto $project_deleted #$project_deleted_id è stato rimosso dai tuoi progetti");
    }
}
