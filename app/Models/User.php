<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Concerns\HasTeams;
use App\Enums\UserRole;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Carbon;
use Laravel\Fortify\Contracts\PasskeyUser;
use Laravel\Fortify\PasskeyAuthenticatable;
use Laravel\Fortify\TwoFactorAuthenticatable;

/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property Carbon|null $two_factor_confirmed_at
 * @property string|null $remember_token
 * @property string $role
 * @property bool $can_view
 * @property bool $can_create
 * @property bool $can_edit
 * @property bool $can_delete
 * @property int|null $current_team_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Team|null $currentTeam
 * @property-read Collection<int, Team> $ownedTeams
 * @property-read Collection<int, Membership> $teamMemberships
 * @property-read Collection<int, Team> $teams
 */
#[Fillable(['name', 'email', 'password', 'role', 'can_view', 'can_create', 'can_edit', 'can_delete', 'current_team_id'])]
#[Hidden(['password', 'two_factor_secret', 'two_factor_recovery_codes', 'remember_token'])]
class User extends Authenticatable implements PasskeyUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, HasTeams, Notifiable, PasskeyAuthenticatable, TwoFactorAuthenticatable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'role' => UserRole::class,
            'can_view' => 'boolean',
            'can_create' => 'boolean',
            'can_edit' => 'boolean',
            'can_delete' => 'boolean',
            'two_factor_confirmed_at' => 'datetime',
        ];
    }

    /**
     * Determine whether the user has the admin role.
     */
    public function isAdmin(): bool
    {
        return $this->role === UserRole::Admin;
    }

    /**
     * Determine whether the user is an admin or an operator.
     */
    public function isAdminOrOperator(): bool
    {
        return in_array($this->role, [UserRole::Admin, UserRole::Operator], true);
    }

    /**
     * Determine whether the user has a given permission.
     * Admin users always have full access.
     */
    public function hasPermission(string $permission): bool
    {
        return match ($permission) {
            'view' => $this->can_view,
            'create' => $this->can_create,
            'edit' => $this->can_edit,
            'delete' => $this->can_delete,
            default => false,
        };
    }

    /**
     * Determine whether the user can view data.
     */
    public function hasViewPermission(): bool
    {
        return $this->hasPermission('view');
    }

    /**
     * Determine whether the user can create data.
     */
    public function hasCreatePermission(): bool
    {
        return $this->hasPermission('create');
    }

    /**
     * Determine whether the user can edit data.
     */
    public function hasEditPermission(): bool
    {
        return $this->hasPermission('edit');
    }

    /**
     * Determine whether the user can delete data.
     */
    public function hasDeletePermission(): bool
    {
        return $this->hasPermission('delete');
    }

    /**
     * Accessor that forces all permissions to true for admin users.
     */
    protected function canView(): Attribute
    {
        return Attribute::make(
            get: fn (?bool $value) => $this->isAdmin() || (bool) $value,
        );
    }

    protected function canCreate(): Attribute
    {
        return Attribute::make(
            get: fn (?bool $value) => $this->isAdmin() || (bool) $value,
        );
    }

    protected function canEdit(): Attribute
    {
        return Attribute::make(
            get: fn (?bool $value) => $this->isAdmin() || (bool) $value,
        );
    }

    protected function canDelete(): Attribute
    {
        return Attribute::make(
            get: fn (?bool $value) => $this->isAdmin() || (bool) $value,
        );
    }
}
