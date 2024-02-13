@extends('layouts.admin')


@section('content')
    <div class="container">
        <!-- TITOLO - TORNA ALLE TECNOLOGIE - ALERT -->
        <div class="d-flex align-items-center justify-content-between">
            <h1 class="fs-2 py-2">Technology #{{ $technology->id }}</h1>
            <a href="{{ route('admin.technologies.index') }}" class="btn btn-dark">Back to Technologies<i
                    class="fa-solid fa-backward ms-3"></i></a>
        </div>
        @if (session('update_record'))
            <div class="alert alert-success" role="alert">
                {{ session('update_record') }}
            </div>
        @endif
        <!-- /TITOLO - TORNA ALLE TECNOLOGIE - ALERT -->
        <!-- CARD -->
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">Name</h5>
                <p class="card-text">{{ $technology->name }}</p>
                <!-- PROJECTS -->
                @if ($technology->projects->count() > 0)
                    <h5 class="card-title">Projects</h5>
                    <p class="card-text">
                        @foreach ($technology->projects as $project)
                            #{{ $project->id }} - <a
                                href="{{ route('admin.projects.show', $project) }}">{{ $project->title }}</a> </br>
                        @endforeach
                    </p>
                @endif
                <!-- /PROJECTS -->

                <!-- EDIT-->
                <a href="{{ route('admin.technologies.edit', $technology) }}" class="btn btn-primary">
                    Edit
                    <i class="fa-solid fa-pen-to-square ms-1"></i></a>
                <!-- /EDIT -->
            </div>
        </div>
        <!-- /CARD -->
    </div>
@endsection
