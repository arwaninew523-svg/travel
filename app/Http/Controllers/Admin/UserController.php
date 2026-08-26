<?php

namespace App\Http\Controllers\Admin;

use App\Actions\Teams\CreateTeam;
use App\Enums\UserRole;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class UserController extends Controller
{
    public function __construct(private CreateTeam $createTeam)
    {
        //
    }

    /**
     * Show the list of users.
     */
    public function index(Request $request): Response
    {
        $this->ensurePermission($request, 'view');

        return Inertia::render('admin/users/Index', [
            'users' => User::query()
                ->orderByDesc('created_at')
                ->get(['id', 'name', 'email', 'role', 'can_view', 'can_create', 'can_edit', 'can_delete', 'created_at']),
        ]);
    }

    /**
     * Show the form for creating a new user.
     */
    public function create(Request $request): Response
    {
        $this->ensurePermission($request, 'create');

        return Inertia::render('admin/users/Create', [
            'roles' => UserRole::assignable(),
        ]);
    }

    /**
     * Store a newly created user.
     */
    public function store(StoreUserRequest $request): RedirectResponse
    {
        $this->ensurePermission($request, 'create');

        $user = DB::transaction(function () use ($request) {
            $user = User::create($request->validUserData());

            $this->createTeam->handle($user, $user->name."'s Team", isPersonal: true);

            return $user;
        });

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Pengguna ":name" berhasil ditambahkan.', ['name' => $user->name])]);

        return to_route('admin.users.index');
    }

    /**
     * Show the form for editing the given user.
     */
    public function edit(Request $request, User $user): Response
    {
        $this->ensurePermission($request, 'edit');

        return Inertia::render('admin/users/Edit', [
            'user' => $user->only(['id', 'name', 'email', 'role', 'can_view', 'can_create', 'can_edit', 'can_delete']),
            'roles' => UserRole::assignable(),
        ]);
    }

    /**
     * Update the given user.
     */
    public function update(UpdateUserRequest $request, User $user): RedirectResponse
    {
        $this->ensurePermission($request, 'edit');

        $user->fill($request->validUserData());
        $user->save();

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Pengguna ":name" berhasil diperbarui.', ['name' => $user->name])]);

        return to_route('admin.users.index');
    }

    /**
     * Delete the given user.
     */
    public function destroy(Request $request, User $user): RedirectResponse
    {
        $this->ensurePermission($request, 'delete');

        abort_if($user->is($request->user()), 403, __('Anda tidak dapat menghapus akun sendiri.'));

        $user->delete();

        Inertia::flash('toast', ['type' => 'success', 'message' => __('Pengguna ":name" berhasil dihapus.', ['name' => $user->name])]);

        return to_route('admin.users.index');
    }

    /**
     * Abort the request if the authenticated user lacks the given permission.
     */
    private function ensurePermission(Request $request, string $permission): void
    {
        abort_unless($request->user()?->hasPermission($permission), 403);
    }
}
