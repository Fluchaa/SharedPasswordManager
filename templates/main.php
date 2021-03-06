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
script('spwm', 'vendor/angular-route.min');
script('spwm', 'vendor/angular-local-storage.min');
script('spwm', 'vendor/ng-password-meter');
script('spwm', 'vendor/ngclipboard.min');

script('spwm', 'templates');
script('spwm', 'app/app');
script('spwm', 'app/controller/main');
script('spwm', 'app/controller/unlock');
script('spwm', 'app/controller/credential');
script('spwm', 'app/controller/menu');
script('spwm', 'app/controller/credentialedit');
script('spwm', 'app/directive/vaultlock');
script('spwm', 'app/directive/passwordgen');
script('spwm', 'app/directive/tooltip');
script('spwm', 'app/service/unlock');
script('spwm', 'app/service/credential');
script('spwm', 'app/service/data');
script('spwm', 'app/service/settings');



style('spwm', 'vendor/fontawesome-all.min');
style('spwm', 'vendor/bootstrap-grid.min');
style('spwm', 'vendor/ng-password-meter');
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
			<li ng-repeat="category in categories">
				<a ng-click="categoryClicked(category)">{{ category.name }}</a>
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
