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

class GroupUserMapper extends Mapper {
	private $utils;

	public function __construct(IDBConnection $db, Utils $utils) {
		parent::__construct($db, 'spwm_groupuser');
		$this->utils = $utils;
	}

	/**
	 * Get GroupUser Entity of User
	 * @throws DoesNotExistException if no entry is found
	 * @throws MultipleObjectsReturnedException if more than one result
	 * @param  $groupId
	 * @param  $userId
	 * @return GroupUser
	 */
	public function find($groupId, $userId) {
		$sql = 'SELECT * FROM `*PREFIX*spwm_groupuser` WHERE `group_id` = ? AND `user_id` = ?';
		return $this->findEntity($sql, [$groupId, $userId]);
	}

	/**
	 * Create GroupUser Entity
	 * @param  $groupId
	 * @param  $userId     
	 * @param  $key
	 * @return GroupUser inserted Entity        
	 */
	public function create($groupId, $userId, $key) {
		$groupUser = new GroupUser();
		$groupUser->setGroupId($groupId);
		$groupUser->setUserId($userId);
		$groupUser->setGroupkey($key);
		return parent::insert($groupUser);
	}

	/**
	 * get groups of user
	 * @param  $userId
	 * @return GroupUser[]       
	 */
	public function getGroupsOfUser($userId) {
		$sql = 'SELECT * FROM `*PREFIX*spwm_groupuser` WHERE `user_id` = ?';
		return $this->findEntities($sql, [$userId]);
	}
}