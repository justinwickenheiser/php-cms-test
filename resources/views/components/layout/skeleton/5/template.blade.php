<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
	<head>
		<!-- meta -->
		<x-cms::layout.skeleton.5.header-meta />
		<!-- css -->
		<x-cms::layout.skeleton.5.header-css />
		<!-- js -->
		<x-cms::layout.skeleton.5.header-js />
		<!-- header_custom -->
		<!-- TO-DO: create header-custom.blade.php component -->
	</head>
	<body>
		<x-cms::layout.skeleton.5.header-banner />
		<x-cms::layout.skeleton.5.body-content>
			{!! $slot !!}
		</x-cms::layout.skeleton.5.body-content>
		<x-cms::layout.skeleton.5.footer-contact />
		<x-cms::layout.skeleton.5.footer-copyright />
	</body>
</html>
