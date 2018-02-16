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

use JsonSerializable;

use \OCP\AppFramework\Db\Entity;

class ItemPassword extends Entity implements JsonSerializable {
	protected $itemId;
	protected $key;
	protected $userId;
	protected $created;

	public function __construct() {
		$this->addType('created', 'integer');
	}

	public function jsonSerialize() {
		return [
			'item_id' => $this->itemId,
			'key' => $this->key,
			'user_id' => $this->userId,
			'created' => $this->created
		];
	}
}