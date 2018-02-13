<?php
namespace OCA\Spwm\Controller;

use OCP\IRequest;
use OCP\ISession;

use OCP\AppFramework\Http\TemplateResponse;
use OCP\AppFramework\Http\JSONResponse;
use OCP\AppFramework\Controller;

use OCA\Spwm\Db\Authentication;

class AuthenticationController extends Controller {
	private $userId;
	private $session;
	private $authentication;
	private $urlGenerator;

	public function __construct($AppName, IRequest $request, ISession $session, $UserId, Authentication $authentication) {
		parent::__construct($AppName, $request);
		$this->userId = $UserId;
		$this->session = $session;
		$this->authentication = $authentication;
	}

	/**
	 * @NoAdminRequired
	 * 
	 * @param  $password
	 * @return JSONResponse
	 */
	public function unlock($password) {
		if($this->authentication->unlock($this->userId, $password) == 1) {
			$response['type'] = 'success';
			$response['message'] = 'Eingeloggt';
		} else {
			$response['type'] = 'error';
			$response['message'] = 'Fehler';
		}
		return new JSONResponse($response);
	}
}