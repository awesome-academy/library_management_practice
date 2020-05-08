    <!-- Responsive Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg_tool fixed-top">
        <a class="navbar-brand" href="{{ route('home') }}">{{ trans('partials/navbar.libra') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse nav_left" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active li_left">
                    <a class="nav-link" href="{{ route('home') }}">{{ trans('partials/navbar.home') }}</a>
                </li>
                <li class="nav-item ">
                    <a class="nav-link" href="{{ route('books.index') }}">{{ trans('partials/navbar.book') }}
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ trans('partials/navbar.category') }}</a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="">Action</a>
                        <a class="dropdown-item" href="#">Fantasy</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="{{-- {{ route('categories.index') }} --}}">{{ trans('partials/navbar.more') }}</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a href=" {{ route('authors.index') }} " class="nav-link">{{ trans('partials/navbar.author') }}</a>
                </li>
                <li class="nav-item">
                    <a href=" {{ route('publishers.index') }} " class="nav-link">{{ trans('partials/navbar.publisher') }}</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('users.index') }}" class="nav-link">{{ trans('partials/navbar.user')}}</a>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">{{ trans('partials/navbar.us') }}</a>
                </li>
            </ul>
            <!-- Right Side Of Navbar -->
            <ul class="navbar-nav ml-auto">
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ trans('partials/navbar.login') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ trans('partials/navbar.register') }}</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            <i>{{trans('partials/navbar.hi')}} {{ Auth::user()->name }}</i> <span class="caret"></span>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            @csrf
                            <a class="dropdown-item" href="{{ route('logout') }}">
                                {{ trans('partials/navbar.logout') }}
                            </a>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>
    <!-- Responsive Navigation Bar -->
    <main >
            @yield('content')
    </main>
