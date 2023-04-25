<?php

return [
	/*
	|--------------------------------------------------------------------------
	| Authentication Guards
	|--------------------------------------------------------------------------
	|
	| By default, Statamic will use the `web` authentication guard. However,
	| if you want to run Statamic alongside the default Laravel auth
	| guard, you can configure that for your cp and/or frontend.
	|
	*/

	'guards' => [
		'admin' => 'cms_admin',
		'web' => 'web',
	],
];