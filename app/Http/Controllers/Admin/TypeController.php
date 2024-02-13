<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTypeRequest;
use App\Http\Requests\UpdateTypeRequest;
use App\Models\Type;
use Illuminate\Support\Str;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $types = Type::all();
        return view('admin.types.index', compact('types'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.types.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreTypeRequest $request)
    {
        $data = $request->validated();

        $type = new Type();
        $type->fill($data);
        $type->slug = Str::of($type->difficulty)->slug();
        $type->save();

        return redirect()->route('admin.types.index')->with('new_record', "Il tipo $type->title #$type->id è stato aggiunto ai tuoi tipi");
    }

    /**
     * Display the specified resource.
     */
    public function show(Type $type)
    {
        return view('admin.types.show', compact('type'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Type $type)
    {
        return view('admin.types.edit', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateTypeRequest $request, Type $type)
    {
        $data = $request->validated();
        $type->slug = Str::of($data['difficulty'])->slug('-');
        $type->update($data);
        return redirect()->route('admin.types.show', $type)->with('update_record', "Il tipo $type->difficulty è stato aggiornato");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Type $type)
    {
        $type_deleted = $type->difficulty;
        $type_deleted_id = $type->id;
        $type->delete();
        return redirect()->route('admin.types.index')->with('delete_record', "Il tipo $type_deleted #$type_deleted_id è stato rimosso dai tuoi typi");
    }
}
