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
use OCP\ISession;

use OCP\AppFramework\Http\TemplateResponse;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Db\DoesNotExistException;

use OCA\Spwm\Service\CryptService;

class PageController extends Controller {
	private $userId;
	private $settings;
	private $userKeyMapper;
	private $crypt;
	private $session;

	public function __construct($AppName, IRequest $request, $UserId, SettingsService $Settings, UserKeyMapper $UserKeyMapper, CryptService $crypt, ISession $session){
		parent::__construct($AppName, $request);
		$this->userId = $UserId;
		$this->settings = $Settings;
		$this->userKeyMapper = $UserKeyMapper;
		$this->crypt = $crypt;
		$this->session = $session;
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

		/*try {
			// check if registered
			$this->userKeyMapper->find($this->userId);

			$params = ['user' => $this->userId];
			return new TemplateResponse('spwm', 'main', $params);
		} catch(DoesNotExistException $e) {
			return new TemplateResponse('spwm', 'notregistered');
		}*/


		// generate salt
		echo "salt: ";
		$salt = $this->crypt->generateSalt();
		//$salt = random_bytes(16);
		echo $salt;

		// read password
		echo "\npasswd: ";
		$pw = "1234test";
		echo $pw;

		echo "\nhash: ";
		$hash = $this->crypt->getLoginHash($pw, $salt, $this->userId);
		echo $hash;

		echo "\nlogin: ";
		echo $this->crypt->checkLoginHash($pw, $salt, $hash, $this->userId);

		echo "\npublic key: ";
		$pub = $this->crypt->generateKeyPair($pw, $salt);
		echo base64_encode($pub);

		echo "\nsession: ";
		echo base64_encode($this->session->get('spwm_private_key'));

		echo "\ngroup key: ";
		$grpkey = $this->crypt->generateGroupKey();
		echo base64_encode($grpkey);

		echo "\nstored for user: ";
		$sealed = $this->crypt->sealGroupKey($grpkey, $pub);
		echo $sealed;

		echo "\ngroup key: ";
		$unsealed = $this->crypt->unsealGroupKey($sealed);
		echo base64_encode($unsealed);

		echo "\nitem password: ";
		$enc = $this->crypt->encryptItemPassword('hallo', $grpkey);
		echo $enc;

		echo "\nitem password: ";
		echo $this->crypt->decryptItemPassword($enc, $unsealed);
	}
}
