# Altis Consent

The Altis Consent API provides a website administrator (you) with a centralized and consistent way of obtaining data privacy consent
from your website's visitors. Data privacy consent refers to how user data is tracked, collected, or stored on a website.

## Web Cookies

A website uses cookies to track user behaviour on the website. Cookies can be thought of as belonging to one of two broad types:
first-party cookies, set by the server or code on the domain itself, and third-party cookies served by scripts included from other
domains or services (such as Google Analytics). Depending on their function, these cookies can further be categorized into
functional or operational cookies, marketing or personalization cookies, or cookies used for statistical data. While functional
cookies are necessary for a smooth user experience, other cookies, such as marketing cookies that track user preferences, are not
essential for a website's performance. General Data Protection Regulation (GDPR) governs user data privacy and protection and
stipulates that businesses require appropriate consent from website visitors before they are served any such cookies.

We created this framework to help you readily obtain consent from your website users for various cookies that will be served on your
website. With the features available in the API, a website's visitor will be able to control the _types_ of data or cookies that can
be stored and shared if you choose to offer that level of control.

## Why should I use it?

To keep up with the GDPR regulations and your company's privacy and cookie policies. GDPR regulations mandate that businesses need
user consent before they can collect or track any visitor data. This tool helps you create a cookie consent banner out of the box.
With the banner options, a user can choose to select the cookies (data) that can be collected by the website. The framework lets you
manage first party and third party cookies.

## How does it work?

Altis Consent is an API that is designed to help you manage when to load scripts that set cookies and other types of data stored
locally on a user's computer. It allows you to subscribe to changes in a user's consent and use those events to trigger Google Tag
Manager tags, or to lazily load other JavaScript that sets cookies.

## What does it do?

Out of the box, the Consent API supports [Altis Analytics](docs://analytics/native/README.md)
and [Google Tag Manager](docs://analytics/google-tag-manager/README.md). Using the controls provided on the Privacy page in the WP
admin you can link your website's Privacy Policy and Cookie storage Policy page.

There are options to control whether to grant the user a choice to select the types of cookies they want to consent to, or an option
to allow all cookies or only functional cookies. You may also easily add a cookie consent banner message in the admin settings.

In addition, a robust templating system and dozens of filters allow development teams to fully customize the options or the display
of the banner, or only customize certain specific elements, based on a site's needs.

## What about third-party cookies?

The API allows management of third party cookies if it is configured so. See the [JavaScript Reference](./javascript-reference.md)
to see how this can be done.

## Can I manage user data tracked through Altis' personalization features?

Altis' personalization features track user data using first-party cookies and are supported by default.

## Does the API help categorize the type of cookies?

Altis does not do any automatic categorisation of your cookies. It provides the means for users to control their consent and for you
to respond to changes in that consent. Determining which scripts fall into which category needs to be manually determined and can
vary by geographic location.

Out of the box, [five categories](./consent-api.md#consent-categories) are
provided: `functional`, `marketing`, `statistics`, `statistics-anonymous` and `preferences`. More categories can
be [added via a filter](./filter-reference.md#altisconsentcategories).

**Note:** `functional` and `statistics-anonymous` categories are always allowed by default. This can be modified using
the [`altis.consent.always_allow_categories` filter](./filter-reference.md#altisconsentalways_allow_categories).

## Configuration

Altis Consent is active by default. However, if your project is already using an alternative consent system and you would like to
disable Altis Consent, this can be done in the project's `composer.json` file:

```json
{
    "extra": {
        "altis": {
            "modules": {
                "privacy": {
                    "consent": false
                }
            }
        }
    }
}
```

Alternatively, you can use the [`altis.consent.should_display_banner`](./filter-reference.md#altisconsentshould_display_banner)
filter or the [admin "Display Cookie Consent Banner" setting](./privacy-settings-page.md#Dispay-Cookie-Consent-Banner) to disable
the banner. Note that neither of these two options will completely disable the Consent API itself, and all associated JavaScript
will still load on the page.
