<?php
/*
Plugin Name: Hide Update Reminder
Plugin URI: http://www.stuffbysarah.net/wordpress-plugins/remove-update-reminder/
Description: Allows you to remove the upgrade Nag screen from view for selected user roles
Author: Sarah Anderson
Version: 2.0
Author URI: http://www.stuffbysarah.net/
License: GPLv2
License URI:  https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: hide-update-reminder
Domain Path: /languages

Thanks to Viper007Bond for the admin notice hook
*/

class HideUpdateReminder
{
	function __construct()
	{
		add_action( 'admin_init', [ $this, 'check_user' ] );
		add_action('admin_menu', [ $this, 'add_options_link' ] );
	}

	function check_user()
	{
		if ( ! current_user_can( 'update_core' ) ) :
			remove_action('admin_notices', 'update_nag', 3);
		endif;
	}
	
	function add_options_link()
	{
		add_options_page( 'Hide Update Reminder Settings', 'Hide Update Reminder', 'manage_options', 'hide-update-rem', [ $this, 'options_page' ] );
	}
	
	function options_page()
	{
	?>
   		<div class="wrap">
			<form action="options.php" method="post">
       			<?php
				settings_fields( 'hide-update-rem-settings' );
				do_settings_sections( 'hide-update-rem-settings' );
			?>
			</form>
 		</div>
 	<?php
	}
}

$hideupdaterem = new HideUpdateReminder();
