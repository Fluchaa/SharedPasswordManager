/**
 * @copyright Copyright (c) 2018 niTEC GesbR https://nitec.at
 * @author Michael Flucher <michael.flucher@nitec.at>
 *
 * Permission is hereby granted to 
 *
 * all our Customers
 *
 * obtaining a copy of this software and associated documentation files (the "Software"), 
 * to deal in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge or publish this Software. 
 *
 * Noone is permitted to use or sell parts of the Software or the whole Software 
 * without the written permission of niTEC GesbR. 
 */

(function() {
	'use strict';

	angular.module('spwm', [
		'ngRoute',
		'templates'
	]).config(function($routeProvider, $locationProvider) {
		$routeProvider.when('/', {
			templateUrl: 'views/unlock.html',
			controller: 'UnlockCtrl'
		}).when('/vault', {
			templateUrl: 'views/vault.html',
			controller: 'VaultCtrl'
		}).otherwise({
			redirectTo: '/'
		});

		// remove the ugly ! in url
		$locationProvider.hashPrefix('');
	}).config(function($httpProvider) {
		// Needed for CSRF Check
		$httpProvider.defaults.headers.common.requesttoken = oc_requesttoken;
	});

	jQuery(document).ready(function() {
		console.log(`%c                           _ __________________
                    ____  (_)_  __/ ____/ ____/
                   / __ \\/ / / / / __/ / /     
                  / / / / / / / / /___/ /___   
                 /_/ /_/_/ /_/ /_____/\\____/   `, 'font-family:monospace');
	});
}());