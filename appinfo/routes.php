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

		// Authentication
		['name' => 'authentication#unlock', 'url' => '/api/v1/unlock', 'verb' => 'POST'],
		// Todo: lock => delete session value

		// Settings
		['name' => 'settings#getSettings', 'url' => '/api/v1/settings', 'verb' => 'GET'],
		['name' => 'settings#saveAdminSetting', 'url' => '/api/v1/settings/admin/{key}', 'verb' => 'POST'],

		// Admin
		['name' => 'admin#searchUser', 'url' => '/admin/users/search', 'verb' => 'GET'],
		['name' => 'admin#addUser', 'url' => '/admin/users/add/{userId}', 'verb' => 'POST'],
		['name' => 'admin#getUsers', 'url' => '/admin/users', 'verb' => 'GET'],
		['name' => 'admin#getGroups', 'url' => '/admin/groups', 'verb' => 'GET'],
		['name' => 'admin#addGroup', 'url' => '/admin/groups/add/{name}', 'verb' => 'POST'],
		
		// Credential
		['name' => 'credential#createCredential', 'url' => '/api/v1/credential', 'verb' => 'POST'],
		['name' => 'credential#getCredential', 'url' => '/api/v1/credential/{item_id}', 'verb' => 'GET'],
    ]
];
