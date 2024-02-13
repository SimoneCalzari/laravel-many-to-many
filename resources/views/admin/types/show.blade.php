@extends('layouts.admin')


@section('content')
    <div class="container">
        <!-- TITOLO - TORNA AI TIPI- ALERT -->
        <div class="d-flex align-items-center justify-content-between">
            <h1 class="fs-2 py-2">Type #{{ $type->id }}</h1>
            <a href="{{ route('admin.types.index') }}" class="btn btn-dark">Back to Types<i
                    class="fa-solid fa-backward ms-3"></i></a>
        </div>
        @if (session('update_record'))
            <div class="alert alert-success" role="alert">
                {{ session('update_record') }}
            </div>
        @endif
        <!-- /TITOLO - TORNA AI TIPI - ALERT -->
        <!-- CARD -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Difficulty</h5>
                <p class="card-text">{{ $type->difficulty }}</p>
                <h5 class="card-title">Team or Individual</h5>
                <p class="card-text">
                    @if ($type->is_team_project)
                        Team <i class="fa-solid fa-users ms-1"></i>
                    @else
                        Individual <i class="fa-solid fa-user ms-1"></i>
                    @endif
                </p>
                <!-- PROJECTS -->
                @if ($type->projects->count() > 0)
                    <h5 class="card-title">Projects</h5>
                    <p class="card-text">
                        @foreach ($type->projects as $project)
                            #{{ $project->id }} - <a
                                href="{{ route('admin.projects.show', $project) }}">{{ $project->title }}</a> </br>
                        @endforeach
                    </p>
                @endif
                <!-- /PROJECTS -->
                <!-- EDIT-->
                <a href="{{ route('admin.types.edit', $type) }}" class="btn btn-primary">
                    Edit
                    <i class="fa-solid fa-pen-to-square ms-1"></i></a>
                <!-- /EDIT -->
            </div>
        </div>
        <!-- /CARD -->
    </div>
@endsection
