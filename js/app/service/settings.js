(function() {
	'use strict';

	angular.module('spwm').service('SettingsService',
		function(localStorageService, $http, $rootScope) {
			var settings = {};

			return {
				getSettings: function() {
					return settings;
				},
				getSetting: function(name) {
					return settings[name];
				},
				setSetting: function(name, value) {
					settings[name] = value;
					localStorageService.set('settings', settings);
				},
				isEnabled: function(name) {
					return settings[name] === 1 || settings[name] === '1';
				}
			};
		});
}());