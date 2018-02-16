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

class Item extends Entity implements JsonSerializable {
	protected $itemId;
	protected $label;
	protected $username;
	protected $email;
	protected $description;
	protected $url;
	protected $ip;
	protected $created;
	protected $lastAccess;
	protected $createdBy;
	protected $categoryId;
	protected $groupId;
	protected $password;

	public function __construct() {
		$this->addType('created', 'integer');
		$this->addType('lastAccess', 'integer');
		$this->addType('lastChange', 'integer');
	}

	public function jsonSerialize() {
		return [
			'item_id' => $this->itemId,
			'label' => $this->label,
			'username' => $this->username,
			'email' => $this->email,
			'description' => $this->description,
			'url' => $this->url,
			'ip' => $this->ip,
			'created' => $this->created,
			'last_access' => $this->lastAccess,
			'created_by' => $this->createdBy,
			'category_id' => $this->categoryId,
			'group_id' => $this->groupId,
			'password' => $this->password
		];
	}
}