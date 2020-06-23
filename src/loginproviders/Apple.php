<?php

namespace meerkats\social\apple\loginproviders;

use Craft;
use dukt\social\base\LoginProvider;

/**
 * Apple represents the Apple gateway
 *
 * @author    Dukt <support@dukt.net>
 * @since     1.0
 */
class Apple extends LoginProvider
{
    // Public Methods
    // =========================================================================

    /**
     * @inheritdoc
     */
    public function getName(): string
    {
        return 'Apple';
    }

    /**
     * @inheritdoc
     */
    public function getIconUrl()
    {
        return Craft::$app->assetManager->getPublishedUrl('@meerkats/social/apple/icon.svg', true);
    }

    /**
     * @inheritdoc
     */
    public function getDefaultOauthScope(): array
    {
        return [
            'name',
            'email'
        ];
    }

    /**
     * @inheritdoc
     */
    public function getManagerUrl()
    {
        return 'https://developer.apple.com/account/resources';
    }

    /**
     * @inheritdoc
     */
    public function getOauthProvider(): \League\OAuth2\Client\Provider\Apple
    {
        $config = $this->getOauthProviderConfig();

        return new \League\OAuth2\Client\Provider\Apple($config['options']);
    }

    /**
     * @inheritdoc
     */
    public function getDefaultUserFieldMapping(): array
    {
        return [
            'id' => '{{ profile.getId() }}',
            'email' => '{{ profile.getEmail() }}',
            'username' => '{{ profile.getEmail() }}',
            'photo' => '{{ profile.getImageUrl() }}',
        ];
    }
}
