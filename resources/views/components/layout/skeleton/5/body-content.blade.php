<div role="main" id="main">
	<br />
	
	@if (CMS::site()->show_content_title && CMS::page()->title && !CMS::page()->is_homepage)
		<div class="content content-header">
			<h1>
				{{ CMS::page()->title }}
			</h1>
		</div>
	@endif

	<div class="content" style="padding-bottom: 0">
		<div id="cms-content">
			{!! $slot !!}
		</div>
	</div>
	
	<div class="content">
		<div class="hide-print">
			<br />
			<hr />
			<div class="row">
				<div class="col-6">
					<span class="text-muted">
						Page last modified {{ date('F j, Y') }}
					</span>
					<a href="#" class="text-nodecoration" title="Edit this page">
						<span class="icon icon-life-ring"></span>
						<span class="sr-only">Edit this page</span>
					</a>
					<br />
					<a href="#">Logout of CMS</a>
				</div>
				<div class="col-6 text-right">
					<a href="#" class="cms-report-problem">Report a problem with this page</a>
				</div>
			</div>
		</div>
	</div>
</div>