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
	};

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
		getAll: function() {
			return this._settings;
		},
		getKey: function(key) {
			if(this._settings.hasOwnProperty(key)) {
				return this._settings[key];
			}
			return false;
		},
		setKey: function(key, value) {
			$.ajax({
				url: this._baseUrl + '/admin/' + key,
				method: 'POST',
				data: {value: value}
			}).done(function (response) {
				console.log(response);
			}).fail(function (response) {
				console.log(response);
			});
		},
		firstrun: function() {
			$.ajax({
				url: this._baseUrl + '/firstrun',
				method: 'GET',
				async: false
			}).done(function (response) {
				console.log(response);
			}).fail(function (response) {
				console.log(response);
			});
		}
	};

	// get data
	var settings = new Settings(OC.generateUrl('apps/spwm/api/v1/settings'));
	settings.load();

	// check for first run - generate pepper
	if(settings.getKey('pepper') === "") {
		settings.firstrun();
	} 

	// insert gathered data
	$('#spwm_pepper').val(settings.getKey('pepper'));

	$('#spwm_pepper').change(function() {
		settings.setKey('pepper', $(this).val());
	});

	$('#spwm-tabs').tabs();
});