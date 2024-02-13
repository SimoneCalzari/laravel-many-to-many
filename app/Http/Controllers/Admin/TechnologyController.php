<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTechnologyRequest;
use App\Http\Requests\UpdateTechnologyRequest;
use App\Models\Technology;
use Illuminate\Support\Str;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $technologies = Technology::all();
        return view('admin.technologies.index', compact('technologies'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.technologies.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTechnologyRequest $request)
    {
        $data = $request->validated();

        $technology = new Technology();
        $technology->fill($data);
        $technology->slug = Str::of($technology->name)->slug();
        $technology->save();

        return redirect()->route('admin.technologies.index')->with('new_record', "Il tipo $technology->title #$technology->id è stato aggiunto ai tuoi tipi");
    }

    /**
     * Display the specified resource.
     */
    public function show(Technology $technology)
    {
        return view('admin.technologies.show', compact('technology'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Technology $technology)
    {
        return view('admin.technologies.edit', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTechnologyRequest $request, Technology $technology)
    {
        $data = $request->validated();
        $technology->slug = Str::of($data['name'])->slug();
        $technology->update($data);
        return redirect()->route('admin.technologies.show', $technology)->with('update_record', "Il tipo $technology->name è stato aggiornato");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technology $technology)
    {
        $technology->projects()->sync([]);
        $technology_deleted = $technology->name;
        $technology_deleted_id = $technology->id;
        $technology->delete();
        return redirect()->route('admin.technologies.index')->with('delete_record', "Il tipo $technology_deleted #$technology_deleted_id è stato rimosso dai tuoi typi");
    }
}
