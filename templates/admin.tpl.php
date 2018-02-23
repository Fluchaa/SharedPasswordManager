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

	<div id="spwm-alert"></div>
	<div id="spwm-tabs">
		<ul>
			<li>
				<a href="#users">Users</a>
			</li>
			<li style="display:none">
				<a href="#edit-user">Edit User</a>
			</li>
			<li id="groups-link" style="display:none">
				<a href="#groups">Groups</a>
			</li>
			<li>
				<a href="#categories">Categories</a>
			</li>
		</ul>

		<div id="users">
			<h3>Add User for Access</h3>
			<label for="spwm_add_username">Username</label>
			<input type="text" name="spwm_add_username" id="spwm_add_username" />
			<label for="spwm_add_password">Password</label>
			<input type="password" name="spwm_add_password" id="spwm_add_password" />
			<button id="spwm_add_user_button">Add</button>

			<h3>List of current Users</h3>
			<table id="users_table" class="table">
				<thead>
					<tr>
						<th>UserID</th>
						<th>Name</th>
						<th></th>
					</tr>
				</thead>
				<tbody>

				</tbody>
			</table>
			<div id="user_table_pagination">
				<ul class="pagination">
				</ul>
			</div>
		</div>

		<div id="edit-user">
			
		</div>

		<div id="groups">
			<h3>Add Groups</h3>
			<label for="spwm_add_group">Group</label>
			<input type="text" name="spwm_add_group" id="spwm_add_group" />
			<button id="spwm_add_group_button">Add</button>

			<h3>List of Groups</h3>
			<table id="groups_table" class="table">
				<thead>
					<tr>
						<th>Name</th>
						<th></th>
					</tr>
				</thead>
				<tbody>

				</tbody>
			</table>
		</div>

		<div id="categories">
			<h3>Add Categories</h3>
			<label for="spwm_add_category">Category</label>
			<input type="text" name="spwm_add_category" id="spwm_add_category" />
			<button id="spwm_add_category_button">Add</button>

			<h3>List of Categories</h3>
			<table id="categories_table" class="table">
				<thead>
					<tr>
						<th>Name</th>
						<th></th>
					</tr>
				</thead>
				<tbody>

				</tbody>
			</table>
		</div>
	</div>
</div>
