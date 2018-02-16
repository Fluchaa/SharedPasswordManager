(function() {
	'use strict';

	angular.module('spwm').service('CredentialService',
		function($http) {
			var _this = this;
			var credential = {
				item_id: null,
				label: null,
				username: null,
				password: null,
				email: null,
				url: null,
				ip: null,
				description: null,
				group_id: null,
				category_id: null
			};

			return {
				newCredential: function() {
					return angular.copy(credential);
				},
				createCredential: function(credential) {
					var queryUrl = OC.generateUrl('/apps/spwm/api/v1/credential');
					return $http.post(queryUrl, {credential: JSON.stringify(credential)}).then(function(response) {
						if(response.data) {
							return response.data;
						} else {
							return response;
						}
					});
				},
				getCredential: function(item_id) {
					var queryUrl = OC.generateUrl('/apps/spwm/api/v1/credential/' + item_id);
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