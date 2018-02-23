(function() {
	'use strict';

	angular.module('spwm').controller('CredentialEditCtrl', 
		function($scope, $rootScope, CredentialService, $location, SettingsService, DataService, $routeParams) {
			// not logged in anymore, back to login
			if(!$rootScope.unlocked) {
				$location.path('/');
			}

			$scope.pwSettings = {
				'length': 12,
				'useUppercase': true,
				'useLowercase': true,
				'useDigits': true,
				'useSpecialChars': true,
				'minimumDigitCount': 3,
				'avoidAmbiguousCharacters': false,
				'requireEveryCharType': true,
				'generateOnCreate': true
			};

			if($routeParams.item_id) {
				CredentialService.getCredential($routeParams.item_id).then(function(response) {
					$scope.storedCredential = angular.copy(response);
				});
			} else {
				$scope.storedCredential = CredentialService.newCredential();
			}

			DataService.getCategories().then(function(response) {
				response.unshift({
					'category_id': 0,
					'name': 'Default'
				});
				$scope.availableCategories = response;
				$scope.storedCredential.category_id = response[0].category_id;
			});


			DataService.getGroups().then(function(response) {
				$scope.availableGroups = response;
				$scope.storedCredential.group_id = response[0].group_id;
			});

			$scope.saveCredential = function() {
				$scope.saveProgress = true;

				// new credential
				if(!$scope.storedCredential.item_id) {
					console.log($scope.storedCredential);
					CredentialService.createCredential($scope.storedCredential).then(function(response) {
						console.log(response);
						/*$scope.saveProgress = false;
						OC.Notification.showTemporary('Item created');
						$location.path('/vault');*/
					});
				}
			};

			$scope.cancel = function() {

			};
		});
}());