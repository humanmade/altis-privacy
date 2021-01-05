<?php
/**
 * Altis Consent Google Tag Manager Integration
 *
 * @package altis/privacy
 */

namespace Altis\Privacy\GTM;

use Altis;

/**
 * Kick it off.
 */
function bootstrap() {
	$gtm = Altis\get_config()['modules']['analytics']['google-tag-manager'];

	// Bail if we aren't using GTM.
	if ( empty( $gtm ) ) {
		return;
	}

	add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\enqueue_scripts', 11 );
}

/**
 * Add inline tag manager script to Consent API JS.
 */
function enqueue_scripts() {
	wp_add_inline_script(
		'altis-consent',
		sprintf(
			// Ensure data layer variable is available.
			'var %1$s = window.%1$s || [];' .
			// Push initial consented categories into data layer.
			'%1$s.push( { event: \'altis-consent-changed\', altisConsent: Altis.Consent.getCategories().join( \', \' ) + \',\' } );' .
			// Listen for updates to consented categories.
			'document.addEventListener( \'wp_listen_for_consent_change\', function () { %1$s.push( { event: \'altis-consent-changed\', altisConsent: Altis.Consent.getCategories().join( \', \' ) + \',\' } ) } );',
			// Documented in /vendor/humanmade/hm-gtm/inc/namespace.php.
			apply_filters( 'hm_gtm_data_layer_var', 'dataLayer' )
		),
		'after'
	);
}
