<?php
/**
 * Altis Consent API
 *
 * @package altis/privacy
 */

namespace Altis\Privacy\Consent;

use Altis;
use Altis\Consent;

/**
 * Kick it off.
 */
function bootstrap() {
	$config = Altis\get_config()['modules']['privacy']['consent'];

	// Unless the consent module has been deactivated, load the plugins.
	if ( empty( $config ) ) {
		return;
	}

	add_action( 'plugins_loaded', __NAMESPACE__ . '\\load_plugins', 1 );

	// Ensure native analytics consent is enabled.
	add_filter( 'altis.analytics.consent_enabled', __NAMESPACE__ . '\\analytics_integration_enabled' );
}

/**
 * Load plugins that are part of the consent module.
 */
function load_plugins() {
	require_once Altis\ROOT_DIR . '/vendor/altis/consent-api/plugin.php';
	require_once Altis\ROOT_DIR . '/vendor/altis/consent/plugin.php';
}

/**
 * Check if the consent banner is displayed to activate analytics integration.
 *
 * @return bool
 */
function analytics_integration_enabled() : bool {
	return Consent\should_display_banner();
}
