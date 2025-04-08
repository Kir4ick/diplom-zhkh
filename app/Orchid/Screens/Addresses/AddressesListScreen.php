<?php

namespace App\Orchid\Screens\Addresses;

use App\Models\Address;
use App\Orchid\Layouts\Addresses\AddressesListLayout;
use App\Orchid\Layouts\Addresses\CustomersListLayout;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class AddressesListScreen extends Screen
{

    public function query(): iterable
    {
        return [
            'addresses' => Address::filters()->defaultSort('id', 'desc')->paginate(),
        ];
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make(__('Add'))
                ->icon('bs.plus-circle')
                ->href(route('platform.address.create')),
        ];
    }


    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Учет адресов';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'Таблица учета адресов компании';
    }

    public function layout(): iterable
    {
        return [
            AddressesListLayout::class,
        ];
    }

    public function remove(int $id)
    {
        Address::query()->findOrFail($id)->delete();
        Toast::info('Адрес успешно удалён');

        return redirect()->route('platform.address');
    }

}
