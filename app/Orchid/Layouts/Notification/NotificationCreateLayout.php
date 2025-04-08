<?php

namespace App\Orchid\Layouts\Notification;

use App\Models\Address;
use Illuminate\Database\Eloquent\Collection;
use Orchid\Screen\Fields\Quill;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Fields\TextArea;
use Orchid\Screen\Layouts\Rows;

class NotificationCreateLayout extends Rows
{

    protected function fields(): iterable
    {
        $modelList = Address::query()->get();

        $optionList = [];
        /** @var Address $model */
        foreach ($modelList as $model) {
            $optionList[$model->id] = $model->getFullAttribute();
        }

        return [
            Select::make('address.')
                ->options($optionList)
                ->multiple()
                ->title('Выбрать адреса'),
            Quill::make('message')
                ->title('Сообщение'),
        ];
    }

}
