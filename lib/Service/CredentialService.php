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

use OCA\Spwm\Db\Item;
use OCA\Spwm\Db\ItemMapper;
use OCA\Spwm\Db\GroupUser;
use OCA\Spwm\Db\GroupUserMapper;

use OCA\Spwm\Service\CryptService;
use OCA\Spwm\Service\AuthenticationService;

class CredentialService {
	private $userId;
	private $crypt;
	private $itemMapper;
	private $auth;
	private $groupUserMapper;

	public function __construct($UserId, CryptService $crypt, ItemMapper $itemMapper, AuthenticationService $auth, GroupUserMapper $groupUserMapper) {
		$this->userId = $UserId;
		$this->crypt = $crypt;
		$this->itemMapper = $itemMapper;
		$this->auth = $auth;
		$this->groupUserMapper = $groupUserMapper;
	}

	/**
	 * encrypt needed data and create all database entries
	 * @param  $credential Array
	 * @return Item
	 */
	public function createCredential($credential) {
		$itemId = hash('sha256', time());
		try {
			$this->itemMapper->find($itemId);
		} catch(DoesNotExistException $e) {
			try {
				// Check if user is in group
				$groupUser = $this->groupUserMapper->find($credential['group_id'], $this->userId);

				// Encrypt fields
				$groupKey = $this->crypt->unsealGroupKey($groupUser->getGroupKey());
				$credential = $this->crypt->encryptCredential($credential, $groupKey);

				// Create the item in DB
				$item = $this->itemMapper->create($itemId, $credential, $this->userId);

				if(!is_null($credential['category_id'])) {
					// Create Category entry
					// TODO: insert in DB
					$item->setCategoryId($credential['category_id']);
				}

				// Insert Item Password
				$itemPassword = $this->itemPasswordMapper->create($item->getItemId(), $credential['password'], $this->userId);

				// Add Item Password to item
				$item->setPassword($itemPassword->getKey());
				return $this->crypt->decryptCredential($item, $groupKey);

			} catch(DoesNotExistException $e) {
				return [
					'type' => 'error',
					'message' => 'Not in Group'
				];
			}
		}
	}
}