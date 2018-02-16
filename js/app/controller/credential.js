(function() {
	'use strict';

	angular.module('spwm').controller('CredentialCtrl', 
		function($scope, $rootScope, CredentialService, $location) {
			// not logged in anymore, back to login
			if(!$rootScope.unlocked) {
				$location.path('/');
			}
		});
}());