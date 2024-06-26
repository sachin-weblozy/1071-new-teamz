<!DOCTYPE html>
<html lang="en" dir="ltr" data-bs-theme="light" data-color-theme="Blue_Theme" data-layout="vertical">

<head>
  <!-- Required meta tags -->
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <!-- Favicon icon-->
  <link rel="shortcut icon" type="image/png" href="{{ asset('favicon.ico') }}" />

  <!-- Core Css -->
  <link rel="stylesheet" href="{{ asset('assets/css/styles.css') }}" />

  <title>{{ config('app.name', 'Weblozy') }}</title>
</head>
	
	<body class="sign-inup" id="body" style="background-image: linear-gradient(to right top, #051937, #0b4066, #046b96, #009bc3, #12cdeb);">

		<div id="main-wrapper">
			{{ $slot }}
		</div>
		
		<div class="dark-transparent sidebartoggler"></div>
		<!-- Import Js Files -->
		<script src="{{ asset('assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
		<script src="{{ asset('assets/libs/simplebar/dist/simplebar.min.js') }}"></script>
		<script src="{{ asset('assets/js/theme/app.init.js') }}"></script>
		<script src="{{ asset('assets/js/theme/theme.js') }}"></script>
		<script src="{{ asset('assets/js/theme/app.min.js') }}"></script>
	  
		<!-- solar icons -->
		<script src="https://cdn.jsdelivr.net/npm/iconify-icon@1.0.8/dist/iconify-icon.min.js"></script>
	</body>
</html>