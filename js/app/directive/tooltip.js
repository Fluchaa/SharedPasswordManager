(function() {
	'use strict';

	angular.module('spwm').directive('tooltip',
		function() {
			return {
				restrict: 'A',
				scope: {
					tooltip: '=tooltip'
				},

				link: function (scope, el) {
					scope.$watch('tooltip', function () {
						if (scope.tooltip) {
							jQuery(el).attr('title', scope.tooltip);
							jQuery(el).tooltip();
							jQuery(el).attr('title', scope.tooltip).tooltip('fixTitle');
							jQuery('.tooltip-inner').text(scope.tooltip); // Dirty hack
							if (jQuery(el).is(':visible')) {
								//$(el).tooltip('show')
							}

						}
					});
				}
			};
		});
}());