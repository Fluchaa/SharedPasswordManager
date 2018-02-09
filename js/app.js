var app = angular.module('spwm', [])
	.config(['$httpProvider', 
	function($httpProvider) {
		$httpProvider.defaults.headers.common.requesttoken = oc_requesttoken;
	}]);

app.controller('unlockCtrl', ['$scope', 'AuthService', '$window',  
	function($scope, AuthService, $window) {
		$scope.unlock = function() {
			console.log('ctrl');
			AuthService.unlock($scope.password).then(
			function sucessCallback(response) {
				if(response.data.type === 'success') {
					$scope.alertText = response.data.message;
					$scope.unlocked = 1;
					setTimeout(function() {
						$window.location.replace(OC.generateUrl('/apps/spwm/list'));
					}, 1000);
				} else {
					$scope.alertText = response.data.message;
					$scope.unlocked = 0;
				}
			}, function errorCallback(response) {
				console.log('error');
				console.log(response);
			});
			/*$http({
				url: OC.generateUrl('/apps/spwm/api/v1/unlock'),
				method: 'POST',
				data: {'password' : $scope.password}
			}).then(function sucessCallback(response) {
				$scope.response = JSON.parse(response);
				console.log($scope.response);
			}, function errorCallback(response) {
				console.log('error');
				console.log(response);
			});*/
		}
	}]);