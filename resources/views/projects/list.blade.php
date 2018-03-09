@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
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
                                <th>Datum</th>
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
                                    <td>{{ $project->end_date }}</td>
                                    <td>{{ $project->project_type->name }}</td>
                                    <td>{{ $project->is_web ? "Ano" : "Ne" }}</td>
                                    <td>
                                        <a href='' class='btn btn-danger'>Smazat</a>
                                        <a href='' class='btn btn-primary'>Upravit</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan='6'>V systému nejsou žádné projekty!</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
