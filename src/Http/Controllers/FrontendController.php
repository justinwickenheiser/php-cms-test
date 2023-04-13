<?php

namespace GvsuWebTeam\Cms\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

use GvsuWebTeam\Cms\Models\Site;
use GvsuWebTeam\Cms\Models\Content;

class FrontendController extends Controller
{
	/**
	 * Return the content page
	 * 
	 * @return view
	 */
	public function index(Request $request, Site $site, Content $content = null) {
		if ($content === null) {
			$content = $site->contents->where('is_homepage', 1)->first();
			
		} else {
			// $content->load([
			// 	'wrappers' => function (HasMany $query) {
			// 		$query->orderBy('position', 'asc');
			// 	}, 
			// 	'wrappers.wrapperchunks' => function(HasMany $query) {
			// 		$query->orderBy('position', 'asc');
			// 	}, 
			// 	'wrappers.wrapperchunks.chunk'
			// ]);
		}
		
		return view('cms::skeleton.index', [
			'site' => $site,
			'content' => $content,
		]);
	}
}
