<?php

namespace App\Orchid\Layouts\Customers;

use App\Models\Address;
use App\Models\Customer;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class CustomersListLayout extends Table
{

    /**
     * @var string
     */
    public $target = 'customers';

    protected function columns(): iterable
    {
        return [
            TD::make('name', 'Имя')->sort(),
            TD::make('middle_name', 'Фамилия')->sort(),
            TD::make('last_name', 'Отчество')->sort(),
            TD::make('email', 'Email')->sort(),
            TD::make('number', 'Номер телефона')->sort(),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Customer $customer) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([
                        Link::make(__('Edit'))
                            ->route('platform.customer.update', $customer->id)
                            ->icon('bs.pencil'),

                        Button::make(__('Delete'))
                            ->icon('bs.trash3')
                            ->method('remove', [
                                'id' => $customer->id,
                            ]),
                    ])),
        ];
    }

}
