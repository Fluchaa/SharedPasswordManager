<?php
	script('spwm', 'angular.min');
	script('spwm', 'app');
	script('spwm', 'app.service');
	script('spwm', 'app.directive');

	style('spwm', 'fontawesome-all.min');
	style('spwm', 'app');
?>

<div id="spwm-unlockscreen" ng-app="spwm" ng-controller="unlockCtrl">
	<div class="wrapper">
		<div class="container">
			<div class="circle">
				<div class="circle-inner">
					<i class="fas fa-lock" lock-directive></i>
				</div>
			</div>
			<div class="password-container">
				<div class="form-group">
					<div class="box">
						<label for="unlockPassword">Unlock your Vault</label>
					</div>
					<div class="box">
						<input type="password" name="unlockPassword" id="unlockPassword" class="form-control" ng-keyup="($event.keyCode == 13) ? unlock() : return" ng-model="password" />
						<button type="button" ng-click="unlock()"><i class="fas fa-unlock-alt"></i></button>
					</div>
				</div>
			</div>
		</div>
		<div class="alert hidden" lock-alert-directive>
			<p class="content" ng-bind="alertText"></p>
		</div>
	</div>
</div>