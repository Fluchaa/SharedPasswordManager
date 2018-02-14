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

use OCP\Settings\ISettings;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\AppFramework\Http\JSONResponse;
use OCP\AppFramework\ApiController;
use OCP\IRequest;
use OCA\Spwm\Service\SettingsService;

class SettingsController extends ApiController {
	private $userId;
	private $settings;

	public function __construct($AppName, IRequest $request, $UserId, SettingsService $settings) {
		parent::__construct($AppName, $request, 'GET, POST, DELETE, PUT, PATCH, OPTIONS', 'Authorization, Content-Type, Accept', 86400);
		$this->settings = $settings;
		$this->userId = $UserId;
	}

	/**
	 * @return TemplateResponse
	 */
	public function getForm() {
		return new TemplateResponse('spwm', 'admin.tpl');
	}

	/**
	 * @return string the section ID, e.g. 'sharing'
	 */
	public function getSection() {
		return 'additional';
	}

	/**
	 * @return int whether the form should be rather on the top or bottom of
	 * the admin section. The forms are arranged in ascending order of the
	 * priority values. It is required to return a value between 0 and 100.
	 *
	 * E.g.: 70
	 */
	public function getPriority() {
		return 0;
	}

	/**
	 * Get all settings
	 *
	 * @NoAdminRequired
	 * @NoCSRFRequired
	 */
	public function getSettings() {
		$settings = $this->settings->getAppSettings();
		return new JSONResponse($settings);
	}

	/**
	 * Save a app setting
	 *
	 * @NoCSRFRequired
	 */
	public function saveAdminSetting($key, $value) {
		$this->settings->setAppSetting($key, $value);
		return new JSONResponse('OK');
	}

	/**
	 * generate Pepper for first run from settings
	 *
	 * @NoCSRFRequired
	 */
	/*public function generatePepper() {
		if(empty($this->settings->getAppSetting('pepper'))) {
			$this->settings->setAppSetting('pepper', hash('sha512', mt_rand()));
		}
		return new JSONResponse('OK');
	}*/
}