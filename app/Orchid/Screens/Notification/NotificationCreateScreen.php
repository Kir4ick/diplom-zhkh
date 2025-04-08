<?php

namespace App\Orchid\Screens\Notification;

use App\Jobs\CustomerNotificationJob;
use App\Models\CustomerNotification;
use App\Orchid\Layouts\Notification\NotificationCreateLayout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Toast;

class NotificationCreateScreen extends Screen
{

    public function query(): iterable
    {
        return [];
    }

    public function name(): string
    {
        return 'Добавление объявления';
    }

    public function layout(): iterable
    {
        return [
            NotificationCreateLayout::class,
        ];
    }

    public function commandBar(): iterable
    {
        return [
            Button::make(__('Save'))
                ->icon('bs.check-circle')
                ->method('save'),
        ];
    }

    public function save(Request $request)
    {
        $params = $request->validate([
            'address' => 'array|required',
            'address.*' => 'exists:addresses,id',
            'message' => 'required|string|min:10',
        ]);

        $date = new \DateTime();

        $data = [];
        foreach ($params['address'] as $address) {
            $data[] = [
                'address_id' => $address,
                'message' => $params['message'],
                'user_id' => Auth::id(),
                'created_at' => $date->format('Y-m-d H:i:s'),
                'updated_at' => $date->format('Y-m-d H:i:s'),
            ];
        }

        $idList = [];
        foreach ($data as $item) {
            $idList[] = CustomerNotification::query()->insertGetId($item);
        }

        CustomerNotificationJob::dispatch($idList);
        Toast::info('Объявление создано');

        return redirect()->route('platform.notifications');
    }
}
