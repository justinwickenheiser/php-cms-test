<!-- Make this child component away of the parent $cms variable from the template parent -->
@aware([
	'cms'
])

<!--- Google fonts (EB Garamond and Lato) --->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="preload" href="https://fonts.googleapis.com/css2?family=EB+Garamond&family=Lato:wght@400;700&display=swap" as="style" onload="this.onload=null;this.rel='stylesheet'" />
<noscript>
	<link href="https://fonts.googleapis.com/css2?family=EB+Garamond&family=Lato:wght@400;700&display=swap" rel="stylesheet">
</noscript>
<!--- CMS CSS --->
<!-- <link rel="preconnect" href="<cfOutput>#encodeForHtmlAttribute(server.url)#</cfOutput>">
<link rel="preconnect" href="<cfOutput>#encodeForHtmlAttribute(server.url)#</cfOutput>" crossorigin>
<link rel="preload" href="<cfOutput>#getAssetCacheUrl(url='/cms4/skeleton/2/files/css/icons.css',isSiteFile=false)#</cfOutput>" as="style" onload="this.onload=null;this.rel='stylesheet'" />
<link rel="preload" href="<cfOutput>#getAssetCacheUrl(url='/cms4/skeleton/2/files/css/styles.css',isSiteFile=false)#</cfOutput>" as="style" onload="this.onload=null;this.rel='stylesheet'" />
<noscript> -->
	<link href="{{ asset('vendor/gvsu-web-team/cms/skeleton/5/css/icons.css') }}" rel="stylesheet">
	<link href="{{ asset('vendor/gvsu-web-team/cms/skeleton/5/css/styles.css') }}" rel="stylesheet">
<!-- </noscript> -->
<!--- Site specific CSS (default: /path/files/css/base.css) --->
<!-- <cfIf fileExists("/www/gvsu#cms.site.css#")>
	<link rel="preload" href="<cfOutput>#encodeForHtmlAttribute(cms.site.css)#</cfOutput>" as="style" onload="this.onload=null;this.rel='stylesheet'" />
	<noscript>
		<link href="<cfOutput>#encodeForHtmlAttribute(cms.site.css)#</cfOutput>" rel="stylesheet" />
	</noscript>
</cfIf> -->