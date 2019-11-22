<?php
return [
    'routes' => [
        [
            'name' => 'conversion#convertHere',
            'url'  => 'ajax/convertHere.php',
            'verb' => 'POST'
		],
		[
			'name' => 'preset#index',
			'url'  => '/preset',
			'verb' => 'GET'
		],
		[
			'name' => 'preset#get',
			'url'  => '/preset/{id}',
			'verb' => 'GET'
		],
		[
			'name' => 'preset#create',
			'url'  => '/preset',
			'verb' => 'POST'
		],
		[
			'name' => 'preset#update',
			'url'  => '/preset/{id}',
			'verb' => 'PUT'
		],
		[
			'name' => 'preset#remove',
			'url'  => "/preset/{id}",
			'verb' => 'DELETE'
		],
    ],
];
