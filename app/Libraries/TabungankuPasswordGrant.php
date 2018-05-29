<?php

namespace App\Libraries;

use Illuminate\Http\Request;
use Laravel\Passport\Bridge\User;
use League\OAuth2\Server\Entities\UserEntityInterface;
use League\OAuth2\Server\Exception\OAuthServerException;
use League\OAuth2\Server\Grant\AbstractGrant;
use League\OAuth2\Server\Repositories\RefreshTokenRepositoryInterface;
use League\OAuth2\Server\Repositories\UserRepositoryInterface;
use League\OAuth2\Server\RequestEvent;
use League\OAuth2\Server\ResponseTypes\ResponseTypeInterface;
use Psr\Http\Message\ServerRequestInterface;
use App\Http\Controller\Response;
use App\Libraries\LoginMessage;


class TabungankuPasswordGrant extends AbstractGrant
{
    /**
     * @param UserRepositoryInterface         $userRepository
     * @param RefreshTokenRepositoryInterface $refreshTokenRepository
     */
    public function __construct(
        UserRepositoryInterface $userRepository,
        RefreshTokenRepositoryInterface $refreshTokenRepository
    )
    {
        $this->setUserRepository($userRepository);
        $this->setRefreshTokenRepository($refreshTokenRepository);
        $this->refreshTokenTTL = new \DateInterval('P1M');
    }

    /**
     * {@inheritdoc}
     */
    public function respondToAccessTokenRequest(
        ServerRequestInterface $request,
        ResponseTypeInterface $responseType,
        \DateInterval $accessTokenTTL
    )
    {
        // Validate request
        $client = $this->validateClient($request);
        $scopes = $this->validateScopes($this->getRequestParameter('scope', $request));
        $user = $this->validateUser($request);

        // Finalize the requested scopes
        $scopes = $this->scopeRepository->finalizeScopes($scopes, $this->getIdentifier(), $client, $user->getIdentifier());

        // Issue and persist new tokens
        $accessToken = $this->issueAccessToken($accessTokenTTL, $client, $user->getIdentifier(), $scopes);
        $refreshToken = $this->issueRefreshToken($accessToken);

        // Inject tokens into response
        $responseType->setAccessToken($accessToken);
        $responseType->setRefreshToken($refreshToken);

        return $responseType;
    }

    /**
     * {@inheritdoc}
     */
    public function getIdentifier()
    {
        return 'tabunganku_password';
    }

    /**
     * @param ServerRequestInterface $request
     *
     * @return UserEntityInterface
     * @throws OAuthServerException
     */
    protected function validateUser(ServerRequestInterface $request)
    {
        if (is_null($model = config('auth.providers.users.model'))) {
            throw OAuthServerException::serverError('Unable to determine user model from configuration.');
        }

        $laravelRequest = new Request($request->getParsedBody());

        if (! $laravelRequest->username)
            throw OAuthServerException::invalidRequest('username');

        if (! $laravelRequest->password)
            throw OAuthServerException::invalidRequest('password');

        $client = (new $model)->whereRaw('lower(email) = ?', [strtolower($laravelRequest->username)])
            ->select('id', 'email', 'name', 'password', 'user_active', 'user_salt')
            ->first();
        $user = null;

        if ($client) {
            $status = $client->user_active;
            if($status == 0){
                throw LoginMessage::Message_Error_0();
                exit;
            }
            $dbPass = $client->password;
            $dbSalt = $client->user_salt;
            $staticSalt = env('STATIC_SALT');

            $phash = new PasswordHash(8, false);
            $checkPass = $phash->checkPassword($dbSalt.$laravelRequest->password.$staticSalt, $dbPass);

            if ($checkPass)
                $user = new User($client->id);
        }

        if ($user instanceof UserEntityInterface === false) {
            $this->getEmitter()->emit(new RequestEvent(RequestEvent::USER_AUTHENTICATION_FAILED, $request));
            throw LoginMessage::Message_Error_1();
        }

        return $user;
    }
}
