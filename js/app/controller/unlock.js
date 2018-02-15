(function() {
	'use strict';

	angular.module('spwm').controller('UnlockCtrl',
		function($scope, $rootScope, UnlockService, $location) {
			// Alert Stuff
			$scope.alert_hidden = true;
			$scope.setAlertHidden = function(state) {
				$scope.alert_hidden = state;
			};

			//Unlock Vault
			$scope.unlockVault = function() {
				console.log('button trigger');
				UnlockService.unlock($scope.password).then(
				function sucessCallback(response) {
					$scope.alert_text = response.data.message;
					$scope.alert_type = 'alert-'+response.data.type;
					$scope.alert_hidden = false;
					
					if(response.data.type === 'success') {
						console.log('success');
						setTimeout(function() {
							$location.path('/vault');
						}, 1000);
					}
				}, function errorCallback(response) {
					console.log('error');
					console.log(response);
				});
			};
		});
}());