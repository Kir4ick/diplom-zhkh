<?php

namespace App\Orchid\Layouts\Addresses;

use Orchid\Screen\Fields\Input;
use Orchid\Screen\Fields\Select;
use Orchid\Screen\Layouts\Rows;

class AddressesEditLayout extends Rows
{

    protected function fields(): iterable
    {
        return [
            Input::make('addresses.street')
                ->type('text')
                ->placeholder('Улица')
                ->max(255)
                ->required(),
            Select::make('addresses.house_type')
                ->options(['flat' => 'Квартира', 'house' => 'Дом']),
            Input::make('addresses.number')
                ->type('number')
                ->placeholder('Номер')
                ->max(255)
                ->required(),
            Input::make('addresses.block')
                ->type('number')
                ->placeholder('Корпус')
                ->max(255),
            Input::make('addresses.postal_code')
                ->type('text')
                ->placeholder('Почтовый индекс')
                ->max(255)
                ->required(),
        ];
    }

}
