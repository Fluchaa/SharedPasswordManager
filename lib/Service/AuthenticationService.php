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

namespace OCA\Spwm\Service;

use OCP\AppFramework\Db\DoesNotExistException;
use OCP\AppFramework\Db\MultipleObjectsReturnedException;

use OCA\Spwm\Db\UserKey;
use OCA\Spwm\Db\UserKeyMapper;

use OCA\Spwm\Service\CryptService;

class AuthenticationService {
	private $userId;
	private $userKeyMapper;
	private $crypt;

	public function __construct($UserId, UserKeyMapper $userKeyMapper, CryptService $crypt) {
		$this->userId = $UserId;
		$this->userKeyMapper = $userKeyMapper;
		$this->crypt = $crypt;
	}

	/**
	 * get password hash and check it
	 * @param  $password
	 * @return Array 
	 */
	public function unlock($password) {
		try {
			$userKey = $this->userKeyMapper->find($this->userId);

			if($this->crypt->checkLoginHash($password, $userKey->getSalt(), $userKey->getUnlockkey(), $this->userId)) {
				// Store private key in session
				$this->crypt->generateKeyPair($password, $userKey->getSalt());

				return [
					'type' => 'success',
					'message' => 'Login successful'
				];
			}
			return [
				'type' => 'error',
				'message' => 'Wrong password'
			];

		} catch(DoesNotExistException $e) {
			return [
				'type' => 'error',
				'message' => 'User not found'
			];
		}
	}

	public function lock() {
		/* TODO */
	}


}