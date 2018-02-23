(function() {
	'use strict';

	angular.module('spwm').controller('CredentialCtrl', 
		function($scope, $rootScope, CredentialService, $location, SettingsService) {
			// not logged in anymore, back to login
			if(!$rootScope.unlocked) {
				$location.path('/');
			}

			$rootScope.$on('selected_category_changed', function() {
				// update viewed credential
			});

			$scope.addCredential = function() {
				var credential = CredentialService.newCredential();
				SettingsService.setSetting('edit_credential', credential);
				$location.path('/vault/new');
			};
		});
}());