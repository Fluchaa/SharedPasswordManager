<?php
	script('spwm', 'vendor/angular');
	script('spwm', 'vendor/angular-route');

	script('spwm', 'templates');
	script('spwm', 'app/app');
	script('spwm', 'app/controller/main');
	script('spwm', 'app/controller/unlock');
	script('spwm', 'app/directive/vaultlock');
	script('spwm', 'app/service/unlock');

	
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
	<div id="app-navigation">

	</div>
	<div id="app-content">
		<div id="app-content-wrapper">
			<div id="content" ng-view="">

			</div>
		</div>
	</div>
</div>
