@extends('layouts.admin')


@section('content')
    <div class="container">
        <!-- TITOLO - TORNA ALLE TECNOLOGIE -->
        <div class="d-flex align-items-center justify-content-between">
            <h1 class="fs-2 py-2">Edit Technology</h1>
            <a href="{{ route('admin.technologies.index') }}" class="btn btn-dark">Back to Technologies<i
                    class="fa-solid fa-backward ms-3"></i></a>
        </div>
        <!-- /TITOLO - TORNA ALLE TECNOLOGIE-->
        <!-- FORM -->
        <form action="{{ route('admin.technologies.update', $technology) }}" method="POST">
            @csrf
            @method('PUT')
            <!-- NOME -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control @error('name') is-invalid  @enderror" id="name"
                    name="name" required value="{{ old('name', $technology->name) }}">
            </div>
            @error('name')
                @foreach ($errors->get('name') as $error)
                    <div class="alert alert-danger">
                        {{ $error }}
                    </div>
                @endforeach
            @enderror
            <!-- NOME -->
            <!-- SUBMIT -->
            <button type="submit" class="btn btn-dark mt-2">Edit<i class="fa-regular fa-paper-plane ms-1"></i></button>
            <!-- /SUBMIT -->
        </form>
        <!-- /FORM -->
    </div>
@endsection
