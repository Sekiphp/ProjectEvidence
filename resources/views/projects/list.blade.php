@extends('layouts.app')

@section('content')
<div class="col-md-12">
    <div class="panel panel-primary">
        <div class="panel-heading">Přehled projektů</div>

        <div class="panel-body">
            @if (session('status'))
                <div class="alert alert-success">
                    {{ session('status') }}
                </div>
            @endif

            <table class='table table-bordered table-stripped'>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Název</th>
                        <th>Datum dokončení</th>
                        <th>Typ</th>
                        <th>Webový?</th>
                        <th>Akce</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($projects as $project)
                    <tr>
                        <td>{{ $project->id }}</td>
                        <td>{{ $project->name }}</td>
                        <td>{{ Carbon\Carbon::parse($project->end_date)->format('j. n. Y') }}</td>
                        <td>{{ $project->projectType->name }}</td>
                        <td>{{ $project->is_web ? "Ano" : "Ne" }}</td>
                        <td>
                            <a href='{{ route('project.delete.id', ['id' => $project->id]) }}' class='btn btn-danger'>Smazat</a>
                            <a href='{{ route('project.edit.show.id', ['id' => $project->id]) }}' class='btn btn-primary'>Upravit</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan='6'>V systému nejsou zadány žádné projekty!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
