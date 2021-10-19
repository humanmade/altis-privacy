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
	$options = [
		'defaults' => $default_settings,
	];
	Altis\register_module( 'privacy', __DIR__, 'Privacy', $options, __NAMESPACE__ . '\\bootstrap' );
} );
