<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Laravel\Fortify\Fortify;
use Symfony\Component\HttpFoundation\Response;

class LoginResponse implements LoginResponseContract
{
    public function toResponse($request): Response
    {
        Log::info('LoginResponse', [
            'wantsJson' => $request->wantsJson(),
            'isInertia' => $request->header('X-Inertia'),
            'accept' => $request->header('Accept'),
            'home' => config('fortify.home'),
        ]);

        if ($request->wantsJson()) {
            return new JsonResponse(['two_factor' => false], 200);
        }

        return Inertia::location(config('fortify.home'));
    }
}
