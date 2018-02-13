<?php
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
			<form name="spwm_settings">
				<label for="spwm_pepper">Application's Pepper</label>
				<input type="text" name="spwm_pepper" id="spwm_pepper" />
			</form>
		</div>
		<div id="users">

		</div>
		<div id="groups">

		</div>
	</div>
</div>