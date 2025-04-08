<?php

namespace App\Orchid\Screens\Notification;

use App\Models\CustomerNotification;
use App\Orchid\Layouts\Notification\NotificationListLayout;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;

class NotificationListScreen extends Screen
{

    public function name(): ?string
    {
        return 'Объявления';
    }

    public function query(): iterable
    {
        return [
            'notification' => CustomerNotification::query()
                ->select([
                    'message',
                    'created_at',
                    'updated_at',
                ])
                ->selectRaw('group_concat(address_id separator ", ") as address_ids')
                ->groupBy('message', 'created_at', 'updated_at')
                ->orderBy('created_at', 'desc')
                ->paginate()
        ];
    }

    public function commandBar(): iterable
    {
        return [
            Link::make(__('Add'))
                ->icon('bs.plus-circle')
                ->href(route('platform.notifications.create')),
        ];
    }

    public function layout(): iterable
    {
        return [
            NotificationListLayout::class,
        ];
    }

}
