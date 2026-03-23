<?php

namespace App\Livewire\Pages;

use App\Models\Event;
use Livewire\Attributes\Layout;
use Livewire\Component;

class EventsPage extends Component
{
    public string $search = '';

    public int $selectedYear;

    public function mount()
    {
        $this->selectedYear = now()->year;
    }

    #[Layout('layouts.guest')]
    public function render()
    {
        $years = Event::query()
            ->published()
            ->selectRaw("strftime('%Y', date) as year")
            ->distinct()
            ->orderByDesc('year')
            ->pluck('year')
            ->map(fn ($y) => (int) $y);

        $events = Event::query()
            ->published()
            ->whereRaw("strftime('%Y', date) = ?", [(string) $this->selectedYear])
            ->when($this->search, fn ($query) => $query->where(function ($q) {
                $q->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('place', 'like', '%'.$this->search.'%')
                    ->orWhere('description', 'like', '%'.$this->search.'%');
            }))
            ->orderBy('date', 'desc')
            ->get();

        return view('livewire.pages.events-page', [
            'events' => $events,
            'years' => $years,
        ]);
    }
}
