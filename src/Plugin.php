<?php

namespace meerkats\social\apple;


use Craft;
use dukt\social\services\LoginProviders;
use yii\base\Event;


/**
 * Plugin represents the Login with Apple integration plugin.
 *
 * @author    Meerkats <techservices@meerkats.com.au>
 * @since     1.0
 */
class Plugin extends \craft\base\Plugin
{
    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        Event::on(LoginProviders::class, LoginProviders::EVENT_REGISTER_LOGIN_PROVIDER_TYPES, function ($event) {
            $loginProviderTypes = [
                'meerkats\social\apple\loginproviders\Apple'
            ];

            $event->loginProviderTypes = array_merge($event->loginProviderTypes, $loginProviderTypes);
        });
    }
}
