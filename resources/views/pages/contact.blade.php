@extends('main')

@section('title', '| Contact')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <p> Телефон: +7(423) 226-88-50  </p>
            <p> Адрес: Владивосток, район "Центр", ул. Светланская, 108б оф. 2 </p>
            <p> Email: eltinsk@mail.ru </p>
            <h1>Контакт:</h1>
            <hr>
            <form action="{{ url('contact') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label name="email">Email:</label>
                    <input id="email" name="email" class="form-control">
                </div>

                <div class="form-group">
                    <label name="subject">Тема:</label>
                    <input id="subject" name="subject" class="form-control">
                </div>

                <div class="form-group">
                    <label name="message">Сообщение:</label>
                    <textarea id="message" name="message" class="form-control">Напишите здесь ваше сообщение...</textarea>
                </div>

                <input type="submit" value="Послать сообщение" class="btn btn-success">
            </form>
        </div>
    </div>
@endsection