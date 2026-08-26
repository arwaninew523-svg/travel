export type UserRole = 'admin' | 'operator' | 'user';

export type AdminUser = {
    id: number;
    name: string;
    email: string;
    role: UserRole;
    can_view: boolean;
    can_create: boolean;
    can_edit: boolean;
    can_delete: boolean;
    created_at: string;
};

export type AdminRoleOption = {
    value: UserRole;
    label: string;
};

export type AdminStats = {
    totalUsers: number;
    admins: number;
    operators: number;
    regularUsers: number;
};
