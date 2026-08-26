<?php

use App\Enums\UserRole;
use App\Http\Responses\LoginResponse;
use App\Http\Responses\PasskeyLoginResponse;
use App\Http\Responses\TwoFactorLoginResponse;
use App\Models\User;
use Illuminate\Http\Request;

test('admin users are redirected to the admin dashboard after login', function () {
    $admin = User::factory()->create(['role' => UserRole::Admin]);

    $request = Request::create(route('login', absolute: false), 'GET');
    $request->setLaravelSession($this->app['session.store']);
    $request->setUserResolver(fn () => $admin);

    $response = app(LoginResponse::class)->toResponse($request);

    expect($response->getTargetUrl())->toBe(route('admin.dashboard'));
});

test('operator users are redirected to the admin dashboard after login', function () {
    $operator = User::factory()->create(['role' => UserRole::Operator]);

    $request = Request::create(route('login', absolute: false), 'GET');
    $request->setLaravelSession($this->app['session.store']);
    $request->setUserResolver(fn () => $operator);

    $response = app(LoginResponse::class)->toResponse($request);

    expect($response->getTargetUrl())->toBe(route('admin.dashboard'));
});

test('regular users are redirected to the admin dashboard after login', function () {
    $user = User::factory()->create();

    $request = Request::create(route('login', absolute: false), 'GET');
    $request->setLaravelSession($this->app['session.store']);
    $request->setUserResolver(fn () => $user);

    $response = app(LoginResponse::class)->toResponse($request);

    expect($response->getTargetUrl())->toBe(route('admin.dashboard'));
});

test('admin users are redirected to the admin dashboard after two factor login', function () {
    $admin = User::factory()->create(['role' => UserRole::Admin]);

    $request = Request::create(route('login', absolute: false), 'GET');
    $request->setLaravelSession($this->app['session.store']);
    $request->setUserResolver(fn () => $admin);

    $response = app(TwoFactorLoginResponse::class)->toResponse($request);

    expect($response->getTargetUrl())->toBe(route('admin.dashboard'));
});

test('admin users are redirected to the admin dashboard after passkey login', function () {
    $admin = User::factory()->create(['role' => UserRole::Admin]);

    $request = Request::create(route('login', absolute: false), 'GET', server: [
        'HTTP_ACCEPT' => 'application/json',
    ]);
    $request->setLaravelSession($this->app['session.store']);
    $request->setUserResolver(fn () => $admin);

    $jsonResponse = app(PasskeyLoginResponse::class)->toResponse($request);

    expect($jsonResponse->getData()->redirect)->toBe(route('admin.dashboard'));
});

test('regular users are redirected to the admin dashboard after passkey login', function () {
    $user = User::factory()->create();

    $request = Request::create(route('login', absolute: false), 'GET', server: [
        'HTTP_ACCEPT' => 'application/json',
    ]);
    $request->setLaravelSession($this->app['session.store']);
    $request->setUserResolver(fn () => $user);

    $jsonResponse = app(PasskeyLoginResponse::class)->toResponse($request);

    expect($jsonResponse->getData()->redirect)->toBe(route('admin.dashboard'));
});
