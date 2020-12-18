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

	// Filter native analytics consent cookie prefix.
	add_filter( 'altis.analytics.consent_cookie_prefix', __NAMESPACE__ . '\\enable_analytics_consent' );
}

/**
 * Load plugins that are part of the consent module.
 */
function load_plugins() {
	require_once Altis\ROOT_DIR . '/vendor/altis/consent-api/plugin.php';
	require_once Altis\ROOT_DIR . '/vendor/altis/consent/plugin.php';
}

/**
 * Filter the Analytics plugin consent cookie prefix.
 *
 * @param string|null $cookie_prefix The analytics consent cookie prefix or null.
 * @return string|null
 */
function enable_analytics_consent( ?string $cookie_prefix ) {
	if ( ! Consent\should_display_banner() ) {
		return $cookie_prefix;
	}

	return Consent\cookie_prefix();
}
