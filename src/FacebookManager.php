<?php

declare(strict_types=1);

/*
 * This file is part of Laravel Facebook.
 *
 * (c) Brian Faust <hello@basecode.sh>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Artisanry\Facebook;

use Illuminate\Http\Request;
use League\OAuth2\Client\Grant\RefreshToken;
use League\OAuth2\Client\Provider\Facebook;

class FacebookManager
{
    /**
     * @var
     */
    private $session;

    /**
     * @var
     */
    private $provider;

    /**
     * @var array
     */
    private $config = ['graphApiVersion' => 'v2.5'];

    /**
     * @var
     */
    public $accessToken;

    /**
     * @var
     */
    public $refreshToken;

    /**
     * FacebookManager constructor.
     *
     * @param $session
     */
    public function __construct($session)
    {
        $this->session = $session;
    }

    /**
     * @param array $config
     *
     * @return $this
     */
    public function create(array $config)
    {
        $config = array_merge($config, $this->config);

        $this->provider = new Facebook($config);

        return $this;
    }

    /**
     * @param Request $request
     * @param array   $options
     *
     * @throws Exceptions\InvalidStateException
     *
     * @return bool
     */
    public function authorize(Request $request, array $options = [])
    {
        // check for errors before we proceed
        if ($request->has('error')) {
            $this->session->forget('oauth2state');

            throw new Exceptions\InvalidStateException(
                $request->get('error_description'), $request->get('error_code')
            );
        }

        // generate a new authorization url if no code is given
        if (!$request->has('code')) {
            $url = $this->provider->getAuthorizationUrl($options);

            $this->session->set('oauth2state', $this->provider->getState());

            return $url;
        }

        // check given state against previously stored one to mitigate CSRF attack
        $invalidState = ($request->get('state') !== $this->session->get('oauth2state'));

        if (!$request->has('state') || $invalidState) {
            $this->session->forget('oauth2state');

            $request = new Request($request->except('code'));

            return $this->authorize($request, $options);
        }

        // create access token now that all is fine
        $this->accessToken = $this->getAccessToken($request->get('code'));

        return true;
    }

    /**
     * @param $code
     *
     * @return mixed
     */
    private function getAccessToken($code)
    {
        if ($this->refreshToken) {
            return $this->provider->getAccessToken(new RefreshToken(), [
                'refresh_token' => $this->refreshToken,
            ]);
        }

        return $this->provider->getAccessToken('authorization_code', compact('code'));
    }

    /**
     * @param null $accessToken
     *
     * @return mixed
     */
    public function getLongLivedAccessToken($accessToken = null)
    {
        $accessToken = empty($accessToken) ? $this->accessToken : $accessToken;

        $this->accessToken = $this->provider->getLongLivedAccessToken($accessToken);

        return $this->accessToken;
    }

    /**
     * @return mixed
     */
    public function getUser($accessToken = null)
    {
        $accessToken = empty($accessToken) ? $this->accessToken : $accessToken;

        return $this->provider->getResourceOwner($accessToken);
    }

    /**
     * @param $refreshToken
     */
    public function refreshToken($refreshToken)
    {
        $this->refreshToken = $refreshToken;
    }
}
