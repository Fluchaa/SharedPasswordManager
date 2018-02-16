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

class ItemPasswordMapper extends Mapper {
	private $utils;

	public function __construct(IDBConnection $db, Utils $utils) {
		parent::__construct($db, 'spwm_itempassword');
		$this->utils = $utils;
	}

	/**
	 * get the most recent password of item
	 * @param  $item_id
	 * @return ItemPassword
	 */
	public function find($item_id) {
		$sql = 'SELECT * FROM `*PREFIX*spwm_itempassword` WHERE `item_id` = ? AND `created` = (SELECT MAX(`created`) FROM `*PREFIX*spwm_itempassword` WHERE `item_id` = ?)';
		return $this->findEntity($sql, [$item_id, $item_id]);
	}

	/**
	 * create ItemPassword
	 * @param  $itemId
	 * @param  $key   
	 * @param  $userId
	 * @return ItemPassword       
	 */
	public function create($itemId, $key, $userId) {
		$itemPassword = new ItemPassword();
		$itemPassword->setItemId($itemId);
		$itemPassword->setKey($key);
		$itemPassword->setUserId($userId);
		return parent::insert($itemPassword);
	}
}