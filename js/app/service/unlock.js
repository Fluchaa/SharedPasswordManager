(function() {
	'use strict';

	angular.module('spwm').service('UnlockService', 
		function($http) {
			var _this = this;

			return {
				unlock: function(password) {
					console.log('service');
					var queryUrl = OC.generateUrl('/apps/spwm/api/v1/unlock');
					return $http.post(queryUrl, {password: password});
				}
			};
		});
}());