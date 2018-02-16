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

class ItemMapper extends Mapper {
	private $utils;

	public function __construct(IDBConnection $db, Utils $utils) {
		parent::__construct($db, 'spwm_item');
		$this->utils = $utils;
	}

	/**
	 * Get Item Entity with Item ID
	 * @throws DoesNotExistException if no entry is found
	 * @throws MultipleObjectsReturnedException if more than one result
	 * @param  $item_id
	 * @return Item
	 */
	public function find($item_id) {
		$sql = 'SELECT * FROM `*PREFIX*spwm_item` WHERE `item_id` = ?';
		return $this->findEntity($sql, [$item_id]);
	}

	/**
	 * create Item
	 * @param  $itemId SHA256 of time()
	 * @param  $credential 
	 * @param  $userId     
	 * @return Item
	 */
	public function create($itemId, $credential, $userId) {
		$item = new Item();
		$item->setItemId($itemId);
		$item->setLabel($credential['label']);
		$item->setUsername($credential['username']);
		$item->setEmail($credential['email']);
		$item->setDescription($credential['description']);
		$item->setUrl($credential['url']);
		$item->setIp($credential['ip']);
		$item->setCreated($this->utils->getTime());
		$item->setLastAccess(0);
		$item->setCreatedBy($userId);
		$item->setGroupId($credential['group_id']);
		return parent::insert($item);
	}
}