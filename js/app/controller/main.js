(function() {
	'use strict';

	angular.module('spwm').controller('MainCtrl', 
		function($scope, $rootScope, $location, $window) {
			// Http Warning
			$scope.http_warning_hidden = true;
			if($location.$$protocol === 'http' && $location.$$host !== 'localhost' && $location.$$host !== '127.0.0.1' && !$location.$$host.includes('192.168.')) {
				$scope.using_http = true;
				$scope.http_warning_hidden = false;
			}
			$rootScope.setHttpWarning = function(state) {
				$scope.http_warning_hidden = state;
			};

			$rootScope.unlocked = false;
			$rootScope.$on('lock', function() {
				$rootScope.unlocked = false;
			});
		});
}());