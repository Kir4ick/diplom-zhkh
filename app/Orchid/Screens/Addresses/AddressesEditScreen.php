<?php

namespace App\Orchid\Screens\Addresses;

use App\Models\Address;
use App\Orchid\Layouts\Addresses\AddressesEditLayout;
use Illuminate\Http\Request;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class AddressesEditScreen extends Screen
{

    public $addresses;

    public function layout(): iterable
    {
        return [
            AddressesEditLayout::class,
        ];
    }

    public function query(Address $addresses): iterable
    {
        return [
            'addresses' => $addresses,
        ];
    }

    public function name(): string
    {
        return 'Изменение/добавление адреса';
    }

    public function commandBar(): iterable
    {
        return [
            Button::make(__('Save'))
                ->icon('bs.check-circle')
                ->method('save'),

            Button::make(__('Remove'))
                ->icon('bs.trash3')
                ->method('remove')
                ->canSee($this->addresses->exists),
        ];
    }

    public function save(Request $request, ?Address $addresses)
    {
        $request->validate([
            'addresses.street' => 'required|min:2',
            'addresses.house_type' => 'required|in:flat,house',
            'addresses.number' => 'required|numeric|min:1',
            'addresses.block' => 'numeric|nullable',
            'addresses.postal_code' => 'required|min:5',
        ]);

        $addresses->fill($request->get('addresses'))->save();

        return redirect()->route('platform.address');
    }

    public function remove(Address $addresses)
    {
        $addresses->delete();
        Toast::info('Адрес успешно удалён');

        return redirect()->route('platform.address');
    }
}
