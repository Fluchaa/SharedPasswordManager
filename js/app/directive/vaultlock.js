(function() {
	'use strict';

	angular.module('spwm').directive('vaultLockDirective',
		function() {
			return {
				restrict: 'A',
				link: function(scope, elem, attr) {
					scope.$watch('alert_type', function(alert_type) {
						if(alert_type === 'alert-success') {
							elem.css({'color':'#3c763d'});
							elem.removeClass('fa-lock').addClass('fa-lock-open');
						} else if(alert_type ==='alert-error') {
							elem.css({'color':'#a94442'});
						} else {
							elem.css({'color':'#000'});
						}
					});
				}
			};
		});
}());