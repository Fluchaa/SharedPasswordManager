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

use OCP\IConfig;

class SettingsService {
	private $userId;
	private $config;
	private $appName;
	private $settings;

	private $int_setting = [
		''
	];

	public function __construct($UserId, IConfig $config, $AppName) {
		$this->userId = $UserId;
		$this->config = $config;
		$this->appName = $AppName;

		$this->settings = [
			/*'pepper' => $this->config->getAppValue('spwm', 'pepper', '')*/
		];
	}

	/**
	 * return all settings
	 */
	public function getAppSettings() {
		return $this->settings;
	}

	/**
	 * return an App Setting
	 */
	public function getAppSetting($key) {
		if(array_key_exists($key, $this->settings)) {
			if(in_array($key, $this->int_setting)) {
				return intval($this->settings[$key]);
			}
			return $this->settings[$key];
		}
		return null;
	}

	/**
	 * set an App Setting
	 */
	public function setAppSetting($key, $value) {
		$this->settings[$key] = $value;
		$this->config->setAppValue('spwm', $key, $value);
	}

	/**
	 * delete an App Setting
	 */
	public function deleteAppSetting($key) {
		$this->config->deleteAppValue('spwm', $key);
	}
}