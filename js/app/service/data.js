(function() {
	'use strict';

	angular.module('spwm').service('DataService',
		function($http) {
			return {
				getCategories: function() {
					var queryUrl = OC.generateUrl('/apps/spwm/api/v1/categories');
					return $http.get(queryUrl).then(function(response) {
						if(response.data) {
							return response.data;
						} else {
							return response;
						}
					});
				},
				getGroups: function() {
					var queryUrl = OC.generateUrl('/apps/spwm/api/v1/groups');
					return $http.get(queryUrl).then(function(response) {
						if(response.data) {
							return response.data;
						} else {
							return response;
						}
					});
				}
			};
		});
}());