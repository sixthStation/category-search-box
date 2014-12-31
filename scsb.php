<?php
/**
 * Plugin Name: Sixth Station – Category Search Box (Scsb)
 * Plugin URI: http://sixthstation.de
 * Description: Add a little search box to filter category lists
 * Version: 0.1
 * Author: René Schulze, kontakt@rene-schulze.info
 * Author URI: http://sixthstation.de
 * License: GPL2
 * Text Domain: scsb
 */

/*  Copyright 2014  René Schulze  (email : kontakt@rene-schulze.info)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

?><?php

namespace Scsb;

/**
 * Stop direct access
 *
 */
if( preg_match('#' . basename(__FILE__) . '#', $_SERVER['PHP_SELF']) ) {
	die('No direct access.');
}

$correct_php_version = version_compare( phpversion(), "5.3", ">=" );

if( !$correct_php_version ) {
	echo 'Sixth Station Category Search Box Plugin requires <strong>PHP 5.3</strong> or higher.<br />';
	echo 'You are running PHP ' . phpversion();
	exit;
}

// Constants
define(__NAMESPACE__ . '\PLUGIN_FILE_NAME', strtolower( preg_replace( '/([a-z])([A-Z])/', '$1-$2', __NAMESPACE__ ) ) . '.php');
define(__NAMESPACE__ . '\PLUGIN_DIR' , plugin_dir_path( __FILE__ ));
define(__NAMESPACE__ . '\PLUGIN_FILE', PLUGIN_DIR . PLUGIN_FILE_NAME);
define(__NAMESPACE__ . '\PLUGIN_URL' , plugins_url( '', PLUGIN_FILE ));
define(__NAMESPACE__ . '\TEXTDOMAIN', strtolower( __NAMESPACE__ ));

// Language
load_plugin_textdomain( TEXTDOMAIN, false, dirname( plugin_basename( __FILE__ ) ) . '/includes/languages/');

// Plugin administration hooks
register_activation_hook(   PLUGIN_FILE, __NAMESPACE__ . '\activate' );
register_deactivation_hook( PLUGIN_FILE, __NAMESPACE__ . '\deactivate' );
register_uninstall_hook(    PLUGIN_FILE, __NAMESPACE__ . '\uninstall' );


/**
 * Actions for activation
 *
 * @param var $network_wide
 * @return void
 **/
function activate( $network_wide ) {

}


/**
 * Actions for deactivation
 *
 * @return void
 **/
function deactivate() {

}


/**
 * Actions for uninstallation
 *
 * @return void
 **/
function uninstall() {

}


/**
 * Add meta box for locations
 *
 **/
add_action( 'admin_init', function () {
	// Enqueue CSS file
	$cssFile = \Scsb\PLUGIN_URL . '/includes/style/style.css';
	wp_enqueue_style('scsb', $cssFile);

	// Enqueue JS file
	$jsFile = \Scsb\PLUGIN_URL . '/includes/script/script.js';
	wp_enqueue_script('scsb', $jsFile, array('jquery'));
});


/**
 * Add language variables to wp head for JS use
 *
 **/
add_action( 'admin_head', function() {

	$filterCategories = __('Filter categories', TEXTDOMAIN);

	$output = <<<JS

<script>
	var scsbLanguage = {
		filterCategories: "{$filterCategories}"
	};
</script>

JS;

	echo $output;
});