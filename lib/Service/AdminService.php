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

class AdminService {
	private $userKeyMapper;
	private $crypt;

	public function __construct(UserKeyMapper $userKeyMapper, CryptService $crypt) {
		$this->userKeyMapper = $userKeyMapper;
		$this->crypt = $crypt;
	}

	/**
	 * add User
	 */
	public function addUser($userId, $password) {
		return $this->crypt->getLoginHash(1,1);
		//return $this->userKeyMapper->create($userId, $password);
	}
}