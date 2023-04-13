<div role="navigation">
	<ul>
		<!-- simple nav loop for now -->
		@foreach(CMS::navigation()->query as $navitem)
			@php
				if($navitem->content) {
					$navUrl = $navitem->content->slug;
				} else {
					$navUrl = $navitem->url;
				}
			@endphp
			<li>
				<a href="{{ $navUrl }}" target="_self">
					{{ $navitem->title }}
				</a>
			</li>
		@endforeach
	</ul>
</div>