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

class GroupMapper extends Mapper {
	private $utils;

	public function __construct(IDBConnection $db, Utils $utils) {
		parent::__construct($db, 'spwm_group');
		$this->utils = $utils;
	}

	/**
	 * Get Group Entity
	 * @throws DoesNotExistException if no entry is found
	 * @throws MultipleObjectsReturnedException if more than one result
	 * @param  $groupId
	 * @return Group
	 */
	public function find($groupId) {
		$sql = 'SELECT * FROM `*PREFIX*spwm_group` WHERE `group_id` = ?';
		return $this->findEntity($sql, [$groupId]);
	}

	/**
	 * Get Group Entity
	 * @throws DoesNotExistException if no entry is found
	 * @throws MultipleObjectsReturnedException if more than one result
	 * @param  $name
	 * @return Group
	 */
	public function findName($name) {
		$sql = 'SELECT * FROM `*PREFIX*spwm_group` WHERE `name` = ?';
		return $this->findEntity($sql, [$name]);
	}

	/**
	 * Create Group Entity
	 * @param  $name
	 * @return Group inserted Entity        
	 */
	public function create($name) {
		$group = new Group();
		$group->setName($name);
		return parent::insert($group);
	}

	/**
	 * get all groups
	 * @return Group[]
	 */
	public function getGroups() {
		$sql = 'SELECT * FROM `*PREFIX*spwm_group`';
		return $this->findEntities($sql);
	}
}