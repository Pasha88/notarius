<div class="row">
    <div class="col-md-12">
    <header>
        <img class="img-responsive" src="logo.png" alt="Нотариус">
    </header>
     </div>
</div>

<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/">Нотариус VL</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="{{ Request::is('/') ? "active": ""}}"><a href="/">Главная</a></li>
                <li class="{{ Request::is('service') ? "active": ""}}"><a href="/services">Услуги</a></li>
                <li class="{{ Request::is('about') ? "active": ""}}"><a href="/rates">Тарифы</a></li>
                <li class="dropdown">
                    <a href="/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Информация <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/common">Общая Информация</a></li>
                        <li><a href="/heirs">Наследникам</a></li>
                        <li><a href="/estate">Сделки с недвижимостью</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="/corporate">Юридические лица</a></li>
                    </ul>
                </li>
                <li class="{{ Request::is('contact') ? "active": ""}}"><a href="/contact">Контакты</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                @if (Auth::check())

                    <li class="dropdown">
                        <a href="/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Hello {{ Auth::user()->name }} <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('posts.index') }}">Posts</a></li>
                            <li><a href="{{ route('categories.index') }}">Categories</a></li>
                            <li><a href="{{ route('tags.index') }}">Tags</a></li>
                           <li><a href="{{ route('calendars.index') }}">Calendars</a></li>
                            <li role="separator" class="divider"></li>
                            <li><a href="{{ route('logout') }}">Logout</a></li>
                        </ul>
                    </li>

                @else

                    <a href="{{ route('login') }}" class="btn btn-default">Login</a>

                @endif

            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
