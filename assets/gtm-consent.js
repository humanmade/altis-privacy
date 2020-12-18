/* global altisConsentGtm */

/**
 * Send consent status to GTM.
 */

// Use the Altis namespace. Since it's declared as a var, we can't redeclare as a let or const.
var Altis = window.Altis || {}; // eslint-disable-line no-var

// Set existing consent statuses, if there are any.
window[altisConsentGtm.dataLayer].push( 'consentInit', Altis.Consent.getCategories );

// Listen for changes in consent status.
document.addEventListener( 'wp_listen_for_consent_change', function ( e ) {
	const dataLayer = altisConsentGtm.dataLayer;

	window[dataLayer].push( 'consentChange', e.detail );
} );
