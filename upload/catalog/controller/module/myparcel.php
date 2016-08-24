<?php
/*
 *  location: catalog/controller
 */
class ControllerModuleMyparcel extends Controller {

	public function save_pg_address()
	{
		$action = isset($_GET['action']) ? $_GET['action'] : '';

		if ($action == 'save_pg_address') {

			global $db;

			$check_if_table = $db->query("SHOW TABLES LIKE '" . DB_PREFIX . "orders_myparcel_pg_address'");
			if ($check_if_table->num_rows < 1)
			{
				$db->query("CREATE TABLE IF NOT EXISTS " . DB_PREFIX . "orders_myparcel_pg_address (
							`pg_address_id` int(11) NOT NULL AUTO_INCREMENT,
							`name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
							`street` varchar(255) COLLATE utf8_unicode_ci NULL,
							`house_number` varchar(255) COLLATE utf8_unicode_ci NULL,
							`number_addition` varchar(255) COLLATE utf8_unicode_ci NULL,
							`postcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
							`town` varchar(255) COLLATE utf8_unicode_ci NULL,
							PRIMARY KEY (`pg_address_id`));"
				);
			}
			/*if (version_compare(phpversion(), '5.4.0', '<')) {
				if (session_id() == '') session_start();
			} else {
				if (session_status() == PHP_SESSION_NONE) {
					session_start();
				}
			}*/

			$company_name = $_GET['pg_extra_name'];
			$street = $_GET['pg_extra_street'];
			$house_number = $_GET['pg_extra_house_number'];
			$number_addition = $_GET['pg_extra_number_addition'];
			$postcode = $_GET['pg_extra_postcode'];
			$town = $_GET['pg_extra_town'];

			$pg_address_query = $db->query(
				sprintf("
					SELECT * FROM " . DB_PREFIX . "orders_myparcel_pg_address WHERE (`name` = '%s' AND `postcode`='%s')
				",
					$company_name,
					$postcode
				)
			);

			if ($pg_address_query->num_rows == 0) {
				$db->query(
					sprintf("
					INSERT INTO " . DB_PREFIX . "orders_myparcel_pg_address
					(`name`, `street`, `house_number`, `number_addition`, `postcode`, `town`)
					VALUES ('%s', '%s', '%s', '%s', '%s', '%s');
				",
						$company_name,
						$street,
						$house_number,
						$number_addition,
						$postcode,
						$town
					)
				);
			}
		}
	}
}