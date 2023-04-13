<header>
	<div id="skip">
		<a href="#main" class="focus-inverted">Skip to main content</a>
	</div>
	<div class="header">
		<div class="row content">
			<div class="col-5 col-sm-12 logo">
				<div class="col-12 col-sm-9">
					<h1>
						<a href="/">
							<!--[if lte IE 8|!IE]>
								<img src="{{asset('cms/skeleton/5/img/gvsu_logo_white.png')}}" alt="Grand Valley State University Logo" width="600" height="53" />
							<![endif]-->
							<!--[if gte IE 9|!IE]><!-->
								<img src="{{asset('vendor/gvsu-web-team/cms/skeleton/5/img/gvsu_logo_white.svg')}}" alt="Grand Valley State University Logo" onerror="this.onerror=null;this.src='{{asset("vendor/gvsu-web-team/cms/skeleton/5/img/gvsu_logo_white.png")}}'" width="600" height="53" />
							<!--<![endif]-->
							<span id="gv-logo-label" class="sr-only" aria-hidden="true">Grand Valley State University</span>
						</a>
					</h1>
				</div>
				
				<!-- <cfIf cms.navigation.placement NEQ "none" AND cms.navigation.query.recordCount> -->
					<div class="hide-lg hide-md col-sm-3">
						<a href="cms-siteindex-index.htm" id="gv-hamburger" role="button" tabindex="0" aria-label="Menu">
							<span class="icon icon-bars" aria-hidden="true"></span>
						</a>
					</div>
				<!-- </cfIf> -->
			</div>
			<div class="col-7 col-sm-12 quick hide-print" style="display: block !important">
				<form class="search" action="/searchaction.htm" role="search">
					<input type="hidden" name="media" value="search" />
					<input type="hidden" name="path" value="/{{CMS::site()->path}}" />
					<input type="hidden" name="title" value="{{CMS::site()->title}}" />
					<h2 class="sr-only">
						<label for="gv-search-input">Search People & Pages</label>
					</h2>
					<span class="icon icon-search" aria-hidden="true"></span>
					<input type="text" name="search" id="gv-search-input" size="25" maxlength="255" placeholder="Search People & Pages" />
					<button type="submit" class="btn btn-default sr-only" aria-hidden="true" tabindex="-1">Submit</button>
				</form>
			</div>
			<script>
				document.querySelector('.quick').style.display = '';
			</script>
		</div>
	</div>
	<div class="site">
		<div class="content">
			<h1 class="h2 serif color-black padding-none margin-none">
				<a href="/{{CMS::site()->path}}" class="color-black">
					{{CMS::site()->title}}
				</a>
			</h1>
		</div>
	</div>
	<!-- <cfIf cms.navigation.placement EQ "horizontal" AND cms.navigation.query.recordCount> -->
	@if(CMS::navigation()->query->count())
		<div id="cms-navigation" class="navigation hide-sm hide-print">
			<div class="content">
				<x-cms::layout.skeleton.5.navigation_menu />
			</div>
		</div>
	@endif
	<!-- </cfIf> -->
</header>
