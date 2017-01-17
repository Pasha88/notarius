@extends('main')

@section('title', '| All calendars')

@section('content')

	<div class="row">
		<div class="col-md-8">
			<h1>calendars</h1>
			<table class="table">
				<thead>
					<tr>
						<th>Номер</th>
						<th>Год</th>
						<th>Месяц</th>
						<th>День</th>
					</tr>
				</thead>

				<tbody>
					@foreach ($calendars as $calendar)
					<tr>
						<th>{{ $calendar->id }}</th>
						<td><a href="{{ route('calendars.show', $calendar->id) }}">{{ $calendar->year }}</a></td>
						<th>{{ $calendar->month }}</th>
						<th>{{ $calendar->day }}</th>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div> <!-- end of .col-md-8 -->

		<div class="col-md-3">
			<div class="well">
				{!! Form::open(['route' => 'calendars.store', 'method' => 'POST']) !!}
					<h2>New calendar</h2>

					{{ Form::label('year', "Year:") }}
					{{ Form::text('year', null, ['class' => 'form-control']) }}

					{{ Form::label('month', "Month:") }}
					{{ Form::text('month', null, ['class' => 'form-control']) }}

					{{ Form::label('day', "Day:") }}
					{{ Form::text('day', null, ['class' => 'form-control']) }}

					{{ Form::label('busy', "Busy:") }}
					{{ Form::text('busy', null, ['class' => 'form-control']) }}

					{{ Form::submit('Create New calendar', ['class' => 'btn btn-primary btn-block btn-h1-spacing']) }}
				
				{!! Form::close() !!}
			</div>
		</div>
	</div>

@endsection