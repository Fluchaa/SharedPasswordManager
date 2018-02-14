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
use OCP\ISession;

use OCP\AppFramework\Http\TemplateResponse;
use OCP\AppFramework\Http\JSONResponse;
use OCP\AppFramework\Controller;

use OCA\Spwm\Db\Authentication;

class AuthenticationController extends Controller {
	private $userId;
	private $session;
	private $authentication;
	private $urlGenerator;

	public function __construct($AppName, IRequest $request, ISession $session, $UserId, Authentication $authentication) {
		parent::__construct($AppName, $request);
		$this->userId = $UserId;
		$this->session = $session;
		$this->authentication = $authentication;
	}

	/**
	 * @NoAdminRequired
	 * 
	 * @param  $password
	 * @return JSONResponse
	 */
	public function unlock($password) {
		if($this->authentication->unlock($this->userId, $password) == 1) {
			$response['type'] = 'success';
			$response['message'] = 'Eingeloggt';
		} else {
			$response['type'] = 'error';
			$response['message'] = 'Fehler';
		}
		return new JSONResponse($response);
	}
}