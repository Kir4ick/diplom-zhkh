<?php

namespace App\Orchid\Filters;

use Illuminate\Database\Eloquent\Builder;
use Orchid\Filters\Filter;
use Orchid\Screen\Fields\Select;

class RequestStatusFilter extends Filter
{
    public function name(): string
    {
        return 'status';
    }

    public function parameters(): array
    {
        return ['status'];
    }

    public function run(Builder $builder): Builder
    {
        return $builder->where('status', $this->request->get('status'));
    }

    public function display(): iterable
    {
        return [
            Select::make('status')
                ->title('Фильтрация по статусу')
                ->options([
                    'created' => 'Новые',
                    'accepted' => 'Принятые',
                    'done' => 'Завершённые',
                ])
                ->empty('Все'),
        ];
    }
}
