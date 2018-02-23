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
		// Users
		['name' => 'admin#searchUser', 'url' => '/admin/users/search', 'verb' => 'GET'],
		['name' => 'admin#addUser', 'url' => '/admin/users/{userId}', 'verb' => 'POST'],
		['name' => 'admin#getUsers', 'url' => '/admin/users', 'verb' => 'GET'],
		['name' => 'admin#getGroupsOfUser', 'url' => '/admin/users/{userId}/groups', 'verb' => 'GET'],
		// Groups
		['name' => 'admin#getGroups', 'url' => '/admin/groups', 'verb' => 'GET'],
		['name' => 'admin#addGroup', 'url' => '/admin/groups/{name}', 'verb' => 'POST'],
		// Categories
		['name' => 'admin#getCategories', 'url' => '/admin/categories', 'verb' => 'GET'],
		['name' => 'admin#addCategory', 'url' => '/admin/categories/{name}', 'verb' => 'POST'],

		// Credential
		['name' => 'credential#createCredential', 'url' => '/api/v1/credentials', 'verb' => 'POST'],
		['name' => 'credential#getCredential', 'url' => '/api/v1/credentials/{item_id}', 'verb' => 'GET'],

		// Categories
		['name' => 'data#getCategories', 'url' => '/api/v1/categories', 'verb' => 'GET'],

		// Groups
		['name' => 'data#getGroups', 'url' => '/api/v1/groups', 'verb' => 'GET'],
    ]
];
