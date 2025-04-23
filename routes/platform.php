<?php

declare(strict_types=1);

use App\Orchid\Layouts\Feedbacks\FeedbacksListLayout;
use App\Orchid\Screens\Addresses\AddressesListScreen;
use App\Orchid\Screens\Addresses\AddressesEditScreen;
use App\Orchid\Screens\Customers\CustomersEditScreen;
use App\Orchid\Screens\Customers\CustomersListScreen;
use App\Orchid\Screens\Feedbacks\FeedbackListScreen;
use App\Orchid\Screens\Notification\NotificationCreateScreen;
use App\Orchid\Screens\Notification\NotificationListScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Профиль'), route('platform.profile')));

Route::screen('address', AddressesListScreen::class)
    ->name('platform.address')
    ->breadcrumbs(fn (Trail $trail) => $trail
    ->parent('platform.index')
        ->push(__('Адреса'), route('platform.address')));
Route::screen('address/create', AddressesEditScreen::class)
    ->name('platform.address.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Адреса'), route('platform.address')));
Route::screen('address/update/{addresses}', AddressesEditScreen::class)
    ->name('platform.address.update')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Адреса'), route('platform.address')));

Route::screen('customer-notifications', NotificationListScreen::class)
    ->name('platform.notifications')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Объявления'), route('platform.notifications')));
Route::screen('customer-notifications/create', NotificationCreateScreen::class)
    ->name('platform.notifications.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Объявления'), route('platform.notifications')));

Route::screen('customer', CustomersListScreen::class)
    ->name('platform.customer')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Клиенты'), route('platform.customer')));
Route::screen('customer/create', CustomersEditScreen::class)
    ->name('platform.customer.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Адреса'), route('platform.customer')));
Route::screen('customer/update/{customers}', CustomersEditScreen::class)
    ->name('platform.customer.update')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Адреса'), route('platform.customer')));

Route::screen('feedback', FeedbackListScreen::class)
    ->name('platform.feedback')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Клиенты'), route('platform.feedback')));

// Platform > System > Users > User
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(fn (Trail $trail, $user) => $trail
        ->parent('platform.systems.users')
        ->push($user->name, route('platform.systems.users.edit', $user)));

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.users')
        ->push(__('Create'), route('platform.systems.users.create')));

// Platform > System > Users
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Users'), route('platform.systems.users')));

// Platform > System > Roles > Role
Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(fn (Trail $trail, $role) => $trail
        ->parent('platform.systems.roles')
        ->push($role->name, route('platform.systems.roles.edit', $role)));

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.systems.roles')
        ->push(__('Create'), route('platform.systems.roles.create')));

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Roles'), route('platform.systems.roles')));

Route::screen('requests', \App\Orchid\Screens\RequestListScreen::class)
    ->name('platform.requests')
    ->breadcrumbs(fn (Trail $trail) => $trail
        ->parent('platform.index'));
