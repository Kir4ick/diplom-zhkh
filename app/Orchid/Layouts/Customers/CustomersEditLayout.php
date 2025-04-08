<?php

namespace App\Orchid\Layouts\Customers;

use App\Models\Address;
use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class CustomersEditLayout extends Rows
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
            Input::make('customers.name')
                ->type('text')
                ->placeholder('Имя')
                ->max(255)
                ->required(),
            Input::make('customers.middle_name')
                ->type('text')
                ->placeholder('Фамилия')
                ->max(255)
                ->required(),
            Input::make('customers.last_name')
                ->type('text')
                ->placeholder('Отчество')
                ->max(255)
                ->required(),
            Input::make('customers.email')
                ->type('email')
                ->placeholder('Email')
                ->max(255)
                ->required(),
            Input::make('customers.number')
                ->type('text')
                ->placeholder('Номер телефона')
                ->max(255),
            Select::make('customers.address_id')
                    ->options($optionList)
                    ->title('Выбрать адрес'),
        ];
    }

}
