<?php
/**
 * Privacy Module.
 *
 * @package altis/privacy
 */

namespace Altis\Privacy; // @codingStandardsIgnoreLine

use function Altis\register_module;

add_action( 'altis.modules.init', function () {
	$default_settings = [
		'enabled' => true,
		'consent' => true,
	];
	register_module( 'privacy', __DIR__, 'Privacy', $default_settings, __NAMESPACE__ . '\\bootstrap' );
} );
