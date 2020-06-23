<?php

/**
 * Social Apple plugin for Craft CMS 3.x
 *
 * test
 *
 * @link      https://www.meerkats.com.au
 * @copyright Copyright (c) 2020 marcus@meerkats.com.au
 */

namespace meerkats\social\apple\controllers;

// use meerkats\socialapple\SocialApple;

use Craft;
use craft\web\Controller;
use craft\web\Response;

/**
 * Default Controller
 *
 * Generally speaking, controllers are the middlemen between the front end of
 * the CP/website and your plugin’s services. They contain action methods which
 * handle individual tasks.
 *
 * A common pattern used throughout Craft involves a controller action gathering
 * post data, saving it on a model, passing the model off to a service, and then
 * responding to the request appropriately depending on the service method’s response.
 *
 * Action methods begin with the prefix “action”, followed by a description of what
 * the method does (for example, actionSaveIngredient()).
 *
 * https://craftcms.com/docs/plugins/controllers
 *
 * @author    marcus@meerkats.com.au
 * @package   SocialApple
 * @since     1.0.0.
 */
class SocialAppleController extends Controller
{

    // Protected Properties
    // =========================================================================

    /**
     * @var    bool|array Allows anonymous access to this controller's actions.
     *         The actions must be in 'kebab-case'
     * @access protected
     */
    protected $allowAnonymous = ['callback'];

    // Public Methods
    // =========================================================================

    /**
     * OAuth callback.
     *
     * @return Response
     * @throws \craft\errors\MissingComponentException
     */
    public function actionCallback(): Response
    {
        Craft::$app->getSession()->set('social.callback', true);

        $url = Craft::$app->getSession()->get('social.loginControllerUrl');

        if (strpos($url, '?') === false) {
            $url .= '?';
        } else {
            $url .= '&';
        }


        // Pass the existing string containing oauth data to the next redirect
        $queryParams = Craft::$app->getRequest()->getQueryParams();

        // Translate post parameters
        $queryParams = array_merge($queryParams, Craft::$app->getRequest()->post());

        if (isset($queryParams['p'])) {
            unset($queryParams['p']);
        }

        $url .= http_build_query($queryParams);

        error_log($url);

        return $this->redirect($url);
    }
}
