<?php
/**
 * ACF Integration Class
 *
 * @link       https://searchandfilter.com
 * @since      3.0.0
 * @package    Search_Filter_Pro/Integrations
 */

namespace Search_Filter_Pro\Integrations;

use Search_Filter\Core\Dependants;
use Search_Filter\Integrations\Settings as Integrations_Settings;
use Search_Filter_Pro\Core\Plugin_Installer;

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 */
class Beaver_Builder {

	private static $plugin_file = 'search-filter-bb/search-filter-bb.php';

	/**
	 * Init
	 *
	 * @since    3.0.0
	 */
	public static function init() {
		add_action( 'search-filter/settings/init', array( __CLASS__, 'update_integration' ), 10 );
		add_filter( 'search-filter/integrations/install-extension', array( __CLASS__, 'install_extension' ), 10, 2 );
		add_action( 'search-filter/integrations/enable', array( __CLASS__, 'enable_extension' ), 10, 1 );
		add_action( 'search-filter/integrations/disable', array( __CLASS__, 'disable_extension' ), 10, 1 );
		add_action( 'search-filter/integrations/validate', array( __CLASS__, 'validate_integration' ), 10, 1 );
	}


	/**
	 * Update the ACF integration in the integrations section.
	 *
	 * @since 3.0.0
	 */
	public static function update_integration() {
		// We want to disable coming soon notice and enable the integration toggle.
		$beaver_builder_integration = Integrations_Settings::get_setting( 'beaverbuilder' );
		if ( ! $beaver_builder_integration ) {
			return;
		}

		$is_beaver_builder_enabled = self::beaver_builder_enabled();

		$update_integration_settings = array(
			'isPluginEnabled' => $is_beaver_builder_enabled,
		);

		// If we detect Beaver Builder is enabled, then lets also set the plugin installed
		// property to true - because a plugin could be installed using a different
		// folder name and it we would initially detect is as not installed by using
		// by using `plugin_exists()` which is unreliable.
		if ( $is_beaver_builder_enabled ) {
			$update_integration_settings['isPluginInstalled'] = true;
		}
		// Also check if the extension plugin is installed.
		if ( Dependants::is_plugin_installed( self::$plugin_file ) ) {
			$update_integration_settings['isExtensionInstalled'] = true;
		}

		$beaver_builder_integration->update( $update_integration_settings );

		// TODO - we need to add a hook, so that if Beaver Builder is disabled, we switch our toggle to "off"
		// Also: if we switch it to "on", we automatically enable the integration, and install it if its
		// not there...
	}

	public static function install_extension( $installed, $extension ) {
		if ( $extension !== 'beaverbuilder' ) {
			return $installed;
		}
		if ( ! current_user_can( 'install_plugins' ) ) {
			return false;
		}

		if ( ! function_exists( '\request_filesystem_credentials' ) ) {
			require_once ABSPATH . 'wp-admin/includes/file.php';
		}

		// Try to install the BB extension.
		$plugin_installer = new Plugin_Installer();
		$result           = $plugin_installer->install_package_from_api( 197286 );

		if ( $result['status'] !== 'success' ) {
			return false;
		}

		if ( current_user_can( 'activate_plugins' ) ) {
			$activate_plugin = activate_plugin( self::$plugin_file );
			if ( is_wp_error( $activate_plugin ) ) {
				return false;
			}
			return true;
		}

		return false;
	}

	public static function enable_extension( $extension ) {
		if ( $extension !== 'beaverbuilder' ) {
			return;
		}
		if ( ! Dependants::is_plugin_enabled( self::$plugin_file ) ) {
			Dependants::enable_plugin( self::$plugin_file );
		}
	}
	public static function disable_extension( $extension ) {
		if ( $extension !== 'beaverbuilder' ) {
			return;
		}

		// Then disable the extension plugin if its enabled.
		if ( Dependants::is_plugin_enabled( self::$plugin_file ) ) {
			Dependants::disable_plugin( self::$plugin_file );
		}
	}
	/**
	 * Check if BB is enabled.
	 *
	 * @since 3.0.0
	 *
	 * @return bool    True if Relevanssi is enabled.
	 */
	private static function beaver_builder_enabled() {
		return defined( 'FL_BUILDER_VERSION' );
	}

	/**
	 * Validate the BB integration settings.
	 *
	 * @since 3.0.0
	 */
	public static function validate_integration() {
		// First check the status of the integration.
		$is_enabled = \Search_Filter\Integrations::is_enabled( 'beaverbuilder' );

		// Now check to make sure the Elementor plugin and Elementor extensions are enabled.
		$is_plugin_enabled    = self::beaver_builder_enabled();
		$is_extension_enabled = Dependants::is_plugin_enabled( self::$plugin_file );

		// If the integration is enabled, but the plugin or extension is not, then disable the integration.
		if ( $is_enabled && ( ! $is_plugin_enabled || ! $is_extension_enabled ) ) {
			\Search_Filter\Integrations::disable( 'beaverbuilder', true );
			// TODO - we want to add a notice to let the user know we had to disable the integration.
		}

		// If the integration is disabled, but the plugin and extension are enabled, then enable the integration.
		if ( ! $is_enabled && $is_plugin_enabled && $is_extension_enabled ) {
			\Search_Filter\Integrations::enable( 'beaverbuilder', true );
		}
	}
}
