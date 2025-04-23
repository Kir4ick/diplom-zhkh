<?php

namespace App\Orchid\Layouts\Feedbacks;

use App\Models\Feedback;
use Orchid\Screen\Layouts\Table;
use Orchid\Screen\TD;

class FeedbacksListLayout extends Table
{

    protected $target = 'feedbacks';

    protected function columns(): iterable
    {
        return [
            TD::make('subject', 'Тема')->sort(),
            TD::make('message', 'Сообщение')->sort(),

            TD::make('customer', 'Пользователь')
                ->render(function (Feedback $feedback) {
                    return $feedback->customer->getFullNameAttribute();
                }),

            TD::make('created_at', 'Дата создания')->sort(),
            TD::make('updated_at', 'Дата обновления')->sort(),
        ];
    }

}
