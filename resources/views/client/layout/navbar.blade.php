<nav class="main-header navbar navbar-expand navbar-white navbar-light">

    {{-- Navbar left links --}}
    <ul class="navbar-nav">

        {{-- LEFT SIDEBAR TOGGLER LINK --}}
        <li class="nav-item">
            <a href="{{route('client.products')}}" class="nav-link">
                <img src="{{ asset('/img/wings.png') }}" class="img-thumbnail" width="50px">
                Wings
            </a>
        </li>

    </ul>

    {{-- Navbar right links --}}
    <ul class="navbar-nav ml-auto">

        <li class="nav-item mr-2 mt-1">
            <a href="{{ route('checkout.page') }}"><i class="fas fa-shopping-cart text-dark">
                <span class="badge-pill badge-danger" id="cartCount">
                    {{ count(Auth::user()->carts) }}
                </span>
            </i></a>
        </li>

        {{-- USER MENU LINK --}}
        <li class="nav-item dropdown user-menu">

            {{-- USER MENU TOGGLER --}}
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <img src="{{ asset('/img/wings.png') }}" class="user-image img-circle elevation-2">
                <span class="d-none d-md-inline">
                    {{ Auth::user()->username }}
                </span>
            </a>

            {{-- User menu dropdown --}}
            <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

                {{-- User menu header --}}
                <li class="user-header">
                    <img src="{{ asset('/img/wings.png') }}" class="img-circle elevation-2">
                    <p class="mt-0">
                        {{ Auth::user()->username }}
                    </p>
                </li>

                {{-- User menu footer --}}
                <li class="user-footer">
                    <a class="btn btn-default btn-flat float-right" href="{{ route('user.logout') }}">
                        <i class="fa fa-fw fa-power-off"></i>
                        Log Out
                    </a>
                </li>

            </ul>

        </li>

    </ul>

</nav>
