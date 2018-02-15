<?php
/**
 * @copyright Copyright (c) 2018 niTEC GesbR https://nitec.at
 * @author Michael Flucher <michael.flucher@nitec.at>
 *
 * Permission is hereby granted to 
 *
 * all our Customers
 *
 * obtaining a copy of this software and associated documentation files (the "Software"), 
 * to deal in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge or publish this Software. 
 *
 * Noone is permitted to use or sell parts of the Software or the whole Software 
 * without the written permission of niTEC GesbR. 
 */

namespace OCA\Spwm\Controller;

use OCP\IRequest;

use OCP\AppFramework\Http\JSONResponse;
use OCP\AppFramework\ApiController;

use OCA\Spwm\Service\AdminService;

class AdminController extends ApiController {
	private $userId;
	private $admin;

	public function __construct($AppName, IRequest $request, $UserId, AdminService $adminService) {
		parent::__construct($AppName, $request, 'GET, POST, DELETE, PUT, PATCH, OPTIONS', 'Authorization, Content-Type, Accept', 86400);
		$this->userId = $UserId;
		$this->admin = $adminService;
	}

	/**
	 * autocompleteion for admin settings
	 * @param  $query
	 * @return Array of usernames
	 */
	public function searchUser($query) {
		$userManager = \OC::$server->getUserManager();
		$response = [];
		$searchResult = $userManager->search($query);

		foreach($searchResult as $user) {
			$response[] = [
				'value' => $user->getUID(),
				'label' => $user->getDisplayName()
			];
		}
		return new JSONResponse($response);
	}

	/**
	 * add User from Admin Page
	 */
	public function addUser($userId, $password) {
		$response = $this->admin->addUser($userId, $password);
		return new JSONResponse($response);
	}
}