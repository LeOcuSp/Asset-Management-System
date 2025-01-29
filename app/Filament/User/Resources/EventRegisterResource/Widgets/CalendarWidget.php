<?php

namespace App\Filament\User\Resources\EventRegisterResource\Widgets;

use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;
use Saade\FilamentFullCalendar\Data\EventData;
use App\Models\EventRegister;

class CalendarWidget extends FullCalendarWidget
{
    
    protected function getViewData(): array
    {
        return [
            'config' => [
                'headerToolbar' => [
                    'left' => 'prev,next today',
                    'center' => 'title',
                    'right' => 'dayGridMonth,timeGridWeek,timeGridDay'
                ],
                'initialView' => 'dayGridMonth',
                'dayMaxEvents' => true,
                'selectable' => true,
                'eventTimeFormat' => [
                    'hour' => '2-digit',
                    'minute' => '2-digit',
                    'meridiem' => true,
                ],
            ]
        ];
    }

    
    public function fetchEvents(array $fetchInfo): array
    {
        return EventRegister::query()
            ->where('user_id', auth()->id())
            ->where('start', '>=', $fetchInfo['start'])
            ->where('end', '<=', $fetchInfo['end'])
            ->get()
            ->map(function (EventRegister $event) {
            
                $color = match ($event->type) {
                    'meeting' => '#4CAF50',   
                    'training' => '#2196F3',  
                    'conference' => '#9C27B0', 
                    default => '#FF9800'       
                };

                return EventData::make()
                    ->id($event->id)
                    ->title($event->name)
                    ->start($event->start)
                    ->end($event->end)
                    ->url(route('filament.user.resources.event-registers.edit', ['record' => $event->id]))
                    ->backgroundColor($color)
                    ->textColor('#ffffff')
                    ->extraAttributes([
                        'location' => $event->location,
                        'description' => $event->description,
                        'type' => $event->type,
                        'online_only' => $event->online_only,
                        'virtual_link' => $event->virtual_link,
                    ]);
            })
            ->toArray();
    }

   
    protected function getOptions(): array
    {
        return [
            'plugins' => ['dayGrid', 'timeGrid', 'interaction'],
            'defaultAllDay' => false,
            'editable' => false,
            'selectable' => true,
            'displayEventTime' => true,
        ];
    }
}