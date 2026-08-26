<?php

use App\Enums\UserRole;
use App\Models\User;

test('roles are labelled correctly', function () {
    expect(UserRole::Admin->label())->toBe('Admin')
        ->and(UserRole::Operator->label())->toBe('Operator')
        ->and(UserRole::User->label())->toBe('User');
});

test('only the admin role has full access', function () {
    expect(UserRole::Admin->isFullAccess())->toBeTrue()
        ->and(UserRole::Operator->isFullAccess())->toBeFalse()
        ->and(UserRole::User->isFullAccess())->toBeFalse();
});

test('assignable roles contain all roles', function () {
    $assignable = collect(UserRole::assignable());

    expect($assignable->pluck('value')->all())->toBe(['admin', 'operator', 'user'])
        ->and($assignable->first()['label'])->toBe('Admin');
});

test('users report the correct admin helpers', function () {
    $admin = User::factory()->create(['role' => UserRole::Admin]);
    $operator = User::factory()->create(['role' => UserRole::Operator]);
    $user = User::factory()->create();

    expect($admin->isAdmin())->toBeTrue()
        ->and($admin->isAdminOrOperator())->toBeTrue()
        ->and($operator->isAdmin())->toBeFalse()
        ->and($operator->isAdminOrOperator())->toBeTrue()
        ->and($user->isAdminOrOperator())->toBeFalse();
});

test('permission helpers respect the stored flags', function () {
    $operator = User::factory()->create([
        'role' => UserRole::Operator,
        'can_view' => true,
        'can_create' => false,
        'can_edit' => false,
        'can_delete' => false,
    ]);

    expect($operator->hasViewPermission())->toBeTrue()
        ->and($operator->hasCreatePermission())->toBeFalse()
        ->and($operator->hasEditPermission())->toBeFalse()
        ->and($operator->hasDeletePermission())->toBeFalse();
});
