<!-- Make this child component away of the parent $cms variable from the template parent -->
@aware([
	'cms'
])

@if($cms->site->useAnalytics ?? false)
<!-- <cfIf cms.site.useAnalytics> -->
	<!-- Google Analytics -->
<!-- </cfIf> -->
@endif
<!--[if lte IE 8]>
	<script src="//cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.js"></script>
<![endif]-->
<script src="{{ asset('cms/skeleton/5/js/cms4.2.min.js') }}"></script>