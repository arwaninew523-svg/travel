<?php

use App\Enums\UserRole;
use App\Models\User;
use Inertia\Testing\AssertableInertia as Assert;

test('guests are redirected to the login page when visiting the user list', function () {
    $this->get(route('admin.users.index'))->assertRedirect(route('login'));
});

test('regular users cannot access the user management area', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('admin.users.index'))
        ->assertForbidden();
});

test('admin users can view the user list', function () {
    $admin = User::factory()->create(['role' => UserRole::Admin]);
    $regular = User::factory()->create(['name' => 'Regular User']);

    $this->actingAs($admin)
        ->get(route('admin.users.index'))
        ->assertOk()
        ->assertInertia(fn (Assert $page) => $page
            ->component('admin/users/Index')
            ->has('users', 2));

    $this->assertDatabaseHas('users', ['name' => 'Regular User']);
});

test('operators without view permission cannot view the user list', function () {
    $operator = User::factory()->create(['role' => UserRole::Operator, 'can_view' => false]);

    $this->actingAs($operator)
        ->get(route('admin.users.index'))
        ->assertForbidden();
});

test('operators with view permission can view the user list', function () {
    $operator = User::factory()->create(['role' => UserRole::Operator, 'can_view' => true]);

    $this->actingAs($operator)
        ->get(route('admin.users.index'))
        ->assertOk();
});

test('admin users can create a new user', function () {
    $admin = User::factory()->create(['role' => UserRole::Admin]);

    $this->actingAs($admin)
        ->post(route('admin.users.store'), [
            'name' => 'New User',
            'email' => 'new-user@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => UserRole::User->value,
            'can_view' => true,
            'can_create' => false,
            'can_edit' => false,
            'can_delete' => false,
        ])
        ->assertRedirect(route('admin.users.index'));

    $user = User::where('email', 'new-user@example.com')->first();

    expect($user)->not->toBeNull()
        ->and($user->role)->toBe(UserRole::User)
        ->and($user->can_create)->toBeFalse();

    $this->assertDatabaseHas('teams', [
        'name' => "New User's Team",
        'is_personal' => true,
    ]);

    expect($user->currentTeam->name)->toBe("New User's Team");
});

test('users created with the admin role always receive full permissions', function () {
    $admin = User::factory()->create(['role' => UserRole::Admin]);

    $this->actingAs($admin)
        ->post(route('admin.users.store'), [
            'name' => 'Second Admin',
            'email' => 'second-admin@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => UserRole::Admin->value,
            'can_view' => false,
            'can_create' => false,
            'can_edit' => false,
            'can_delete' => false,
        ])
        ->assertRedirect(route('admin.users.index'));

    $user = User::where('email', 'second-admin@example.com')->first();

    expect($user->can_view)->toBeTrue()
        ->and($user->can_create)->toBeTrue()
        ->and($user->can_edit)->toBeTrue()
        ->and($user->can_delete)->toBeTrue();
});

test('operators cannot create users without the create permission', function () {
    $operator = User::factory()->create(['role' => UserRole::Operator, 'can_create' => false]);

    $this->actingAs($operator)
        ->post(route('admin.users.store'), [
            'name' => 'New User',
            'email' => 'new-user@example.com',
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => UserRole::User->value,
        ])
        ->assertForbidden();

    $this->assertDatabaseMissing('users', ['email' => 'new-user@example.com']);
});

test('users cannot be created with a duplicate email', function () {
    $admin = User::factory()->create(['role' => UserRole::Admin]);
    $existing = User::factory()->create();

    $this->actingAs($admin)
        ->post(route('admin.users.store'), [
            'name' => 'Duplicate',
            'email' => $existing->email,
            'password' => 'password',
            'password_confirmation' => 'password',
            'role' => UserRole::User->value,
        ])
        ->assertSessionHasErrors('email');
});

test('admin users can edit an existing user', function () {
    $admin = User::factory()->create(['role' => UserRole::Admin]);
    $user = User::factory()->create();

    $this->actingAs($admin)
        ->patch(route('admin.users.update', $user), [
            'name' => 'Updated Name',
            'email' => $user->email,
            'role' => UserRole::User->value,
            'can_view' => true,
            'can_create' => true,
            'can_edit' => false,
            'can_delete' => false,
        ])
        ->assertRedirect(route('admin.users.index'));

    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'name' => 'Updated Name',
        'can_create' => true,
    ]);

    expect($user->fresh()->can_create)->toBeTrue();
});

test('operators without edit permission cannot update a user', function () {
    $operator = User::factory()->create(['role' => UserRole::Operator, 'can_edit' => false]);
    $user = User::factory()->create();

    $this->actingAs($operator)
        ->patch(route('admin.users.update', $user), [
            'name' => 'Hacked',
            'email' => $user->email,
            'role' => UserRole::User->value,
        ])
        ->assertForbidden();

    expect($user->fresh()->name)->not->toBe('Hacked');
});

test('admin users can delete another user', function () {
    $admin = User::factory()->create(['role' => UserRole::Admin]);
    $user = User::factory()->create();

    $this->actingAs($admin)
        ->delete(route('admin.users.destroy', $user))
        ->assertRedirect(route('admin.users.index'));

    $this->assertDatabaseMissing('users', ['id' => $user->id]);
});

test('users cannot delete themselves', function () {
    $admin = User::factory()->create(['role' => UserRole::Admin]);

    $this->actingAs($admin)
        ->delete(route('admin.users.destroy', $admin))
        ->assertForbidden();

    $this->assertDatabaseHas('users', ['id' => $admin->id]);
});

test('operators without delete permission cannot delete a user', function () {
    $operator = User::factory()->create(['role' => UserRole::Operator, 'can_delete' => false]);
    $user = User::factory()->create();

    $this->actingAs($operator)
        ->delete(route('admin.users.destroy', $user))
        ->assertForbidden();

    $this->assertDatabaseHas('users', ['id' => $user->id]);
});

test('admin users receive full permissions even if stored with restrictive flags', function () {
    $admin = User::factory()->create([
        'role' => UserRole::Admin,
        'can_view' => false,
        'can_create' => false,
        'can_edit' => false,
        'can_delete' => false,
    ]);

    expect($admin->can_view)->toBeTrue()
        ->and($admin->can_create)->toBeTrue()
        ->and($admin->can_edit)->toBeTrue()
        ->and($admin->can_delete)->toBeTrue();
});
