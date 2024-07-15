# PHP Function Reference

**Note:** All functions are in the Altis Consent plugin use the `Altis\Consent` namespace except where noted.

## `load_consent_banner`

Loads the templates used to display the cookie consent banner. The path to the banner can be customized using
the [`altis.consent.consent_banner_path`](./filter-reference.md#altisconsentconsent_banner_path) filter.

* Uses [`load_template`](https://developer.wordpress.org/reference/functions/load_template/)
* See [`altis.consent.consent_banner_path`](./filter-reference.md#altisconsentconsent_banner_path)

### Example

```php
function render_consent_banner() : string {
    ob_start();
    load_consent_banner();
    return ob_get_clean();
}
```

## `should_display_banner`

Determines whether the banner should be displayed. Uses the `display_banner` setting defined in the admin but can be filtered by
using the [`altis.consent.should_display_banner`](./filter-reference.md#altisconsentshould_display_banner) filter.

* Uses [`Settings\get_consent_option`](#settingsget_consent_option)
* See [`altis.consent.should_display_banner`](./filter-reference.md#altisconsentshould_display_banner)

### Return

`bool`: Whether the banner should be displayed.

### Example

```php
function load_consent_banner() {
    // Check if we need to load the banner.
    if ( should_display_banner() ) {
            load_template( plugin_dir_path( __DIR__ ) . 'tmpl/consent-banner.php' );
    }
}
```

## `cookie_prefix`

Returns the default consent cookie prefix.

* See [`altis.consent.cookie_prefix`](./filter-reference.md#altisconsentcookie_prefix)

### Return

`string`: The consent cookie prefix. Defaults to `altis_consent`.

### Example

```php
wp_localize_script( 'altis-consent', 'altisConsent', [
    'cookiePrefix' => cookie_prefix(),
] );
```

## `consent_types`

Returns the active consent types.

* See [`altis.consent.types`](./filter-reference.md#altisconsenttypes)

### Return

`array`: The list of currently allowed consent types. Defaults are `optin` and `optout`.

### Example

```php
wp_localize_script( 'altis-consent', 'altisConsent', [
    'consentTypes' => consent_types(),
] );
```

## `consent_categories`

Returns a list of active consent categories.

* See [`altis.consent.categories`](./filter-reference.md#altisconsentcategories)

### Return

`array`: The list of currently allowed consent categories. Defaults
are `functional`, `preferences`, `statistics`, `statistics-anonymous`, and `marketing`.

### Example

```php
wp_localize_script( 'altis-consent', 'altisConsent', [
    'categories' => consent_categories(),
] );
```

## `consent_category_labels`

Returns a list of consent categories with labels.

* See [`altis.consent.category_labels`](./filter-reference.md#altisconsentcategorylabels)

### Return

`array`: The list of currently allowed consent categories. Defaults are "Functional", "Preferences", "Statistics", "Anonymous
statistics" and "Marketing".

### Example

```php
wp_localize_script( 'altis-consent', 'altisConsent', [
    'labels' => consent_category_labels(),
] );
```

## `get_category_label`

Returns the label for a given consent category.

### Parameters

* **`$category`** `string` The category to get the label for.

### Return

`string`: The label or an empty string if the `$category` is unknown.

### Example

```php
echo esc_html( Consent\get_category_label( 'preferences' ) );
```

## `consent_values`

Returns a list of active possible consent values.

* See [`altis.consent.values`](./filter-reference.md#altisconsentvalues)

### Return

`array`: A list of possible consent values. Defaults are `allow` and `deny`.

### Example

```php
wp_localize_script( 'altis-consent', 'altisConsent', [
    'values' => consent_values(),
] );
```

## `validate_consent_item`

Validates a consent item (either a consent _type_, _category_ or _value_).

### Parameters

* **`$item`** `string` The value to validate.
* **`$item_type`** `string` The type of value to validate. Possible options are `types` (consent types,
see [`consent_types`](#consent_types)), `categories` (consent categories, see [`consent_categories`](#consent_categories)),
or `values` (consent values, see [`consent_values`](#consent_values)).

### Return

`string`|`bool`: The validated string or `false` if unable to validate. Triggers a warning if either the `$item_type` or the `$item`
is invalid.

### Example

```php
if ( ! Consent\validate_consent_item( $category, 'category' ) ) {
    // Do something.
}
```

## `get_cookie_policy_url`

Retrieves the URL to the cookie policy page. Can be filtered by
the [`altis.consent.cookie_policy_url`](./filter-reference.md#altisconsentcookie_policy_url) filter.

* Uses [`Settings\get_consent_option`](#settingsget_consent_option)
* Uses [`get_post_type`](http://developer.wordpress.org/reference/functions/get_post_type/)
* Uses [`get_page_uri`](http://developer.wordpress.org/reference/functions/get_page_uri/)

### Return

`string`: The cookie policy page URL.

### Example

```php
<div class="cookie-consent-policy">
    <a href="<?php echo esc_url( Altis\Consent\get_cookie_policy_url() ); ?>">
        <?php esc_html_```'Read our cookie policy', 'altis-consent' ) ); ?>
    </a>
</div>
```

## `Settings\get_consent_option`

**Note:** Defined in the `Altis\Consent\Settings` namespace.

Get a specific consent option, if one exists. If no parameters are passed, returns all the saved consent option values.

* Uses [`get_option`](https://developer.wordpress.org/reference/functions/get_option/)

### Parameters

* **`$option`** `mixed` (Optional) A consent option name. The option must exist in the `cookie_consent_options` group. Default
is an empty string. If no value is passed, all the saved `cookie_consent_options` option values will be returned.
* **`$default`** `mixed` (Optional) A default value to return if no option for that value has been set. Default is an empty string.
Requires an `$option` parameter to be passed.

### Return

`mixed`: The value for the requested option, or an array of all `cookie_consent_options` if nothing was passed.

### Example

```php
$cookie_expiration = Altis\Consent\Settings\get_consent_option( 'cookie_expiration', 30 );
```

## `Settings\get_default_banner_message`

**Note:** Defined in the `Altis\Consent\Settings` namespace.

Gets the default banner message. Filterable with
the [`altis.consent.default_banner_message`](./filter-reference.md#altisconsentdefault_banner_message) filter.

### Return

`string`: The default cookie consent banner message.

### Example

```php
use Altis\Consent\Settings;

if ( ! Settings\get_consent_option( 'banner_message' ) ) {
    echo wp_kses_post( Settings\get_default_banner_message() );
}
```

## `Settings\render_secondary_button`

**Note:** Defined in the Altis\Consent\Settings namespace.

Display a secondary button.

Used to create the Create Policy Page buttons, but can be filtered and used for other things.

### Parameters

* **`$button_text`** `string` The text to display in the button.
* **`$value`** `string` The button value. On the settings page, this is used to determine the type of policy page the buttons
create.
* **`$type`** `string` The HTML button type. The default value is `'submit'`, and valid values are `'submit'`, `'reset'`,
and `'button'`. Invalid values revert to `'submit'`.

### Example

```php
Settings\render_secondary_button( _```'Create Cookie Policy Page', 'altis-consent' ), 'cookie_policy' );
```

<!-- markdownlint-disable-file MD024 -->
