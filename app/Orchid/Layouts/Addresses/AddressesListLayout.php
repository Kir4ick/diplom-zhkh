<?php

namespace App\Orchid\Layouts\Addresses;

use App\Models\Address;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Actions\DropDown;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Components\Cells\DateTimeSplit;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class AddressesListLayout extends Table
{

    /**
     * @var string
     */
    public $target = 'addresses';

    protected function columns(): iterable
    {
        return [
            TD::make('address', 'Адрес')
                ->render(
                    fn (Address $address) => $address->getFullAttribute()
                ),

            TD::make('created_at', __('Дата создания'))
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT)
                ->defaultHidden()
                ->sort(),

            TD::make('updated_at', __('Дата последнего обновления'))
                ->usingComponent(DateTimeSplit::class)
                ->align(TD::ALIGN_RIGHT)
                ->sort(),

            TD::make(__('Actions'))
                ->align(TD::ALIGN_CENTER)
                ->width('100px')
                ->render(fn (Address $address) => DropDown::make()
                    ->icon('bs.three-dots-vertical')
                    ->list([

                        Link::make(__('Edit'))
                            ->route('platform.address.update', $address->id)
                            ->icon('bs.pencil'),

                        Button::make(__('Delete'))
                            ->icon('bs.trash3')
                            ->method('remove', [
                                'id' => $address->id,
                            ]),
                    ])),
        ];
    }

}
