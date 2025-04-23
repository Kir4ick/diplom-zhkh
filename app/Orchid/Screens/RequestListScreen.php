<?php

namespace App\Orchid\Screens;

use App\Models\Request;
use App\Orchid\Filters\RequestStatusFilter;
use Illuminate\Support\Facades\Mail;
use Orchid\Screen\Screen;
use Orchid\Screen\TD;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Fields\Select;
use Orchid\Support\Facades\Layout;

class RequestListScreen extends Screen
{
    public function query(\Illuminate\Http\Request $request): array
    {
        $query = Request::query();

        if ($status = $request->get('filter.status')) {
            $query->where('status', $status);
        }

        return [
            'requests' => $query
                ->filters([RequestStatusFilter::class])
                ->defaultSort('created_at', 'desc')
                ->paginate(),
        ];
    }

    public function name(): ?string
    {
        return 'Обращения клиентов';
    }

    public function commandBar(): array
    {
        return [];
    }

    public function layout(): array
    {
        return [
            Layout::selection([
                RequestStatusFilter::class
            ]),
            Layout::table('requests', [
                TD::make('title', 'Обращение')->sort(),
                TD::make('phone', 'Номер телефона')->sort(),
                TD::make('status', 'Текущий статус')->render(function (Request $request) {
                    return $request->getAdminStatus();
                })->sort(),
                TD::make('created_at', 'Дата создания')->sort(),
                TD::make('Actions')
                    ->align(TD::ALIGN_CENTER)
                    ->width('100px')
                    ->render(function (Request $request) {
                        if ($request->status === 'created') {
                            return Button::make('Взять в работу')
                                ->method('changeStatus', ['request' => $request->id, 'status' => 'accepted']);
                        } elseif ($request->status === 'accepted') {
                            return Button::make('Перенести в выполненные')
                                ->method('changeStatus', ['request' => $request->id, 'status' => 'done']);
                        }
                        return '';
                    }),
            ]),
        ];
    }

    public function changeStatus(Request $request, $status): void
    {
        if ($status === 'accepted') {
            Mail::raw('Ваша заявка: ' . $request->title . ' была исполнена.', function ($message) use ($request) {
                $message->to($request->customer->email)->subject('Принятие заявки');
            });
        }

        $request->update(['status' => $status]);
    }
}
