@extends('layouts.admin')

@section('content')
    <div class="container">
        <!-- TITOLO - TORNA AI PROGETTI - ALERT -->
        <div class="d-flex align-items-center justify-content-between">
            <h1 class="fs-2 py-2">{{ $project->title }}</h1>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-dark">Back to Projects<i
                    class="fa-solid fa-backward ms-3"></i></a>
        </div>
        @if (session('update_record'))
            <div class="alert alert-success" role="alert">
                {{ session('update_record') }}
            </div>
        @endif
        <!-- /TITOLO - TORNA AI PROGETTI - ALERT -->
        <!-- CARD -->
        <div class="card">
            <div class="card-body">
                <!-- IMMAGINE PROGETTO SE PRESENTE -->
                @if ($project->project_img)
                    <h5 class="card-title">Project Picture</h5>
                    <div class="w-25">
                        <img src="{{ asset("storage/$project->project_img") }}" alt="{{ "$project->title" }}"
                            class="img-fluid">
                    </div>
                @endif
                <!-- /IMMAGINE PROGETTO SE PRESENTE -->
                <h5 class="card-title">Title</h5>
                <p class="card-text">{{ $project->title }}</p>
                <h5 class="card-title">Slug</h5>
                <p class="card-text">{{ $project->slug }}</p>
                <h5 class="card-title">Stack</h5>
                <p class="card-text">{{ $project->technologies_stack }}</p>
                <h5 class="card-title">Description</h5>
                <p class="card-text">{{ $project->description }}</p>
                <!--  TECHNOLOGIES -->
                @if ($project->technologies->count() > 0)
                    <h5 class="card-title">Technologies</h5>
                    <p class="card-text">
                        @foreach ($project->technologies as $technology)
                            @if ($loop->last)
                                {{ $technology->name }}
                            @else
                                {{ $technology->name }},
                            @endif
                        @endforeach
                    </p>
                @endif
                <!--  /TECHNOLOGIES -->
                <h5 class="card-title">Project Type</h5>
                <p class="card-text">
                    @if ($project->is_frontend)
                        Frontend
                    @elseif ($project->is_backend)
                        Backend
                    @else
                        Fullstack
                    @endif
                </p>

                <!-- DIFFICOLTA E TEAM/SINGLE DEL PROGETTO SFRUTTANDO RELAZIONI TRA TABELLE -->
                @if ($project->type_id)
                    <h5 class="card-title">Difficulty</h5>
                    <p class="card-text">{{ $project->type->difficulty }}</p>
                @endif
                @if (isset($project->type->is_team_project))
                    <h5 class="card-title">Team or Individual</h5>
                    <p class="card-text">{!! $project->type->is_team_project
                        ? '<i class="fa-solid fa-users fs-5"></i>'
                        : '<i class="fa-solid fa-user fs-5"></i>' !!}</p>
                @endif
                <!-- /DIFFICOLTA E TEAM/SINGLE DEL PROGETTO SFRUTTANDO RELAZIONI TRA TABELLE -->

                <!-- EDIT-->
                <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-primary">Edit <i
                        class="fa-solid fa-pen-to-square ms-1"></i></a>
                <!-- /EDIT -->
            </div>
        </div>
        <!-- /CARD -->
    </div>
@endsection
