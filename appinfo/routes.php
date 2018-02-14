<?php
/**
 * Create your routes in here. The name is the lowercase name of the controller
 * without the controller part, the stuff after the hash is the method.
 * e.g. page#index -> OCA\Spwm\Controller\PageController->index()
 *
 * The controller class has to be registered in the application.php file since
 * it's instantiated in there
 */
return [
	'routes' => [
		['name' => 'page#index', 'url' => '/', 'verb' => 'GET'],

		// Unlock
		['name' => 'authentication#unlock', 'url' => '/api/v1/unlock', 'verb' => 'POST'],

		// Settings
		['name' => 'settings#getSettings', 'url' => '/api/v1/settings', 'verb' => 'GET'],
		['name' => 'settings#saveAdminSetting', 'url' => '/api/v1/settings/admin/{key}', 'verb' => 'POST'],

		// Admin
		['name' => 'admin#searchUser', 'url' => '/admin/search', 'verb' => 'GET'],
		['name' => 'admin#addUser', 'url' => '/admin/add/{userId}', 'verb' => 'POST']
		/*['name' => 'settings#generatePepper', 'url' => '/api/v1/settings/firstrun', 'verb' => 'GET']*/
    ]
];
