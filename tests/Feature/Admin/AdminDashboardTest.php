<?php

use App\Enums\UserRole;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

test('guests are redirected to the login page when visiting the admin dashboard', function () {
    $this->get(route('admin.dashboard'))->assertRedirect(route('login'));
});

test('regular users cannot access the admin dashboard', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('admin.dashboard'))
        ->assertForbidden();
});

test('admin users can access the admin dashboard', function () {
    $admin = User::factory()->create(['role' => UserRole::Admin]);

    $this->actingAs($admin)
        ->get(route('admin.dashboard'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('admin/Dashboard')
            ->has('stats', fn (Assert $stats) => $stats
                ->where('totalUsers', 1)
                ->where('admins', 1)
                ->where('operators', 0)
                ->where('regularUsers', 0))
            ->has('recentUsers', 1));
});

test('operator users can access the admin dashboard', function () {
    $operator = User::factory()->create(['role' => UserRole::Operator]);

    $this->actingAs($operator)
        ->get(route('admin.dashboard'))
        ->assertOk();
});

test('admin dashboard reports the correct user breakdown', function () {
    $admin = User::factory()->create(['role' => UserRole::Admin]);
    User::factory()->count(3)->create(['role' => UserRole::Operator]);
    User::factory()->count(5)->create();

    $this->actingAs($admin)
        ->get(route('admin.dashboard'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->where('stats.totalUsers', 9)
            ->where('stats.admins', 1)
            ->where('stats.operators', 3)
            ->where('stats.regularUsers', 5));
});
