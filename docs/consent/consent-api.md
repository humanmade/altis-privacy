# Consent API

The Consent API is a developer API to read and register consent categories, to allow consent management and other plugins to work together, improving compliance.

## How does it work?

The Consent API adds two new concepts: a `consent_type` and a consent `category`. Categories are used to group user data by its intended usage, e.g. `marketing`. `consent_type` defines whether consent is `optin`, `optout` or some other type defined in the code.

The default consent type can be set in the code. The Altis Consent module defaults the consent type to `optin`, except for the `functional` and `statistics-anonymous` categories. This tells you that user data stored locally should only be used if a user explicitly _allows_ access. If the default `consent_type` is set to `optout`, user data will be assumed to be okay to use unless a user explicitly _disallows_ access.

The default categories `functional` and `statistics-anonymous` that are allowed by default can be modified using the `altis.consent.always_allow_categories` filter. The example below will make only the `functional` category allowed by default:

```php
add_filter( 'altis.consent.always_allow_categories', function () {
    return [ 'functional' ];
} );
```

Other consent types can be defined within the code.

### Consent categories

The Consent API defines five consent categories by default:

* **statistics**

Cookies or any other form of local storage that are used exclusively for statistical purposes (Analytics Cookies).

* **statistics-anonymous**

Cookies or any other form of local storage that are used exclusively for anonymous statistical purposes (Anonymous Analytics Cookies), that are placed on a first party domain, and that do not allow identification of particular individuals.

* **marketing**

Cookies or any other form of local storage required to create user profiles to send advertising or to track the user on a website or across websites for similar marketing purposes.

* **functional**

Functional cookies or any other form of local storage are any kind of user data that is required for the proper functionality of a site that cannot be disabled without affecting a user's ability to navigate the site. An example is the cookies that WordPress stores to handle user sign-ins for administrators -- if these cookies were blocked, an administrator would not be able to use the site.  In these cases, the technical storage or access is strictly necessary for the legitimate purpose of enabling the use of a specific service explicitly requested by the subscriber or user.

* **preferences**

Cookies or any other form of local storage that can not be seen as statistics, statistics-anonymous, marketing or functional, and where the technical storage or access is necessary for the legitimate purpose of storing preferences.

Additional consent categories can be defined within a site's code.
