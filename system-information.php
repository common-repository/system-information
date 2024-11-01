<?php

/*
 *
 *	Plugin Name: System information
 *	Plugin URI: http://www.joeswebtools.com/wordpress-plugins/system-information/
 *	Description: Adds a system information page that include all the details on your WordPress configuration. Go to <a href="tools.php?page=system-information/system-information.php">Tools &rarr; System Information</a> after activating the plugin.
 *	Version: 1.0.1
 *	Author: Joe's Web Tools
 *	Author URI: http://www.joeswebtools.com/
 *
 *	Copyright (c) 2009-2014 Joe's Web Tools. All Rights Reserved.
 *
 *	This program is free software; you can redistribute it and/or modify
 *	it under the terms of the GNU General Public License as published by
 *	the Free Software Foundation; either version 2 of the License, or
 *	(at your option) any later version.
 *
 *	This program is distributed in the hope that it will be useful,
 *	but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 *	GNU General Public License for more details.
 *
 *	You should have received a copy of the GNU General Public License
 *	along with this program; if not, write to the Free Software
 *	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA 02110-1301 USA
 *
 *	If you are unable to comply with the terms of this license,
 *	contact the copyright holder for a commercial license.
 *
 *	We kindly ask that you keep links to Joe's Web Tools so
 *	other people can find out about this plugin.
 *
 */





/*
 *
 *	system_information_page
 *
 */

function system_information_page() {

	global $wp_filter;

	// Page wrapper start
	echo '<div class="wrap">';

	// Title
	screen_icon();
	echo '<h2>System Information</h2>';

	// Emails from the user database
	echo	'<div id="poststuff" class="ui-sortable">';
	echo		'<div class="postbox opened">';
	echo			'<h3>System information</h3>';
	echo			'<div class="inside">';
	echo				'<form method="post">';
	echo					'<table  class="form-table">';
	echo						'<tr>';
	echo							'<th scope="row" valign="top">';
	echo								'<b>System information</b>';
	echo							'</th>';
	echo							'<td>';
	echo								'<textarea readonly="readonly" rows="20" cols="80" wrap="off" style="font-family: monospace;" onfocus="javascript:this.select();">';

	// Server
	echo "Server\r\n";
	echo "==============================================================================================================\r\n";
	echo 'Server software: ' . $_SERVER['SERVER_SOFTWARE'] . "\r\n";
	echo 'Server name: ' . $_SERVER['SERVER_NAME'] . "\r\n";
	echo 'Server address: ' . $_SERVER['SERVER_ADDR'] . "\r\n";
	echo 'Server port: ' . $_SERVER['SERVER_PORT'] . "\r\n";
	echo "\r\n";

	// PHP
	echo 'PHP ' . phpversion() . "\r\n";
	echo "==============================================================================================================\r\n";
	$extensions = get_loaded_extensions();
	ksort($extensions);
	foreach($extensions as $extension) {
		$version = phpversion($extension);
		echo str_pad($extension, 30);
		echo phpversion($extension) . "\r\n";
	}
	echo "\r\n";

	// Wordpress
	echo 'WordPress ';
	echo bloginfo('version') . "\r\n";
	echo "==============================================================================================================\r\n";
	echo str_pad('admin_email', 30);
	echo bloginfo('admin_email') . "\r\n";
	echo str_pad('atom_url', 30);
	echo bloginfo('atom_url') . "\r\n";
	echo str_pad('charset', 30);
	echo bloginfo('charset') . "\r\n";
	echo str_pad('comments_atom_url', 30);
	echo bloginfo('comments_atom_url') . "\r\n";
	echo str_pad('comments_rss2_url', 30);
	echo bloginfo('comments_rss2_url') . "\r\n";
	echo str_pad('description', 30);
	echo bloginfo('description') . "\r\n";
	echo str_pad('home', 30);
	echo bloginfo('home') . "\r\n";
	echo str_pad('html_type', 30);
	echo bloginfo('html_type') . "\r\n";
	echo str_pad('language', 30);
	echo bloginfo('language') . "\r\n";
	echo str_pad('name', 30);
	echo bloginfo('name') . "\r\n";
	echo str_pad('pingback_url', 30);
	echo bloginfo('pingback_url') . "\r\n";
	echo str_pad('rdf_url', 30);
	echo bloginfo('rdf_url') . "\r\n";
	echo str_pad('rss2_url', 30);
	echo bloginfo('rss2_url') . "\r\n";
	echo str_pad('rss_url', 30);
	echo bloginfo('rss_url') . "\r\n";
	echo str_pad('siteurl', 30);
	echo bloginfo('siteurl') . "\r\n";
	echo str_pad('stylesheet_directory', 30);
	echo bloginfo('stylesheet_directory') . "\r\n";
	echo str_pad('stylesheet_url', 30);
	echo bloginfo('stylesheet_url') . "\r\n";
	echo str_pad('template_directory', 30);
	echo bloginfo('template_directory') . "\r\n";
	echo str_pad('template_url', 30);
	echo bloginfo('template_url') . "\r\n";
	echo str_pad('text_direction', 30);
	echo bloginfo('text_direction') . "\r\n";
	echo str_pad('url', 30);
	echo bloginfo('url') . "\r\n";
	echo str_pad('version', 30);
	echo bloginfo('version') . "\r\n";
	echo str_pad('wpurl', 30);
	echo bloginfo('wpurl') . "\r\n";
	echo "\r\n";

	// Theme
	echo "Theme\r\n";
	echo "==============================================================================================================\r\n";
	$theme_data = get_theme_data(get_stylesheet_directory() . '/style.css');
	echo 'Name: ' . $theme_data['Name'] . "\r\n";
	echo 'Version: ' . $theme_data['Version'] . "\r\n";
	echo "\r\n";

	// Plugins
	echo "Plugin                        State     Version   URI\r\n";
	echo "==============================================================================================================\r\n";
	$plugins = get_plugins();
	ksort($plugins);
	foreach($plugins as $plugin_file => $plugin_data) {
		echo str_pad($plugin_data['Title'], 30);
		if(is_plugin_active($plugin_file)) {
			echo str_pad('Active', 10);
		} else {
			echo str_pad('Inactive', 10);
		}
		echo str_pad($plugin_data['Version'], 10);
		echo $plugin_data['PluginURI'] . "\r\n";
	}
	echo "\r\n";

	// Hooks
	echo "Hook                                                        Priority  Function\r\n";
	echo "==============================================================================================================\r\n";
	$hooks = $wp_filter;
	ksort($hooks);
	foreach($hooks as $tag => $priority) {
		ksort($priority);
		foreach($priority as $priority => $function) {
			ksort($function);
			foreach($function as $name => $properties) {
				echo str_pad($tag, 60);
				echo str_pad($priority, 10);
				echo $name. "\r\n";
			}
		}
	}
	echo "\r\n";

	echo								'</textarea>';
	echo							'</td>';
	echo						'</tr>';
	echo					'</table>';
	echo				'</form>';
	echo			'</div>';
	echo		'</div>';
	echo	'</div>';

	// About
	echo	'<div id="poststuff" class="ui-sortable">';
	echo		'<div class="postbox opened">';
	echo			'<h3>About</h3>';
	echo			'<div class="inside">';
	echo				'<form method="post">';
	echo					'<table  class="form-table">';
	echo						'<tr>';
	echo							'<th scope="row" valign="top">';
	echo								'<b>Like this plugin?</b>';
	echo							'</th>';
	echo							'<td>';
	echo								'Developing, maintaining and supporting this plugin requires time. Why not do any of the following:<br />';
	echo								'&nbsp;&bull;&nbsp;&nbsp;Check out our <a href="http://www.joeswebtools.com/wordpress-plugins/">other plugins</a>.<br />';
	echo								'&nbsp;&bull;&nbsp;&nbsp;Link to the <a href="http://www.joeswebtools.com/wordpress-plugins/system-information/">plugin homepage</a>, so other folks can find out about it.<br />';
	echo								'&nbsp;&bull;&nbsp;&nbsp;Give this plugin a good rating on <a href="http://wordpress.org/extend/plugins/system-information/">WordPress.org</a>.<br />';
	echo								'&nbsp;&bull;&nbsp;&nbsp;Support further development with a <a href="https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=5162912">donation</a>.<br />';
	echo							'</td>';
	echo						'</tr>';
	echo						'<tr>';
	echo							'<th scope="row" valign="top">';
	echo								'<b>Need support?</b>';
	echo							'</th>';
	echo							'<td>';
	echo									'If you have any problems or good ideas, please talk about them on the <a href="http://www.joeswebtools.com/wordpress-plugins/system-information/">plugin homepage</a>.<br />';
	echo							'</td>';
	echo						'</tr>';
	echo						'<tr>';
	echo							'<th scope="row" valign="top">';
	echo								'<b>Credits</b>';
	echo							'</th>';
	echo							'<td>';
	echo									'<a href="http://www.joeswebtools.com/wordpress-plugins/system-information/">System information</a> is developped by Philippe Paquet for <a href="http://www.joeswebtools.com/">Joe\'s Web Tools</a>. This plugin is released under the GNU GPL version 2. If you are unable to comply with the terms of the GNU General Public License, contact the copyright holder for a commercial license.<br />';
	echo							'</td>';
	echo						'</tr>';
	echo					'</table>';
	echo				'</form>';
	echo			'</div>';
	echo		'</div>';
	echo	'</div>';

	// Page wrapper end
	echo '</div>';
}





/*
 *
 *	add_system_information_menu
 *
 */

function add_system_information_menu() {

	// Add the menu page
	add_submenu_page('tools.php', 'System Information', 'System Information', 10, __FILE__, 'system_information_page');
}

add_action('admin_menu', 'add_system_information_menu');

?>