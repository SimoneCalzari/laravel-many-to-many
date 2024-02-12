@extends('layouts.admin')


@section('content')
    <div class="container">
        <!-- TITOLO - TORNA AI TIPI -->
        <div class="d-flex align-items-center justify-content-between">
            <h1 class="fs-2 py-2">New Type</h1>
            <a href="{{ route('admin.types.index') }}" class="btn btn-dark">Back to Types<i
                    class="fa-solid fa-backward ms-3"></i></a>
        </div>
        <!-- /TITOLO - TORNA AI TIPI -->
        <!-- FORM -->
        <form action="{{ route('admin.types.store') }}" method="POST">
            @csrf
            <!-- DIFFICOLTA -->
            <div class="mb-3">
                <label for="difficulty" class="form-label">Difficulty</label>
                <input type="text" class="form-control @error('difficulty') is-invalid  @enderror" id="difficulty"
                    name="difficulty" required value="{{ old('difficulty') }}">
            </div>
            @error('difficulty')
                @foreach ($errors->get('difficulty') as $error)
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                @endforeach
            @enderror
            <!-- DIFFICOLTA -->
            <!-- TEAM RADIO -->
            <h5 class="fs-6 mb-2">Team or Individual</h5>
            <div class="mb-2 form-check">
                <input type="radio" class="form-check-input" id="team" value="1" name="is_team_project" required
                    @if (old('is_team_project') === '1') checked @endif>
                <label class="form-check-label" for="team">Team</label>
            </div>
            <div class="mb-2 form-check">
                <input type="radio" class="form-check-input" id="individual" value="0" name="is_team_project"
                    @if (old('is_team_project') === '0') checked @endif>
                <label class="form-check-label" for="individual">Individual</label>
            </div>
            @error('is_team_project')
                @foreach ($errors->get('is_team_project') as $error)
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                @endforeach
            @enderror
            <!-- TEAM RADIO -->
            <!-- SUBMIT -->
            <button type="submit" class="btn btn-dark mt-2">Create <i class="fa-regular fa-paper-plane ms-1"></i></button>
            <!-- /SUBMIT -->
        </form>
        <!-- /FORM -->
    </div>
@endsection
