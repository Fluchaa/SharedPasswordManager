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

namespace OCA\Spwm\Db;

use OCP\IDBConnection;
use OCP\AppFramework\Db\Mapper;

use OCA\Spwm\Utility\Utils;

class UserKeyMapper extends Mapper {
	private $utils;

	public function __construct(IDBConnection $db, Utils $utils) {
		parent::__construct($db, 'spwm_userkey');
		$this->utils = $utils;
	}

	/**
	 * Get UserKey Entity of User
	 * @throws DoesNotExistException if no entry is found
	 * @throws MultipleObjectsReturnedException if more than one result
	 * @param  $user_id
	 * @return UserKey
	 */
	public function find($user_id) {
		$sql = 'SELECT * FROM `*PREFIX*spwm_userkey` WHERE `user_id` = ?';
		return $this->findEntity($sql, [$user_id]);
	}

	/**
	 * Create UserKey (Login) Entry
	 * @param  $userId    
	 * @param  $hash      
	 * @param  $publicKey 
	 * @param  $salt      
	 * @return bool if successful           
	 */
	public function create($userId, $hash, $publicKey, $salt) {
		$userKey = new UserKey();
		$userKey->setUserId($userId);
		$userKey->setUnlockkey($hash);
		$userKey->setPublickey($publicKey);
		$userKey->setSalt($salt);
		$userKey->setCreated($this->utils->getTime());
		$userKey->setLastAccess(0);
		return parent::insert($userKey);
	}
}