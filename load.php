<?php
/**
 * Privacy Module.
 *
 * @package altis/privacy
 */

namespace Altis\Privacy; // phpcs:ignore

use Altis;

add_action( 'altis.modules.init', function () {
	$default_settings = [
		'enabled' => true,
		'consent' => true,
	];

	Altis\register_module( 'privacy', __DIR__, 'Privacy', $default_settings, __NAMESPACE__ . '\\bootstrap' );
} );
