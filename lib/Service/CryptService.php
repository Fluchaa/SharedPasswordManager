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

use OCP\ISession;

use \ParagonIE\Halite\HiddenString;
use \ParagonIE\Halite\KeyFactory;
use \ParagonIE\Halite\Password;
use \ParagonIE\Halite\Asymmetric\EncryptionPublicKey;
use \ParagonIE\Halite\Asymmetric\EncryptionSecretKey;
use \ParagonIE\Halite\Asymmetric\Crypto as Asym;
use \ParagonIE\Halite\Symmetric\EncryptionKey;
use \ParagonIE\Halite\Symmetric\Crypto as Sym;

class CryptService {
	private $session;

	public function __construct(ISession $session) {
		$this->session = $session;
	}

	/**
	 * @return string 16-Byte salt
	 */
	public function generateSalt() {
		return random_bytes(16);
	}

	/**
	 * get login hash
	 * @param  $password
	 * @param  $salt
	 * @param  $userId
	 * @return string BASE64 hash to be inserted in DB
	 */
	public function getLoginHash($password, $salt, $userId) {
		$encKey = $this->loadHashEncryptionKey($userId);
		return Password::hash(new HiddenString($password . $salt), $encKey);
	}

	/**
	 * check if login password is right
	 * @param  $password
	 * @param  $salt    
	 * @param  $hash
	 * @param  $userId
	 * @return bool true if password is right         
	 */
	public function checkLoginHash($password, $salt, $hash, $userId) {
		$encKey = $this->loadHashEncryptionKey($userId);
		return Password::verify(new HiddenString($password . $salt), new HiddenString($hash), $encKey);
	}

	/**
	 * create encryption key if not exists
	 * @return bool if creation was successful
	 */
	public function generateHashEncryptionKey($userId) {
		$path = realpath(dirname(__FILE__)) . '/../../keys';
		if(!file_exists($path)) {
			mkdir($path, 0770, true);
		}

		$filename = $path . '/' . $userId . '.key';
		if(!file_exists($filename)) {
			$encKey = KeyFactory::generateEncryptionKey();
			return KeyFactory::save($encKey, $filename);
		}
		return false;
	}

	/**
	 * tries to generate a key and then loads and returns it
	 * @param  $userId
	 * @return EncryptionKey
	 */
	public function loadHashEncryptionKey($userId) {
		$this->generateHashEncryptionKey($userId);

		$filename = realpath(dirname(__FILE__)) . '/../../keys/' . $userId . '.key';
		return KeyFactory::loadEncryptionKey($filename);
	}

	/**
	 * on every login generate KeyPair to access group keys
	 * private key is stored in session, public key is returned
	 * @param  $password
	 * @param  $salt    
	 * @return string public key        
	 */
	public function generateKeyPair($password, $salt) {
		$userKeyPair = KeyFactory::deriveEncryptionKeyPair(new HiddenString($password), $salt, KeyFactory::SENSITIVE);
		$this->session->set('spwm_private_key', $userKeyPair->getSecretKey()->getRawKeyMaterial());
		return $userKeyPair->getPublicKey();
	}

	/**
	 * generate group key
	 * @return string key
	 */
	public function generateGroupKey() {
		return KeyFactory::generateEncryptionKey()->getRawKeyMaterial();
	}

	/**
	 * seal group key to store in DB
	 * @param  $groupKey      
	 * @param  $userPublicKey 
	 * @return string BASE64 sealed key               
	 */
	public function sealGroupKey($groupKey, $userPublicKey) {
		return Asym::seal(new HiddenString($groupKey), new EncryptionPublicKey(new HiddenString($userPublicKey)));
	}

	/**
	 * unseal group key gathered from DB using users private key
	 * @param  $sealedGroupKey
	 * @return string                 
	 */
	public function unsealGroupKey($sealedGroupKey) {
		return Asym::unseal($sealedGroupKey, new EncryptionSecretKey(new HiddenString($this->session->get('spwm_private_key'))));
	}

	/**
	 * encrypt item password with group key, ready to store in DB
	 * @param  $password
	 * @param  $groupKey
	 * @return string BASE64 encrypted password         
	 */
	public function encryptItemPassword($password, $groupKey) {
		return Sym::encrypt(new HiddenString($password), new EncryptionKey(new HiddenString($groupKey)));
	}

	/**
	 * decrypt item cipher with group key
	 * @param  $cipher   
	 * @param  $groupKey 
	 * @return string password          
	 */
	public function decryptItemPassword($cipher, $groupKey) {
		return Sym::decrypt($cipher, new EncryptionKey(new HiddenString($groupKey)));
	}
}