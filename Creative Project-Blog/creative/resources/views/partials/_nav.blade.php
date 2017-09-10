<!-- Default Bootstrap Navbar -->
<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
{{--                 <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span> --}}
            </button>
            <a class="navbar-brand" href="{{ url('/welcome') }}"><span class="glyphicon glyphicon-home"></span> Posts</a>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="/"><span class="glyphicon glyphicon-align-left"></span> Home</a></li>
                <li><a href="/about"><span class="glyphicon glyphicon-heart-empty"></span> About</a></li>
                {{--<li><a href="/contact">Contact</a></li> --}}

            </ul>
            <div class="nav navbar-nav navbar-right">
                @if (Auth::check())
                <li class="dropdown">
                    <a href="/" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}  <span class="glyphicon glyphicon-triangle-bottom"></span> </a>
                    <ul class="dropdown-menu">
                        <li><a href="{{ route('categories.index') }}">Categories</a></li>
                        <li><a href="{{ route('posts.create') }}">Post</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ url('auth/logout') }}">Logout</a></li>
                    </ul>
                </li>
                @else
                <a href="{{ url('auth/login') }}" class="btn btn-default btn-lg ">Login</a> @endif
            </div>
        </div>
        <!-- Collect the nav links, forms, and other content for toggling -->
        <!-- /.navbar-collapse -->
    </div>
    <!-- /.container-fluid -->
</nav>
