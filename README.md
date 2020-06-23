Apple ID login provider for Social
=======================

This plugin provides a [Sign in with Apple](https://support.apple.com/en-us/HT210318) integration for [Social 2 for Craft CMS](https://github.com/dukt/social).


## Requirements

This plugin requires Social 2.0.0-beta.1 or later.


## Installation

To install the plugin, follow these instructions.

1. Open your terminal and go to your Craft project:

        cd /path/to/project

2. Then tell Composer to load the plugin:

        composer require meerkats/social-apple

3. In the Control Panel, go to Settings → Plugins and click the “Install” button for Apple.

## Setup

To enable the Apple login provider, go to Social → Settings → Login Providers, and configure the Apple login provider.

Set up your social:

'redirectUri'       => 'http://ohapple.lol:3080/index.php?p=actions/social-apple/callback',
```php
return array(
  'loginProviders' => [
    'apple' => [
      'userFieldMapping' => [
        'firstName' => '{{ profile.getFirstName }}',
        'lastName' => '{{ profile.getLastName }}',
        'dateOfBirth' => '{{ profile.toArray().birthday }}',
      ],
      'profileFields' => [
        'birthday', 'hometown'
      ],
      'oauth' => [
        'options' => [
          'clientId'          => 'com.yourdomain.client',  // Identifier within apple console
          'teamId'            => 'XXXXXXXXXX', // https://developer.apple.com/account/#/membership/ (Team ID)
          'keyFileId'         => 'YYYYYYYYYY', // https://developer.apple.com/account/resources/authkeys/list (Key ID)
          'keyFilePath'       => __DIR__ . '/AuthKey_FTDHQN7YDL.p8', // __DIR__ . '/AuthKey_1ABC6523AA.p8' -> Download key
          'redirectUri'       => 'http://yoursite.com/index.php?p=actions/social-apple/callback', // Note - can't use localhost, so set up an alias for dev.
        ],
      ],
    ]
  ]
);
```
