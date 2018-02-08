<?php
namespace OCA\Spwm\AppInfo;

use OCP\AppFramework\App;

use OCA\Spwm\Controller\PageController;
use OCA\Spwm\Db\Authentication;

class Application extends App {
	public function __construct(array $urlParams=array()) {
		parent::__construct('spwm', $urlParams);

		$container = $this->getContainer();

		/**
		 * Controllers
		 */
		$container->registerService('PageController', function($c) {
			 return new PageController(
				$c->query('AppName'),
				$c->query('Request'),
				$c->query('Session'),
				$c->query('UserId'),
				$c->query('Authentication'),
				$c->query('UrlGenerator')
			);
		});
		$container->registerService('AuthenticationController', function($c) {
			 return new PageController(
				$c->query('AppName'),
				$c->query('Request'),
				$c->query('Session'),
				$c->query('UserId'),
				$c->query('Authentication'),
				$c->query('UrlGenerator')
			);
		});
		$container->registerService('ItemController', function($c) {
			 return new PageController(
				$c->query('AppName'),
				$c->query('Request'),
				$c->query('Session'),
				$c->query('UserId')
			);
		});

		/**
		 * Mappers
		 */
		$container->registerService('Authentication', function($c) {
			return new UserkeyMapper(
				$c->query('ServerContainer')->getDb()
			);
		});
	}
}