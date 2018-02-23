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

use OCA\Spwm\Db\Category;
use OCA\Spwm\Db\CategoryMapper;
use OCA\Spwm\Db\Group;
use OCA\Spwm\Db\GroupMapper;

class DataService {
	private $userId;
	private $categoryMapper;
	private $groupMapper;

	public function __construct($UserId, CategoryMapper $categoryMapper, GroupMapper $groupMapper) {
		$this->userId = $UserId;
		$this->categoryMapper = $categoryMapper;
		$this->groupMapper = $groupMapper;
	}

	/**
	 * get all categories in DB
	 * @return Category[]
	 */
	public function getCategories() {
		try {
			return $this->categoryMapper->getCategories();
		} catch(DoesNotExistException $e) {
			return null;
		}
	}

	/**
	 * get groups of user
	 * @return Group[]
	 */
	public function getGroups() {
		try {
			return $this->groupMapper->getGroupsOfUser($this->userId);
		} catch(DoesNotExistException $e) {
			return null;
		}
	}
}