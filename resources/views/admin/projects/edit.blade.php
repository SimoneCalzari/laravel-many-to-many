@extends('layouts.admin')


@section('content')
    <div class="container">
        <!-- TITOLO - TORNA AI PROGETTI -->
        <div class="d-flex align-items-center justify-content-between">
            <h1 class="fs-2 py-2">Edit {{ $project->slug }}</h1>
            <a href="{{ route('admin.projects.index') }}" class="btn btn-dark">Back to Projects<i
                    class="fa-solid fa-backward ms-3"></i></a>
        </div>
        <!-- /TITOLO - TORNA AI PROGETTI -->
        <!-- FORM -->
        <form action="{{ route('admin.projects.update', $project) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <!-- TITOLO -->
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid  @enderror" id="title"
                    name="title" required value="{{ old('title', $project->title) }}">
            </div>
            @error('title')
                @foreach ($errors->get('title') as $error)
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                @endforeach
            @enderror
            <!-- TITOLO -->
            <!-- STACK -->
            <div class="mb-3">
                <label for="stack" class="form-label">Technologies Stack</label>
                <input type="text" class="form-control @error('technologies_stack') is-invalid  @enderror" id="stack"
                    name="technologies_stack" required
                    value="{{ old('technologies_stack', $project->technologies_stack) }}">
            </div>
            @error('technologies_stack')
                @foreach ($errors->get('technologies_stack') as $error)
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                @endforeach
            @enderror
            <!-- /STACK -->
            <!-- DESCRIPTION -->
            <div class="mb-3">
                <label for="description" class="form-label">Project Description</label>
                <textarea class="form-control @error('description') is-invalid  @enderror" style="height: 100px" id="description"
                    name="description" required>{{ old('description', $project->description) }}</textarea>
            </div>
            @error('description')
                @foreach ($errors->get('description') as $error)
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                @endforeach
            @enderror
            <!-- /DESCRIPTION -->
            <!-- TECHNOLOGIES CHECKBOXES -->
            <h5 class="fs-6 mb-2">Technologies</h5>
            @foreach ($technologies as $technology)
                <div class="form-check form-check-inline mb-3">
                    <input class="form-check-input" type="checkbox" id="technology_{{ $technology->id }}"
                        value="{{ $technology->id }}" name="technologies[]"
                        @if ($errors->any()) {{ in_array($technology->id, old('technologies', [])) ? 'checked' : '' }}
                        @elseif ($project->technologies->contains($technology))
                        checked @endif>
                    <label class="form-check-label" for="technology_{{ $technology->id }}">{{ $technology->name }}</label>
                </div>
            @endforeach
            @error('technologies')
                @foreach ($errors->get('technologies') as $error)
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                @endforeach
            @enderror
            <!-- /TECHNOLOGIES CHECKBOXES -->
            <!-- TYPE RADIO -->
            <h5 class="fw-lighter">Project Type</h5>
            <div class="mb-2 form-check">
                <input type="radio" class="form-check-input" id="frontEnd" value="1" name="application_type"
                    required @if (old('application_type') === '1' || ($project->is_frontend && old('application_type') === null)) checked @endif>
                <label class="form-check-label" for="frontEnd">Front End</label>
            </div>
            <div class="mb-2 form-check">
                <input type="radio" class="form-check-input" id="backEnd" value="2" name="application_type"
                    @if (old('application_type') === '2' || ($project->is_backend && old('application_type') === null)) checked @endif>
                <label class="form-check-label" for="backEnd">Back End</label>
            </div>
            <div class="mb-4 form-check">
                <input type="radio" class="form-check-input" id="fullStack" value="3" name="application_type"
                    @if (old('application_type') === '3' ||
                            ($project->is_monolith && old('application_type') === null && old('application_type') === null)) ) checked @endif>
                <label class="form-check-label" for="fullStack">Full Stack</label>
            </div>
            @error('application_type')
                @foreach ($errors->get('application_type') as $error)
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                @endforeach
            @enderror
            <!-- TYPE RADIO -->
            <!-- SELECT DIFFICULTY-->
            <label class="form-label" for="difficulty">Difficulty</label>
            <select class="form-select mb-3 w-50" id="difficulty" name="type_id">
                @foreach ($types as $type)
                    <option value="{{ $type->id }}" @if (old('type_id', $project->type_id) == $type->id) selected @endif>
                        {{ $type->difficulty }}</option>
                @endforeach
            </select>
            <!-- /SELECT DIFFICULTY-->
            @error('type_id')
                @foreach ($errors->get('type_id') as $error)
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                @endforeach
            @enderror
            <!-- CURRENT IMMAGINE -->
            @if ($project->project_img)
                <div class="border border-3 rounded w-25 py-3 text-center mb-3">
                    <h5>Current Project Picture</h5>
                    <img src="{{ asset("storage/$project->project_img") }}" alt="Current project image" class="w-75">
                </div>
            @endif
            <!-- /CURRENT IMMAGINE -->
            <!-- SWITCH UPLOAD IMMAGINE -->
            <div class="form-check form-switch mb-3 mt-4">
                <input class="form-check-input" type="checkbox" role="switch" id="update-img" value="1">
                <label class="form-check-label" for="update-img">Switch if you want to change your project
                    picture</label>
            </div>
            <!-- /SWITCH UPLOAD IMMAGINE -->
            <!-- UPLOAD IMMAGINE -->
            <div class="mb-4 d-none" id="input-img">
                <label class="form-label" for="project-img ">Project Picture</label>
                <div class="d-flex w-50">
                    <input type="file" class="form-control rounded-end-0" id="project-img" name="project_img">
                    <div role="button" class="bg-dark text-white border-0 fs-5 px-3 rounded-end-3" id="empty-img-field">
                        <i class="fa-solid fa-xmark align-middle"></i>
                    </div>
                </div>
            </div>
            <!-- /UPLOAD IMMAGINE -->
            @error('project_img')
                @foreach ($errors->get('project_img') as $error)
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                @endforeach
            @enderror
            <!-- PREVIEW IMMAGINE -->
            <div class="border border-3 rounded d-none w-25 py-3 text-center mb-3" id="preview-img">
                <h5>Current Picture Selected</h5>
                <img src="" alt="Preview Image" class="w-75">
            </div>
            <!-- /PREVIEW IMMAGINE -->
            <!-- SUBMIT -->
            <button type="submit" class="btn btn-dark mb-4">Edit <i class="fa-regular fa-paper-plane ms-1"></i></button>
            <!-- /SUBMIT -->
        </form>
        <!-- /FORM -->
    </div>
@endsection
