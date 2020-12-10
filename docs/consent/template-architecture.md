# Template Architecture

The Altis Consent module comes with a default banner that can be customized via the [filters](/Filter-Reference) provided for the messaging and button text. However, those templates can be replaced entirely or only specific templates can be replaced by your own in a theme or plugin.

The default banner templates are located in the `/tmpl` directory.

## Overriding the default templates

Overriding the default templates is easy. You can either override all of them using the [`altis.consent.consent_banner_path` filter](/Filter-Reference#altisconsentconsent_banner_path) and defining the path to your main consent banner template file. Or you can override individual templates, keeping the others, by using the filters for the given template path (see below).

### Example

```php
// Override all the built-in templates.
add_filter( 'altis.consent.consent_banner_path', get_template_directory() . 'path/to/your/template.php' );

// Override an individual template.
add_filter( 'altis.consent.cookie_preferences_template_path', get_template_directory() . 'path/to/your/template.php' );
```

## Template files

### `consent-banner.php`

The main template file is [`tmpl/consent-banner.php`](https://github.com/humanmade/altis-consent/blob/master/tmpl/consent-banner.php). This file path can be customized with the [`altis.consent.consent_banner_path` filter](/Filter-Reference#altisconsentconsent_banner_path) and is loaded with the [load_consent_banner](/Function-Reference#load_consent_banner) function.

This template loads the [`consent-updated`](#consent-updatedphp), [`cookie-preferences`](#cookie-preferencesphp) (if applicable), and [`button-row`](#button-rowphp) templates.

### `consent-updated.php`

This template displays the "preferences updated" messaging which can be filtered independently with the [`altis.consent.preferences_updated_message` filter](/Filter-Reference#altisconsentpreferences_updated_message). It is located at [`tmpl/consent-updated.php`](https://github.com/humanmade/altis-consent/blob/master/tmpl/consent-updated.php) but the template can be overridden with the [`altis.consent.consent_updated_template_path` filter](/Filter-Reference#altisconsentconsent_updated_template_path).

### `cookie-preferences.php`

This template pulls in the cookie consent categories from `WP_CONSENT_API::$config`, loops through them, and displays options for users to customize the types of cookie tracking they would like to allow. It uses the [`altis.consent.apply_cookie_preferences_button_text` filter](/Filter-Reference#altisconsentapply_cookie_preferences_button_text) for the "apply changes" button.

The built-in CSS is designed to display the cookie preferences panel when the cookie preferences button is clicked. When the panel is displayed, the "allow only functional cookies" and "allow all cookies" buttons are hidden in favor of the more granular controls the preferences panel offers.

The template is located at [`tmpl/cookie-preferences.php`](https://github.com/humanmade/altis-consent/blob/master/tmpl/cookie-preferences.php) /Filter-Reference#altisconsentcookie_preferences_template_path).

## `button-row.php`

This template pulls in the banner message from the options saved on the Altis Privacy page (or displays the [default banner message](/AFunction-Reference#settingsget_default_banner_message)), loads the [`cookie-consent-policy.php`](#cookie-consent-policyphp) template, and displays buttons to "accept all cookies" or "accept only functional cookies". If more granular controls are set in the admin to allow users to select which categories of cookies they want to accept, it will also display a "cookie preferences" button.

The template is located at [`tmpl/button-row.php`](https://github.com/humanmade/altis-consent/blob/master/tmpl/button-row.php) but the template can be overridden with the [`altis.consent.button_row_template_path` filter](/Filter-Reference#altisconsentbutton_row_template_path).

## `cookie-consent-policy.php`

This template displays a link to the cookie consent policy. The link is generated by pulling the saved option from the Altis Privacy page. If no cookie policy page has been defined, the template isn't loaded in `button-row.php`. The link text is filterable using the [`altis.consent.cookie_consent_policy_link_text` filter](/Filter-Reference#altisconsentcookie_consent_policy_link_text).

The template is located at [`tmpl/cookie-consent-policy.php`](https://github.com/humanmade/altis-consent/blob/master/tmpl/cookie-consent-policy.php), but the template can be overridden with the [`altis.consent.cookie_consent_policy_template_path` filter](/Filter-Reference#altisconsentcookie_consent_policy_template_path).