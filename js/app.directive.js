app.directive('lockDirective', [
	function() {
		return {
			restrict: 'A',
			link: function(scope, elem, attr) {
				scope.$watch('unlocked', function(unlocked) {
					console.log(unlocked);
					if(unlocked == 1) {
						elem.css({'color':'#3c763d'});
						elem.removeClass('fa-lock').addClass('fa-lock-open');
					} else if(unlocked == 0) {
						elem.css({'color':'#a94442'});
					} else {
						elem.css({'color':'#000'});
					}
				});
			}
		}
	}]);
app.directive('lockAlertDirective', [
	function() {
		return {
			restrict: 'A',
			link: function(scope, elem, attr) {
				scope.$watch('unlocked', function(unlocked) {
					if(unlocked == 1) {
						elem.show();
						elem.removeClass('alert-error');
						elem.addClass('alert-success');
					} else if(unlocked == 0) {
						elem.show();
						elem.removeClass('alert-success');
						elem.addClass('alert-error');
					} else {
						elem.hide();
					}
				});
			}
		}
	}]);