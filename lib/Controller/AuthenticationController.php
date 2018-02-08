<?php
namespace OCA\Spwm\Controller;

use OCP\IRequest;
use OCP\ISession;

use OCP\AppFramework\Http\TemplateResponse;
use OCP\AppFramework\Controller;

use OCA\Spwm\Db\Authentication;

class AuthenticationController extends Controller {
	private $userId;
	private $session;
	private $authentication;
	private $urlGenerator;

	public function __construct($AppName, IRequest $request, ISession $session, $UserId, Authentication $authentication){
		parent::__construct($AppName, $request);
		$this->userId = $UserId;
		$this->session = $session;
		$this->authentication = $authentication;
	}

	/**
	 * @NoCSRFRequired
	 * 
	 * @return [type] [description]
	 */
	public function unlock() {
		return new TemplateResponse('spwm', 'authentication/unlock');
	}
}