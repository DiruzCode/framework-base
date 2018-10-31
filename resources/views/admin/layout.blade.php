<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME') }}</title>

	<!-- Favicon -->

    @yield('css-scripts')

    <link href="{{ mix('/css/admin.css') }}" rel="stylesheet">
    <link href="{{ mix('/css/resources.css') }}" rel="stylesheet">

</head>

<body class="nav-md">
    <div class="container body">
        <div class="main_container">
            <div class="col-md-3 left_col">
                @include('admin.includes.sidebar')
            </div>

            <!-- top navigation -->
            <div class="top_nav">
                <div class="nav_menu">
                    <nav>
                        <div class="nav toggle">
                            <a id="menu_toggle">
                                <i class="fa fa-bars"></i>
                            </a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                          <li>
                            <i class="fa fa-sign-out pull-right"></i></a>
                            <a class="dropdown-item" href="{{route('admin::logout')}}">Salir</a>
                          </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- /top navigation -->

            <!-- page content -->
            @yield('content')
            <!-- /page content -->

            <!-- footer content -->
            <footer>
                <div class="pull-right">
                    Admin Panel Laravel
                </div>
                <div class="clearfix"></div>
            </footer>
            <!-- /footer content -->
        </div>
    </div>

    <script src="{{ mix('/js/admin.js') }}"></script>
    <script src="{{ mix('/js/resources.js') }}"></script>

    @include('admin.includes.toast')
    @yield('js-validation')

    @yield('js-scripts')


</body>

</html>
