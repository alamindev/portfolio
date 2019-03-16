<?php
use App\Model\Admin\Admin;
use App\Model\Admin\Role;
use App\Model\Admin\Permission;

// Home
Breadcrumbs::register('dashboard', function ($breadcrumbs) {
    $breadcrumbs->push('Dashboard', route('dashboard'));
});

// for Admins
Breadcrumbs::register('admins.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('All-admins', route('admins.index'));
});
Breadcrumbs::register('admins.create', function ($breadcrumbs) {
    $breadcrumbs->parent('admins.index');
    $breadcrumbs->push('Create-new-user', route('admins.create'));
});
Breadcrumbs::register('admins.show', function ($breadcrumbs, $id) {
    $user = Admin::findOrFail($id);
    $breadcrumbs->parent('admins.index');
    $breadcrumbs->push("view" . '-' . $user->user_name, route('admins.show', $user->id));
});
Breadcrumbs::register('admins.edit', function ($breadcrumbs, $id) {
    $user = Admin::findOrFail($id);
    $breadcrumbs->parent('admins.index');
    $breadcrumbs->push("edit" . '-' . $user->user_name, route('admins.edit', $user->id));
});

// for role
Breadcrumbs::register('roles.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('All-roles', route('roles.index'));
});
Breadcrumbs::register('roles.create', function ($breadcrumbs) {
    $breadcrumbs->parent('roles.index');
    $breadcrumbs->push('Create-new-user', route('roles.create'));
});
Breadcrumbs::register('roles.show', function ($breadcrumbs, $id) {
    $role = Role::findOrFail($id);
    $breadcrumbs->parent('roles.index');
    $breadcrumbs->push("view" . '-' . $role->name, route('roles.show', $role->id));
});
Breadcrumbs::register('roles.edit', function ($breadcrumbs, $id) {
    $role = Role::findOrFail($id);
    $breadcrumbs->parent('roles.index');
    $breadcrumbs->push("edit" . '-' . $role->name, route('roles.edit', $role->id));
});

// for Permission
Breadcrumbs::register('permissions.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('All-permissions', route('permissions.index'));
});
Breadcrumbs::register('permissions.create', function ($breadcrumbs) {
    $breadcrumbs->parent('permissions.index');
    $breadcrumbs->push('Create-new-user', route('permissions.create'));
});
Breadcrumbs::register('permissions.show', function ($breadcrumbs, $id) {
    $permissions = Permission::findOrFail($id);
    $breadcrumbs->parent('permissions.index');
    $breadcrumbs->push("view" . '-' . $permissions->name, route('permissions.show', $permissions->id));
});
Breadcrumbs::register('permissions.edit', function ($breadcrumbs, $id) {
    $permissions = Permission::findOrFail($id);
    $breadcrumbs->parent('permissions.index');
    $breadcrumbs->push("edit" . '-' . $permissions->name, route('permissions.edit', $permissions->id));
});

// for generals
// for website general setting
Breadcrumbs::register('generals.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('add-generals-information', route('generals.index'));
});
  
  Breadcrumbs::register('generals.edit', function ($breadcrumbs, $id) {
      $general = General::find($id);
      $breadcrumbs->parent('generals.index');
      $breadcrumbs->push("update-generals-information", route('generals.edit', $general->id));
  });
//start coding for portfolio index
Breadcrumbs::register('portfolios.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('all portfolio', route('portfolios.index'));
});
// for portfolio details
Breadcrumbs::register('sub_portfolios.index', function ($breadcrumbs) {
    $breadcrumbs->parent('dashboard');
    $breadcrumbs->push('All-sub_portfolios', route('sub_portfolios.index'));
});
Breadcrumbs::register('sub_portfolios.create', function ($breadcrumbs) {
    $breadcrumbs->parent('sub_portfolios.index');
    $breadcrumbs->push('Create-new-user', route('sub_portfolios.create'));
});
Breadcrumbs::register('sub_portfolios.show', function ($breadcrumbs, $id) {
    $sub_portfolios = Permission::findOrFail($id);
    $breadcrumbs->parent('sub_portfolios.index');
    $breadcrumbs->push("view" . '-' . $sub_portfolios->name, route('sub_portfolios.show', $sub_portfolios->id));
});
Breadcrumbs::register('sub_portfolios.edit', function ($breadcrumbs, $id) {
    $sub_portfolios = Permission::findOrFail($id);
    $breadcrumbs->parent('sub_portfolios.index');
    $breadcrumbs->push("edit" . '-' . $sub_portfolios->name, route('sub_portfolios.edit', $sub_portfolios->id));
});
