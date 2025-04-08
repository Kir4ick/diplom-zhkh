<?php

namespace App\Orchid\Screens\Customers;

use App\Models\Address;
use App\Models\Customer;
use App\Orchid\Layouts\Customers\CustomersListLayout;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class CustomersListScreen extends Screen
{

    public function query(): iterable
    {
        return [
            'customers' => Customer::filters()->defaultSort('id', 'desc')->paginate(),
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
                ->href(route('platform.customer.create')),
        ];
    }


    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return 'Учет клиентов';
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return 'Таблица учета клиентов';
    }

    public function layout(): iterable
    {
        return [
            CustomersListLayout::class,
        ];
    }

    public function remove(int $id)
    {
        Customer::query()->findOrFail($id)->delete();
        Toast::info('Клиент успешно удалён');

        return redirect()->route('platform.customer');
    }

}
