@extends('main')

@section('title', "| $calendar->id calendar")

@section('content')

	<div class="row">
		<div class="col-md-8">
			<h1>{{ $calendar->id }} calendar <small> Posts</small></h1>
		</div>
		<div class="col-md-2">
			<a href="{{ route('calendars.edit', $calendar->id) }}" class="btn btn-primary pull-right btn-block" style="margin-top:20px;">Edit</a>
		</div>
		<div class="col-md-2">
			{{ Form::open(['route' => ['calendars.destroy', $calendar->id], 'method' => 'DELETE']) }}
				{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-block', 'style' => 'margin-top:20px;']) }}
			{{ Form::close() }}
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
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
		</div>
	</div>

@endsection