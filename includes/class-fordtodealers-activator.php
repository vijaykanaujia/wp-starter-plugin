<?php

/**
 * Fired during plugin activation
 *
 * @link       https://bytescrum.com/
 * @since      1.0.0
 *
 * @package    Fordtodealers
 * @subpackage Fordtodealers/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Fordtodealers
 * @subpackage Fordtodealers/includes
 * @author     sanjay singh <dev8@bytescrum.com>
 */
class Fordtodealers_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		global $wpdb;
		$table_name = "{$wpdb->prefix}fortodealers_modal_list";
		$charset_collate = $wpdb->get_charset_collate();

		$sql = "CREATE TABLE IF NOT EXISTS $table_name (
			`id` int(11) NOT NULL AUTO_INCREMENT,
  			`modal_name` TEXT(100) NOT NULL,
			`modal_class` TEXT(100) NOT NULL,
			`modal_image_url` TEXT NULL,
  			`price` TEXT NOT NULL,
			`page_id` int(11) NOT NULL,
  			PRIMARY KEY (`id`),
			INDEX `modal_name` (`modal_name`),
			INDEX `modal_class` (`modal_class`),
			INDEX `price` (`price`),
			INDEX `page_id` (`page_id`)
		  ) $charset_collate;";
		// echo $charset_collate;
		// die;
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		dbDelta($sql);
	}

}
