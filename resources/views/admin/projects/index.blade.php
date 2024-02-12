@extends('layouts.admin')


@section('content')
    <div class="container">
        <!-- TITOLO - NUOVO PROGETTO - ALERT -->
        <div class="d-flex align-items-center justify-content-between">
            <h1 class="fs-2 py-2">My personal projects</h1>
            <a href="{{ route('admin.projects.create') }}" class="btn btn-dark">New Project<i
                    class="fa-solid fa-plus ms-3"></i></a>
        </div>
        @if (session('new_record'))
            <div class="alert alert-success" role="alert">
                {{ session('new_record') }}
            </div>
        @endif
        @if (session('delete_record'))
            <div class="alert alert-danger" role="alert">
                {{ session('delete_record') }}
            </div>
        @endif
        <!-- /TITOLO - NUOVO PROGETTO - ALERT -->
        <!-- TABLE-->
        <table class="table table-bordered table-dark table-striped text-center">
            <!-- TABLE HEAD-->
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Title</th>
                    <th>Stack</th>
                    <th>Slug</th>
                    <th></th>
                </tr>
            </thead>
            <!-- /TABLE HEAD-->
            <!-- TABLE BODY-->
            <tbody>
                @foreach ($projects as $project)
                    <tr class="align-middle">
                        <td>{{ $project->id }}</th>
                        <td>{{ $project->title }}</td>
                        <td>{{ $project->technologies_stack }}</td>
                        <td>{{ $project->slug }}</td>
                        <td style="width: 30%">
                            <a href="{{ route('admin.projects.show', $project) }}" class="btn btn-secondary btn-sm">Details
                                <i class="fa-solid fa-circle-info ms-1"></i></a>
                            <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-primary btn-sm mx-2">Edit
                                <i class="fa-solid fa-pen-to-square ms-1"></i></a>
                            <!-- FORM CANCELLAZIONE RIGA  -->
                            <form action="{{ route('admin.projects.destroy', $project) }}" method="POST"
                                class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <!-- BUTTON CHE APRE LA MODALE -->
                                <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#modale-delete{{ $project['id'] }}">
                                    Delete <i class="fa-solid fa-trash-can ms-1"></i>
                                </button>
                                <!-- /BUTTON CHE APRE LA MODALE -->
                                <!-- MODALE -->
                                <div class="modal fade" id="modale-delete{{ $project['id'] }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content text-black">
                                            <!-- MODALE HEADER -->
                                            <div class="modal-header">
                                                <h3 class="modal-title fs-5">Delete project Confirmation</h3>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <!-- /MODALE HEADER -->
                                            <!-- MODALE BODY -->
                                            <div class="modal-body text-start">
                                                <p>Are you sure you want to delete {{ $project['title'] }}?</p>
                                            </div>
                                            <!-- /MODALE BODY -->
                                            <!-- MODALE FOOTER -->
                                            <div class="modal-footer">
                                                <!-- BUTTON CHIUSURA MODALE -->
                                                <button type="button" class="btn btn-primary"
                                                    data-bs-dismiss="modal">No</button>
                                                <!-- /BUTTON CHIUSURA MODALE -->
                                                <!-- BUTTON SUBMIT FORM PER CANCELLARE RIGA -->
                                                <button type="submit" class="btn btn-danger">Yes</button>
                                                <!-- /BUTTON SUBMIT FORM PER CANCELLARE RIGA -->
                                            </div>
                                            <!-- /MODALE FOOTER -->
                                        </div>
                                    </div>
                                </div>
                                <!-- /MODALE -->
                            </form>
                            <!-- /FORM CANCELLAZIONE RIGA  -->
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <!-- /TABLE BODY-->
        </table>
        <!-- /TABLE-->
    </div>
@endsection
