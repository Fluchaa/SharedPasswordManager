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

use OCA\Spwm\Db\UserKey;
use OCA\Spwm\Db\UserKeyMapper;
use OCA\Spwm\Db\Group;
use OCA\Spwm\Db\GroupMapper;
use OCA\Spwm\Db\GroupUser;
use OCA\Spwm\Db\GroupUserMapper;

use OCA\Spwm\Service\CryptService;
use OCA\Spwm\Utility\Utils;

class AdminService {
	private $userKeyMapper;
	private $crypt;
	private $utils;
	private $groupMapper;
	private $groupUserMapper;

	public function __construct(UserKeyMapper $userKeyMapper, CryptService $crypt, Utils $utils, GroupMapper $groupMapper, GroupUserMapper $groupUserMapper) {
		$this->userKeyMapper = $userKeyMapper;
		$this->crypt = $crypt;
		$this->utils = $utils;
		$this->groupMapper = $groupMapper;
		$this->groupUserMapper = $groupUserMapper;
	}

	/**
	 * add User
	 */
	public function addUser($userId, $password) {
		if($this->utils->userExists($userId)) {
			// check if user is already registered
			try {
				$this->userKeyMapper->find($userId);
				return [
					'type' => 'error',
					'message' => 'User is already registered'
				];
			} catch(DoesNotExistException $e) {
				try {
					// generate data
					$salt = $this->crypt->generateSalt();
					$hash = $this->crypt->getLoginHash($password, $salt, $userId);
					$pubKey = $this->crypt->generateKeyPair($password, $salt, false);

					if($this->userKeyMapper->create($userId, $hash, $pubKey, $salt)) {
						return [
							'type' => 'success',
							'message' => 'User added successful',
							'user' => [
								'user_id' => $userId,
								'username' => $this->utils->getNameByUserId($userId)
							]
						];
					}
					return [
						'type' => 'error',
						'message' => 'Error on Database insert'
					];

				} catch(Exception $e) {
					return [
						'type' => 'error',
						'message' => 'Error during user creation'
					];
				}
			}
		}
		return [
			'type' => 'error',
			'message' => 'User does not exist'
		];
	}

	/**
	 * get Users
	 */
	public function getUsers() {
		try {
			$users = $this->userKeyMapper->getUsers();

			$response = [];
			foreach($users as $user) {
				$response[] = [
					'user_id' => $user->getUserId(),
					'username' => $this->utils->getNameByUserId($user->getUserId())
				];
			}

			return $response;
		} catch(DoesNotExistException $e) {
			return null;
		}
	}

	/**
	 * get Groups
	 */
	public function getGroups() {
		try {
			$groups = $this->groupMapper->getGroups();

			$response = [];
			foreach($groups as $group) {
				$response[] = [
					'group_id' => $group->getGroupId(),
					'name' => $group->getName()
				];
			}

			return $response;
		} catch(DoesNotExistException $e) {
			return null;
		}
	}

	/**
	 * add group
	 */
	public function addGroup($userId, $name) {
		try {
			$this->groupMapper->findName($name);
			return [
				'type' => 'error',
				'message' => 'Group name already used'
			];
		} catch(DoesNotExistException $e) {
			try {
				// create group
				$group = $this->groupMapper->create($name);

				// generate data
				$groupKey = $this->crypt->generateGroupKey();
				$publicKey = $this->userKeyMapper->find($userId)->getPublickey();
				$grpKeySealed = $this->crypt->sealGroupKey($groupKey, $publicKey);

				// create usergroup entity
				$groupUser = $this->groupUserMapper->create($group->getId(), $userId, $grpKeySealed);

				if($groupUser) {
					return [
						'type' => 'success',
						'message' => 'Group created successful',
						'group' => [
							'group_id' => $group->getId(),
							'name' => $group->getName()
						]
					];
				}
				return [
					'type' => 'error',
					'message' => 'Error on Database insert'
				];

			} catch(Exception $e) {
				return [
					'type' => 'error',
					'message' => 'Error during group creation'
				];
			}
		}
	}
}