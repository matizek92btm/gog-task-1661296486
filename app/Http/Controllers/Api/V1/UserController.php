<?php

namespace App\Http\Controllers\Api\V1;

use App\Enums\TokenType;
use App\Http\Requests\LoginRequest;
use App\JsonApi\Error;
use App\Services\Contracts\AuthorizationServiceInterface;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use LaravelJsonApi\Core\Responses\DataResponse;

class UserController extends Controller
{
    public function __construct(private AuthorizationServiceInterface $authorizationService)
    {
    }

    public function login(LoginRequest $request): DataResponse|Error
    {
        $validated = $request->validated();
        $email = $validated['data']['attributes']['email'];
        $password = $validated['data']['attributes']['password'];
        $user = $this->authorizationService->getAccess($email, $password);

        if (! $user) {
            return Error::fromStatus(Response::HTTP_UNAUTHORIZED, trans('user.not_logged'));
        }

        $accessToken = $user->createToken($email);

        return DataResponse::make($user)
            ->withMeta(['accessToken' => [
                'token' => $accessToken->plainTextToken,
                'type' => TokenType::BEARER->value, ],
            ]);
    }

    public function logout(Request $request): Response
    {
        if ($user = $request->user()) {
            optional($user->currentAccessToken())->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
