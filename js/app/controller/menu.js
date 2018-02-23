(function() {
	'use strict';

	angular.module('spwm').controller('MenuCtrl',
		function($scope, $rootScope, $location, DataService) {
			// fill categories
			$scope.categories = [];
			DataService.getCategories().then(function(response) {
				response.unshift({
					'category_id': 0,
					'name': 'Default'
				});
				$scope.categories = response;
			});

			$scope.categoryClicked = function(category) {
				$scope.selectedCategory = category;
			};

			$scope.$watch('selectedCategory', function() {
				$rootScope.$broadcast('selected_category_changed', $scope.selectedCategory);
			});
		});
}());