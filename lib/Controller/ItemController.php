<?php
namespace OCA\Spwm\Controller;

use OCP\IRequest;
use OCP\ISession;

use OCP\AppFramework\Http\TemplateResponse;
use OCP\AppFramework\Controller;

class ItemController extends Controller {
	private $userId;
	private $session;

	public function __construct($AppName, IRequest $request, ISession $session, $UserId, Authentication $authentication){
		parent::__construct($AppName, $request);
		$this->userId = $UserId;
		$this->session = $session;
	}

	public function list() {
		echo "list";
	}
}