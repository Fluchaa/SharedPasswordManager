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

namespace OCA\Spwm\Controller;

use OCA\Spwm\Service\SettingsService;
use OCA\Spwm\Db\UserKey;
use OCA\Spwm\Db\UserKeyMapper;

use OCP\IRequest;

use OCP\AppFramework\Http\TemplateResponse;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Db\DoesNotExistException;


class PageController extends Controller {
	private $userId;
	private $settings;
	private $userKeyMapper;

	public function __construct($AppName, IRequest $request, $UserId, SettingsService $Settings, UserKeyMapper $UserKeyMapper){
		parent::__construct($AppName, $request);
		$this->userId = $UserId;
		$this->settings = $Settings;
		$this->userKeyMapper = $UserKeyMapper;
	}

	/**
	 * CAUTION: the @Stuff turns off security checks; for this page no admin is
	 *          required and no CSRF check. If you don't know what CSRF is, read
	 *          it up in the docs or you might create a security hole. This is
	 *          basically the only required method to add this exemption, don't
	 *          add it to any other method if you don't exactly know what it does
	 *
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 *
	 * @return TemplateResponse
	 */
	public function index() {
		// first run, set pepper
		// maybe check for admin?
		// stored in DB => useless
		/*if(empty($this->settings->getAppSetting('pepper'))) {
			$this->settings->setAppSetting('pepper', hash('sha512', mt_rand()));
		}*/
		$alice_keypair = \ParagonIE\Halite\KeyFactory::generateEncryptionKeyPair();
		/*try {
			// check if registered
			$this->userKeyMapper->find($this->userId);

			$params = ['user' => $this->userId];
			return new TemplateResponse('spwm', 'main', $params);
		} catch(DoesNotExistException $e) {
			return new TemplateResponse('spwm', 'notregistered');
		}*/
	}
}
