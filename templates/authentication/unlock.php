<?php
	script('spwm', 'angular.min');
	script('spwm', 'app');

	style('spwm', 'fontawesome-all.min');
	style('spwm', 'app');
?>

<div id="unlockscreen" ng-app="spwm" ng-controller="unlockCtrl">
	<div class="container">
		<div class="circle">
			<div class="circle-inner">
				<i class="fas fa-lock"></i>
			</div>
		</div>
		<div class="password-container">
			<div class="form-group">
				<div class="box">
					<label for="unlockPassword">Unlock your Vault</label>
				</div>
				<div class="box">
					<input type="password" name="unlockPassword" id="unlockPassword" class="form-control" ng-keyup="($event.keyCode == 13) ? unlock()" ng-model="password" />
					<button type="button" ng-click="unlock()"><i class="fas fa-unlock-alt"></i></button>
				</div>
			</div>
		</div>
	</div>
</div>