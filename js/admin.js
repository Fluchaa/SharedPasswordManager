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

$(document).ready(function() {
	var Settings = function(baseUrl) {
		this._baseUrl = baseUrl;
		this._settings = [];
	}

	Settings.prototype = {
		load: function() {
			var deferred = $.Deferred();
			var self = this;
			$.ajax({
				url: this._baseUrl,
				method: 'GET',
				async: false
			}).done(function (settings) {
				self._settings = settings;
			}).fail(function () {
				deferred.reject();
			});
			return deferred.promise();
		},
		getAll: function () {
			return this._settings;
		}
	}

	var settings = new Settings(OC.generateUrl('apps/spwm/api/v1/settings'));
	settings.load();

	console.log(settings.getAll());

	$('#spwm-tabs').tabs();
});