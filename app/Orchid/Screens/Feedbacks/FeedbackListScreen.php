<?php

namespace App\Orchid\Screens\Feedbacks;

use App\Models\Feedback;
use App\Orchid\Layouts\Feedbacks\FeedbacksListLayout;
use Orchid\Screen\Screen;

class FeedbackListScreen extends Screen
{

    public $feedbacks;

    public function name(): ?string
    {
        return 'Обратная связь';
    }

    public function query(): iterable
    {
        return [
            'feedbacks' => Feedback::query()->paginate(),
        ];
    }

    public function layout(): iterable
    {
        return [
            FeedbacksListLayout::class,
        ];
    }


}
