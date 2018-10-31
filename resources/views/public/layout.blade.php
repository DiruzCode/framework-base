<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
	<title>
        @yield('title')
    </title>
    
	<meta charset="UTF-8">
	<meta name="description" content="">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="format-detection" content="telephone=no" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @yield('metas')

	<!-- Main style -->
	<link rel="stylesheet" href="{{ mix('/css/public.css') }}">

</head>

<body>

	<!--[if lt IE 9]>
			<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->

	<div class="wrapp-content">

        <!-- Header -->
		<header>
        </header>

        <!-- Content -->
		<main>
            @yield('content')
        </main>

		<!-- Footer -->
		<footer>
        </footer>

	</div>

    <script src="{{ mix('/js/public.js') }}"></script>
</body>

</html>