<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Laravel\Passport\Passport;
use Laravel\Passport\TokenRepository;

class DestroyAccessTokensController
{
    /**
     * The token repository implementation.
     *
     * @var TokenRepository
     */
    private TokenRepository $tokenRepository;

    /**
     * Create a new controller instance.
     *
     * @param TokenRepository $tokenRepository
     */
    public function __construct(TokenRepository $tokenRepository)
    {
        $this->tokenRepository = $tokenRepository;
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request): JsonResponse
    {
        $tokens = $this->tokenRepository->forUser($request->user()->getKey());

        Passport::token()::destroy($tokens);
        Passport::refreshToken()->whereIn('access_token_id', $tokens->modelKeys())->delete();

        return response()->json();
    }
}
