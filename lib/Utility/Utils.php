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

namespace OCA\Spwm\Utility;

class Utils {
	/**
	 * Gets the unix epoch UTC timestamp
	 * @return int
	 */
	public static function getTime() {
		return (new \DateTime())->getTimestamp();
	}

	/**
	 * @return int the current unix time in milliseconds
	 */
	public static function getMicroTime() {
		return microtime(true);
	}

	/**
	 * @param  $userId
	 * @return string
	 */
	public static function getNameByUserId($userId) {
		$um = \OC::$server->getUserManager();
		$u = $um->get($userId);
		return $u->getDisplayName();
	}

	/**
	 * @param  $userId
	 * @return bool       
	 */
	public static function userExists($userId) {
		$um = \OC::$server->getUserManager();
		return $um->userExists($userId);
	}
}