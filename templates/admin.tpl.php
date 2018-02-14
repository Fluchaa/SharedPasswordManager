<?php
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

use \OCP\App;

script('spwm', 'admin');

style('spwm', 'admin');
style('spwm', 'vendor/fontawesome-all.min');
?>
<div id="spwm-admin-settings" class="section">
	<h2>Shared Password Manager</h2>
	<div id="spwm-tabs">
		<ul>
			<li>
				<a href="#general">General</a>
			</li>
			<li>
				<a href="#users">Users</a>
			</li>
			<li>
				<a href="#groups">Groups</a>
			</li>
		</ul>
		<div id="general">
			<label for="spwm_pepper">Application's Pepper</label>
			<input type="text" name="spwm_pepper" id="spwm_pepper" />
		</div>
		<div id="users">
			<h3>Add User for Access</h3>
			<label for="spwm_add_username">Username</label>
			<input type="text" name="spwm_add_username" id="spwm_add_username" />
			<label for="spwm_add_password">Password</label>
			<input type="password" name="spwm_add_password" id="spwm_add_password" />
			<button id="spwm_add_button">Add</button>
		</div>
		<div id="groups">

		</div>
	</div>
</div>