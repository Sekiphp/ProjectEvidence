@extends('layouts.app')

@section('content')
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">Založit nový projekt</div>

            <div class="panel-body">
                {!! Form::open(['url' => '/project/new']) !!}
                    <table class='table'>
                        <tr>
                            <th class='col-md-3'>{{ Form::label('name', 'Název projektu') }}</th>
                            <td>{{ Form::text('name', '', null, array()) }}</td>
                        </tr>
                        <tr>
                            <th>{{ Form::label('end_date', 'Předpokládané datum odevzdání') }}</th>
                            <td>{{ Form::date('end_date') }}</td>
                        </tr>
                        <tr>
                            <th>{{ Form::label('project_type', 'Typ projektu') }}</th>
                            <td>{{ Form::select('project_type', $project_types, '1') }}</td>
                        </tr>
                        <tr>
                            <th>{{ Form::label('is_web', 'Webový projekt?') }}</th>
                            <td>{{ Form::checkbox('is_web', '1', true) }}</td>
                        </tr>
                        <tr>
                            <th colspan='2'>{{ Form::submit('Vytvořit projekt', array('class' => 'btn btn-success')) }}</th>
                        </tr>
                    </table>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
@endsection
