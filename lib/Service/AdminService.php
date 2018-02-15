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
use OCA\Spwm\Utility\Utils;

class AdminService {
	private $userKeyMapper;
	private $crypt;
	private $utils;

	public function __construct(UserKeyMapper $userKeyMapper, CryptService $crypt, Utils $utils) {
		$this->userKeyMapper = $userKeyMapper;
		$this->crypt = $crypt;
		$this->utils = $utils;
	}

	/**
	 * add User
	 */
	public function addUser($userId, $password) {
		if($this->utils->userExists($userId)) {
			// check if user is already registered
			try {
				$this->userKeyMapper->find($userId);
				return [
					'type' => 'error',
					'message' => 'User is already registered'
				];
			} catch(DoesNotExistException $e) {
				try {
					// generate data
					$salt = $this->crypt->generateSalt();
					$hash = $this->crypt->getLoginHash($password, $salt, $userId);
					$pubKey = $this->crypt->generateKeyPair($password, $salt, false);

					if($this->userKeyMapper->create($userId, $hash, $pubKey, $salt)) {
						return [
							'type' => 'success',
							'message' => 'User added successful'
						];
					}
					return [
						'type' => 'error',
						'message' => 'Error on Database insert'
					];

				} catch(Exception $e) {
					return [
						'type' => 'error',
						'message' => 'Error during user creation'
					];
				}
			}
		}
		return [
			'type' => 'error',
			'message' => 'User does not exist'
		];
	}
}