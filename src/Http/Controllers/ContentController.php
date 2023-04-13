<?php

namespace GvsuWebTeam\Cms\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use GvsuWebTeam\Cms\Models\Site;
use GvsuWebTeam\Cms\Models\Content;

class ContentController extends Controller
{
	/**
	 * Display a listing of the resource.
	 */
	public function index(Site $site)
	{
		$contents = $site->contents()->simplePaginate(15);
		return view('cms::admin.content.index', [
			'site' => $site, 
			'contents' => $contents
		]);
	}

	/**
	 * Show the form for creating a new resource.
	 */
	public function create(Site $site)
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 */
	public function store(Request $request, Site $site)
	{
		//
	}

	/**
	 * Display the specified resource.
	 */
	// public function show($path,ontent $content)
	public function show($path, $content_id = null)
	{
		// $contentSlugArray = explode('-',$content_id);
		// $contentSlug = end($contentSlugArray);

		// $site = Site::where('path', $path)->firstOrFail();
		// if ($contentSlug) {
		// 	$content = Content::where('site_id', $site->id)->where('slug_id', $contentSlug)->firstOrFail();
		// } else {
		// 	// No content slug would just be www/gvsu/path/content_id == www/gvsu/path/ == cms site homepage
		// 	$content = Content::where('site_id', $site->id)->where('is_homepage', 1)->firstOrFail();
		// }
		
		// $cms = new CMS($site, $content);
		// return view('cms.skeleton.index', [
		// 	'cms' => $cms
		// ]);
	}

	/**
	 * Show the form for editing the specified resource.
	 */
	public function edit(Content $content)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 */
	public function update(Request $request, Content $content)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 */
	public function destroy(Content $content)
	{
		//
	}
}
