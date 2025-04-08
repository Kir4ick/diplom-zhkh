<?php

namespace App\Orchid\Screens\Customers;

use App\Models\Customer;
use App\Orchid\Layouts\Customers\CustomersEditLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class CustomersEditScreen extends Screen
{

    public $customers;

    public function layout(): iterable
    {
        return [
            CustomersEditLayout::class,
        ];
    }

    public function query(Customer $customers): iterable
    {
        return [
            'customers' => $customers,
        ];
    }

    public function name(): string
    {
        return 'Изменение/добавление клиента';
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
                ->canSee($this->customers->exists),
        ];
    }

    public function save(Request $request, ?Customer $customers)
    {
        $request->validate([
            'customers.name' => 'required|min:2',
            'customers.middle_name' => 'required|min:2',
            'customers.last_name' => 'required|min:2',
            'customers.email' => 'required|email|unique:customers,email',
            'customers.number' => 'min:9',
            'customers.address_id' => 'required|exists:addresses,id',
        ]);

        $password = Str::password();
        $customers->fill(
            array_merge($request->get('customers'), ['password' => $password])
        )->save();

        return redirect()->route('platform.customer');
    }

    public function remove(Customer $customer)
    {
        $customer->delete();
        Toast::info('Клиент успешно удалён');

        return redirect()->route('platform.customer');
    }
}
