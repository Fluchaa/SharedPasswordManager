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

	public function __construct($UserId, ICONfig $config, $AppName) {
		$this->userId = $UserId;
		$this->config = $config;
		$this->appName = $AppName;

		$this->settings = [
			'salt' => $this->config->getAppValue('spwm', 'salt', uniqid(mt_rand(), true)),
		];
	}

	public function getAppSettings() {
		return $this->settings;
	}

	public function getAppSettings($key) {
		$value = ($this->settings[$key]) ? $this->settings[$key] : $this->config->getAppValue('spwm', $key, $default_value);
		return $value;
	}

	public function setAppSetting($key, $value) {
		$this->settings[$key] = $value;
		$this->config->setAppValue('spwm', $key, $value);
	}
}