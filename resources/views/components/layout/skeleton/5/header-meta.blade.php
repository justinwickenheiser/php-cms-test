<title>
	@if(strlen(CMS::page()->meta_title))
		{{ CMS::page()->meta_title }} -
	@elseif(strlen(CMS::page()->title) && !CMS::page()->is_homepage)
		{{ CMS::page()->title }} -
	@endif
	{{ CMS::site()->title }} - Grand Valley State University
</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
@if(CMS::page()->description)
	<meta name="description" content="{{ CMS::page()->description }}" />
@elseif(CMS::site()->description && CMS::page()->is_homepage)
	<meta name="description" content="{{ CMS::site()->description }}" />
@endif

<!-- <cfIf len(trim(sb.robots))> -->
	<!--- custom specific robots? --->
	<!-- <meta name="robots" content="<cfOutput>#encodeForHtmlAttribute(sb.robots)#</cfOutput>" /> -->
<!-- <cfElseIf len(trim(sb.error))> -->
	<!--- don't index or follow pages with errors --->
	<!-- <meta name="robots" content="noindex,nofollow" /> -->
<!-- <cfElse> -->
	<!--- a normal nice page --->
	<meta name="robots" content="index,follow" />
<!-- </cfIf> -->
