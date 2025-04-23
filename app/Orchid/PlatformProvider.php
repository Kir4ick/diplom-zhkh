<?php

declare(strict_types=1);

namespace App\Orchid;

use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;
use Orchid\Screen\Actions\Menu;

class PlatformProvider extends OrchidServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @param Dashboard $dashboard
     *
     * @return void
     */
    public function boot(Dashboard $dashboard): void
    {
        parent::boot($dashboard);
    }

    /**
     * Register the application menu.
     *
     * @return Menu[]
     */
    public function menu(): array
    {
        return [
            Menu::make('Адреса компании')
                ->icon('bs.card-text')
                ->route('platform.address'),

            Menu::make('Клиенты')
                ->icon('bs.card-text')
                ->route('platform.customer'),

            Menu::make('Обратная связь')
                ->icon('bs.card-text')
                ->route('platform.feedback'),

            Menu::make('Обращения')
                ->icon('bs.card-text')
                ->route('platform.requests'),

            Menu::make('Объявления')
                ->icon('bs.card-text')
                ->route('platform.notifications')
                ->divider(),

            Menu::make(__('Users'))
                ->icon('bs.people')
                ->route('platform.systems.users')
                ->title(__('Управление доступами')),
        ];
    }

    /**
     * Register permissions for the application.
     *
     * @return ItemPermission[]
     */
    public function permissions(): array
    {
        return [

        ];
    }
}
