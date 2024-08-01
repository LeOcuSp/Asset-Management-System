<?php

namespace App\Filament\User\Resources\EventRegisterResource\Widgets;

use Filament\Widgets\Widget;
use App\Models\EventRegister;
use Illuminate\Database\Eloquent\Model;

class CalendarWidget extends Widget
{
    protected static string $view = 'filament.widgets.calendar-widget';

    public Model|string|null $model = EventRegister::class;

    public function getViewData(): array
    {
        return [
            'events' => $this->fetchEvents(),
        ];
    }

    protected function fetchEvents(): array
    {
        return EventRegister::all()->map(function ($event) {
            return [
                'id'    => $event->id,
                'title' => $event->name,
                'type'  => $event->type,
                'start' => $event->start,
                'end'   => $event->end,
                
            ];
        })->toArray();
    }
}

