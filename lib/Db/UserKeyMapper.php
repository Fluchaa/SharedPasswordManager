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

class UserKeyMapper extends Mapper {
	public function __construct(IDBConnection $db) {
		parent::__construct($db, 'spwm_userkey');
	}

	/**
	 * Get UserKey Entity of User
	 * @throws DoesNotExistException if no entry is found
	 * @throws MultipleObjectsReturnedException if more than one result
	 * @param  $user_id
	 * @return Vault
	 */
	public function find($user_id) {
		$sql = 'SELECT * FROM `*PREFIX*spwm_userkey` WHERE `user_id` = ?';
		return $this->findEntity($sql, [$user_id]);
	}

	public function create($userId, $password) {
		return phpversion();
	}
}