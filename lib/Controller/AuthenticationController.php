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

use OCA\Spwm\Service\AuthenticationService;

class AuthenticationController extends ApiController {
	private $userId;
	private $auth;

	public function __construct($AppName, IRequest $request, AuthenticationService $auth, $UserId) {
		parent::__construct($AppName, $request, 'GET, POST, DELETE, PUT, PATCH, OPTIONS', 'Authorization, Content-Type, Accept', 86400);
		$this->userId = $UserId;
		$this->auth = $auth;
	}

	/**
	 * @NoAdminRequired
	 * @UseSession
	 * 
	 * @param  $password
	 * @return JSONResponse
	 */
	public function unlock($password) {
		$response = $this->auth->unlock($password);
		return new JSONResponse($response);
	}

	/**
	 * @NoAdminRequired
	 * 
	 * @return JSONResponse
	 */
	public function lock() {
		/* TODO */
		//$response = $this->auth->unlock($password);
		return new JSONResponse($response);
	}
}