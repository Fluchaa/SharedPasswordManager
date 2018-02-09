<?php
namespace OCA\Spwm\Controller;

use OCP\IRequest;
use OCP\ISession;
use OCP\IURLGenerator;

use OCP\AppFramework\Http\TemplateResponse;
use OCP\AppFramework\Http\RedirectResponse;
use OCP\AppFramework\Controller;

use OCA\Spwm\Db\Authentication;

class PageController extends Controller {
	private $userId;
	private $session;
	private $authentication;
	private $urlGenerator;

	public function __construct($AppName, IRequest $request, ISession $session, $UserId, Authentication $authentication, IURLGenerator $urlGenerator){
		parent::__construct($AppName, $request);
		$this->userId = $UserId;
		$this->session = $session;
		$this->authentication = $authentication;
		$this->urlGenerator = $urlGenerator;

		ini_set('display_errors', 1);
		ini_set('display_startup_errors', 1);
		error_reporting(E_ALL);
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
	 * @UseSession
	 *
	 * @return RedirectResponse/TemplateResponse
	 */
	public function index() {
		// check if user has unlocked the spwm
		if($this->session->exists('spwm_hash')) {
			echo "logged in";
			//return new RedirectResponse('/index.php/apps/spwm/items');
		// check if the user is already registered by admin
		} else if($this->authentication->checkExists($this->userId) == 1) {
			return new RedirectResponse($this->urlGenerator->linkToRouteAbsolute('spwm.authentication.unlock'));
		// show notification to wait for admin
		} else {
			return new TemplateResponse('spwm', 'page/notification');
		}
	}
}
