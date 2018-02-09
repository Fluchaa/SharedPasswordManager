app.factory('AuthService', ['$http', 
	function($http) {
		return {
			unlock: function(password) {
				return $http({
					url: OC.generateUrl('/apps/spwm/api/v1/unlock'),
					method: 'POST',
					data: password
				})
			}
		}
	}]);