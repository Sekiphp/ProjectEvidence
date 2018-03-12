@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Upravit projekt: {{ $project['name'] }}</div>

            <div class="panel-body">
                {!! Form::open(['url' => ['/project/edit', $project->id]]) !!}
                    <table class='table'>
                        <tr>
                            <th class='col-md-3'>{{ Form::label('name', 'Název projektu') }}</th>
                            <td>{{ Form::text('name', $project['name'], null, array()) }}</td>
                        </tr>
                        <tr>
                            <th>{{ Form::label('end_date', 'Předpokládané datum odevzdání') }}</th>
                            <td>{{ Form::date('end_date', $project['end_date']) }}</td>
                        </tr>
                        <tr>
                            <th>{{ Form::label('project_type', 'Typ projektu') }}</th>
                            <td>{{ Form::select('project_type', $project_types, $project->projectType->id) }}</td>
                        </tr>
                        <tr>
                            <th>{{ Form::label('is_web', 'Webový projekt?') }}</th>
                            <td>{{ Form::checkbox('is_web', '', $project['is_web']) }}</td>
                        </tr>
                        <tr>
                            <th colspan='2'>{{ Form::submit('Upravit projekt', array('class' => 'btn btn-success')) }}</th>
                        </tr>
                    </table>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection
