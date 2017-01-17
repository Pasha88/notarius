@extends('main')

@section('title', "| Edit calendar")

@section('content')
	
	{{ Form::model($calendar, ['route' => ['calendars.update'], 'method' => "PUT"]) }}
		
		{{ Form::label('year', "Year:") }}
		{{ Form::text('year', null, ['class' => 'form-control']) }}

		{{ Form::label('month', "Month:") }}
		{{ Form::text('month', null, ['class' => 'form-control']) }}

		{{ Form::label('day', "Day:") }}
		{{ Form::text('day', null, ['class' => 'form-control']) }}

		{{ Form::label('busy', "Busy:") }}
		{{ Form::text('busy', null, ['class' => 'form-control']) }}

		{{ Form::submit('Save Changes', ['class' => 'btn btn-success', 'style' => 'margin-top:20px;']) }}
	{{ Form::close() }}

@endsection