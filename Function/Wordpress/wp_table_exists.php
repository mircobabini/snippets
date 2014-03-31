<?

/**
 * @global wpdb $wpdb
 * @param string $tableName
 * @return bool
 */
function wp_table_exists ($tableName) {
	global $wpdb;
	return ($wpdb->get_var("SHOW TABLES LIKE '$tableName'") == $tableName);
}