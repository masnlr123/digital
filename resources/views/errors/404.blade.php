<html lang="en">

	<!-- begin::Head -->
	<head>
		<meta charset="utf-8" />
		<title>{{ config('app.name', 'Digital Labs') }}</title>
		<meta name="description" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!--begin::Fonts -->
		<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700|Roboto:300,400,500,600,700">

		<!--end::Fonts -->

		<!--begin::Page Custom Styles(used by this page) -->
		<link href="{{ asset('assets/css/pages/error/error-6.css') }}" rel="stylesheet" type="text/css" />

		<!--end::Page Custom Styles -->

		<!--begin::Global Theme Styles(used by all pages) -->
		<link href="{{ asset('assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
		<link href="{{ asset('assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
		<style type="text/css">
			.kt-error-v6 .kt-error_container .kt-error_subtitle > h1 {
			    font-size: 10rem;
			    margin-top: 1rem !important;
			}
			.kt-error-v6 .kt-error_container .kt-error_subtitle > h2{
			    font-size: 3rem;
			    margin-top: 1rem !important;
			}
			.kt-error-v6 .kt-error_container .kt-error_description{
			    font-size: 2rem !important;
			    margin-top: 5px !important;
			}
			.return-dashboard{
				background: #ff9800;
			    border: 2px solid #fff;
			    border-radius: 30px;
			    padding: 10px 25px;
			    font-weight: bold;
			    color:#fff;
			}
			.return-dashboard:hover{
			    color:#fff;
			    background: #f57c00;
			}
		</style>

		<!--end::Global Theme Styles -->

		<!--begin::Layout Skins(used by all pages) -->

		<!--end::Layout Skins -->
		<link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
	</head>

	<!-- end::Head -->

	<!-- begin::Body -->
	<body class="kt-quick-panel--right kt-demo-panel--right kt-offcanvas-panel--right kt-header--fixed kt-header-mobile--fixed kt-subheader--enabled kt-subheader--transparent kt-aside--enabled kt-aside--fixed kt-aside--minimize kt-page--loading">

		<!-- begin:: Page -->
		<div class="kt-grid kt-grid--ver kt-grid--root kt-page">
			<div class="kt-grid__item kt-grid__item--fluid kt-grid  kt-error-v6" style="background-image: url({{ asset('assets/media/error/bg6.jpg') }});">
				<div class="kt-error_container">
					<div class="kt-error_subtitle kt-font-light">
						<h1>Oops...</h1>
						<h2>404 - Not Found</h2>
					</div>
					<p class="kt-error_description kt-font-light">
						Looks like Data Missing. We're working on it!<br>
						<a href="{{ url('/') }}" class="btn return-dashboard mt-4"><i class="flaticon-reply"></i> Return to Dashboard</a>
					</p>
				</div>
			</div>
		</div>
		<!--begin::Global Theme Bundle(used by all pages) -->
		<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}" type="text/javascript"></script>
		<script src="{{ asset('assets/js/scripts.bundle.js') }}" type="text/javascript"></script>

		<!--end::Global Theme Bundle -->
	</body>

	<!-- end::Body -->
</html>