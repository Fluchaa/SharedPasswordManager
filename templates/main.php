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

script('spwm', 'vendor/angular');
script('spwm', 'vendor/angular-route');

script('spwm', 'templates');
script('spwm', 'app/app');
script('spwm', 'app/controller/main');
script('spwm', 'app/controller/unlock');
script('spwm', 'app/controller/credential');
script('spwm', 'app/controller/menu');
script('spwm', 'app/directive/vaultlock');
script('spwm', 'app/service/unlock');
script('spwm', 'app/service/credential');


style('spwm', 'vendor/fontawesome-all.min');
style('spwm', 'vendor/bootstrap-grid.min');
style('spwm', 'app');
?>

<div id="app" ng-app="spwm" ng-controller="MainCtrl">
	<div class="alert alert-warning http-warning" ng-if="using_http && !http_warning_hidden">
		<p class="content">
			<strong>HTTPS aktivieren!</strong><br />
			Shared Password Manager sollte ohne HTTPS nicht verwendet werden!
		</p>
		<i class="fas fa-times btn-close" alt="Close" ng-click="setHttpWarning(true)"></i>
	</div>

	<div id="app-navigation" ng-show="unlocked" ng-controller="MenuCtrl">
		<ul>
			<li>
				<a ng-href="#/vault/cat1">Cat1</a>
			</li>
			<li>
				<a ng-href="#/vault/cat2">Cat2</a>
			</li>
		</ul>
	</div>

	<div id="app-content">
		<div id="app-content-wrapper">
			<div id="content" ng-view="">

			</div>
		</div>
	</div>
</div>
