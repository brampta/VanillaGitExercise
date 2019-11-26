<?php
namespace VanillaGit;

class OAuth
{

    const CLIENT_ID = '929d1886bca66188e275';

    const CLIENT_SECRET = '985563c0c91a17eb0785b5c25b4c4c39a6c1eded';

    public function getToken()
    {
        $provider = new \League\OAuth2\Client\Provider\Github([
            'clientId' => \VanillaGit\OAuth::CLIENT_ID,
            'clientSecret' => \VanillaGit\OAuth::CLIENT_SECRET,
            'redirectUri' => $this->getRedirectUri()
        ]);

        // the following comes from the example at https://packagist.org/packages/league/oauth2-github
        // to be improved!!
        if (! isset($_GET['code'])) {
            // If we don't have an authorization code then get one
            $options = [
                'state' => 'OPTIONAL_CUSTOM_CONFIGURED_STATE',
                'scope' => [
                    'user',
                    'user:email',
                    'repo'
                ] // array or string
            ];
            $authUrl = $provider->getAuthorizationUrl($options);
            $_SESSION['oauth2state'] = $provider->getState();
            header('Location: ' . $authUrl);
            exit();
            // Check given state against previously stored one to mitigate CSRF attack
        } elseif (empty($_GET['state']) || ($_GET['state'] !== $_SESSION['oauth2state'])) {
            unset($_SESSION['oauth2state']);
            exit('Invalid state');
        } else {

            // Try to get an access token (using the authorization code grant)
            $token = $provider->getAccessToken('authorization_code', [
                'code' => $_GET['code']
            ]);

            // Use this to interact with an API on the users behalf
            return $token->getToken();
        }
    }

    public function getRedirectUri()
    {
        return 'http://localhost' . $_SERVER['REQUEST_URI'];
    }
}