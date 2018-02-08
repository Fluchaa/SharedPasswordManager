var app = angular.module('spwm', []);

app.controller('unlockCtrl', function($scope) {
	$scope.unlock = function() {
		alert($scope.password);
	}
});