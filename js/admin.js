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
		}/*,
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
		}*/
	};

	var Groups = function(baseUrl) {
		this._baseUrl = baseUrl;
		this._groups = [];
	};

	Groups.prototype = {

	};

	var Users = function(baseUrl) {
		this._baseUrl = baseUrl;
		this._users = [];
	};

	Users.prototype = {
		load: function() {

		},
		addUser: function(userId, password) {
			$.ajax({
				url: this._baseUrl + '/add/' + userId,
				method: 'POST',
				data: {password: password}
			}).done(function (response) {
				console.log(response);
			}).fail(function (response) {
				console.log(response);
			});
		}
	};

	// get settings
	var settings = new Settings(OC.generateUrl('apps/spwm/api/v1/settings'));
	settings.load();

	// check for first run - generate pepper
	// pepper is stored in DB => useless
	/*if(settings.getKey('pepper') === "") {
		settings.firstrun();
	} */

	// insert gathered data
	$('#spwm_pepper').val(settings.getKey('pepper'));

	$('#spwm_pepper').change(function() {
		settings.setKey('pepper', $(this).val());
	});

	// get users
	var users = new Users(OC.generateUrl('apps/spwm/admin'));

	$('#spwm_add_username').autocomplete({
		source: OC.generateUrl('apps/spwm/admin/search'),
		minLength: 1
	});

	$('#spwm_add_button').click(function() {
		users.addUser($('#spwm_add_username').val(), $('#spwm_add_password').val());
	});

	$('#spwm-tabs').tabs();
});