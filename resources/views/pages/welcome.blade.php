@extends('main')

@section('title', '| Homepage')
<script src="//cdn.tinymce.com/4/tinymce.min.js"></script>

<script>
    tinymce.init({
        selector: 'textarea',
        plugins: 'link code',
        menubar: false
    });

</script>

@section('content')
    <div class="row">
        <div class="col-md-3">
            <p>Телефон: +7(423) 226-88-50</p>
            <h2>Расписание</h2>
            <em>ПРИЕМ ГРАЖДАН</em>
            <p>По рабочим дням:<br />
                С 10:00 до 17:00 <br />
                Обед с 13:00 до 14:00</p> <br />
            <u>Выходные:</u><br />
            <p>Суббота, Воскресенье</p><br />
        @if (Auth::check())
            <div>
                {!! Form::open(['route' => 'calendars.store', 'method' => 'POST', 'hidden' => 'hidden']) !!}
                    <h2>New calendar</h2>

                    {{ Form::label('year', "Year:") }}
            {{ Form::text('year', null, ['class' => 'form-control']) }}

            {{ Form::label('month', "Month:") }}
            {{ Form::text('month', null, ['class' => 'form-control']) }}

            {{ Form::label('day', "Day:") }}
            {{ Form::text('day', null, ['class' => 'form-control']) }}

            {{ Form::label('busy', "Busy:") }}
            {{ Form::text('busy', null, ['class' => 'form-control']) }}

            {{ Form::submit('Create New calendar', ['class' => 'btn btn-primary btn-block btn-h1-spacing bad']) }}

            {!! Form::close() !!}


                    <form action="{{ url('/') }}" method="POST" hidden="hidden">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label name="year2">year:</label>
                        <input id="year2" name="year2" class="form-control">
                    </div>

                    <div class="form-group">
                        <label name="month2">Тема:</label>
                        <input id="month2" name="month2" class="form-control">
                    </div>

                    <div class="form-group">
                        <label name="day2">Сообщение:</label>
                        <input  id="day2" name="day2" class="day2">
                    </div>

                    <div class="form-group">
                        <label name="busy2">Сообщение:</label>
                        <input  id="busy2" name="busy2" class="busy2">
                    </div>

                    <input type="submit" value="Send Message" class="nice">
                </form>

            </div>

            @endif

        </div>
        <div class="col-md-5">
            <div class="jumbotron">
                <h3>Добро Пожаловать!</h3>

                <p class="lead">На сайте вы можете получить информацию об предоставляемых услугах</p>
                <!--  <p><a class="btn btn-primary btn-lg" href="#" role="button">Popular Post</a></p>-->
             </div>
         </div>
        <div class="col-md-3 col-md-offset-1">
            <div class="col-md-3 col-md-offset-1">
                <?php
                 require_once 'calendar/Calendar2.php';

                 $calendar = new Calendar2();

                 echo $calendar->show();
                ?>

            </div>

        </div>
     </div> <!-- end of header .row -->

    <div class="row">
        <div class="col-md-8">

            @foreach($posts as $post)
                <div class="post">
                    <h3>{{ $post->title }}</h3>
                    <p>{!! $post->body !!}</p>
                    @if (Auth::check())
                    <a href="{{ url('posts/'.$post->id) }}" class="btn btn-primary">Редактировать</a>
                    @endif
                </div>

                <hr>

            @endforeach

        </div>


    </div>

    <input type="hidden" id="monthget" name="monthget" value="<?php  echo($calendar->getMonth()); ?>" />
    <input type="hidden" id="yearget" name="yearget" value="<?php  echo($calendar->getYear()); ?>" />
    <script>
        $('.calendar_default').dblclick(function(e) {
            var DayClicked = parseInt($(e.target).text());
            var Month = parseInt($('#monthget').val());
            var Year = parseInt($('#yearget').val());
            var Busy = parseInt('1');

            $('#day').val(DayClicked);
            $('#month').val(Month);
            $('#year').val(Year);
            $('#busy').val(Busy);
          //  $('.btn btn-primary btn-block btn-h1-spacing').submit();

            $('.bad').click(function() {
                $(this.form).trigger('submit');
            }).trigger('click');
        });

        $('.calendar_red').dblclick(function(e) {
            var DayClicked = parseInt($(e.target).text());
            var Month = parseInt($('#monthget').val());
            var Year = parseInt($('#yearget').val());
            var Busy = parseInt('1');

            $('#day2').val(DayClicked);
            $('#month2').val(Month);
            $('#year2').val(Year);
            $('#busy2').val(Busy);
            //  $('.btn btn-primary btn-block btn-h1-spacing').submit();

            $('.nice').click(function() {
                $(this.form).trigger('submit');
            }).trigger('click');
        });

    </script>
@stop