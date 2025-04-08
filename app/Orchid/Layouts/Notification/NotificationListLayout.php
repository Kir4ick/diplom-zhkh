<?php

namespace App\Orchid\Layouts\Notification;

use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class NotificationListLayout extends Table
{

    public $target = 'notification';

    protected function columns(): iterable
    {
        return [
            TD::make('message', 'Сообщения'),
            TD::make('address_ids', 'ID адресов'),
            TD::make('created_at', 'Дата обновления'),
            TD::make('updated_at', 'Дата создания'),
        ];
    }

}
