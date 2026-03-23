<x-slot:title>{{ __('Events') }}</x-slot:title>
<div class="min-h-screen">

    <!-- Hero Section -->
    <section class="relative py-20">
        <div class="max-w-7xl mx-auto px-8 sm:px-12 lg:px-16">
            <div class="max-w-4xl">
                <!-- Label -->
                <div class="inline-flex items-center gap-2 mb-8">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="h-5 w-5 text-red-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5" />
                    </svg>
                    <span class="text-sm font-medium text-red-600 uppercase tracking-wider">{{ __('Events') }}</span>
                </div>

                <!-- Main Title -->
                <h1 class="text-5xl md:text-6xl lg:text-7xl font-bold text-gray-900 mb-10 leading-[1.1] tracking-tight">
                    {{ __('Laravel Senegal Events') }}
                </h1>

                <!-- Subtitle -->
                <p class="text-xl md:text-2xl text-gray-600 mb-16 leading-relaxed font-light max-w-2xl">
                    {{ __('Discover our upcoming meetups, workshops and events from the') }}
                    <span class="text-red-600 font-normal">Laravel</span> {{ __('community in Senegal') }}
                </p>

                <!-- Search -->
                <div class="flex flex-col sm:flex-row gap-4 mb-10">
                    <div class="flex-1">
                        <div class="relative">
                            <input type="text" wire:model.live.debounce.300ms="search"
                                placeholder="{{ __('Search for an event...') }}"
                                class="w-full px-4 py-3 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-red-500 focus:border-transparent">
                            <svg class="absolute left-3 top-3.5 h-5 w-5 text-gray-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                            </svg>
                        </div>
                    </div>
                </div>

                <!-- Year Filter Tabs -->
                @if ($years->isNotEmpty())
                    <div class="flex flex-wrap gap-2">
                        @foreach ($years as $year)
                            <button
                                wire:click="$set('selectedYear', {{ $year }})"
                                class="px-5 py-2 rounded-full text-sm font-semibold transition-all duration-200 border
                                    {{ $selectedYear == $year
                                        ? 'bg-red-600 text-white border-red-600 shadow-sm'
                                        : 'bg-white text-gray-600 border-gray-300 hover:border-red-400 hover:text-red-600' }}">
                                {{ $year }}
                            </button>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Events Section -->
    <section id="events" class="mb-20">
        <div class="max-w-7xl mx-auto px-8 sm:px-12 lg:px-16">

            <!-- Section heading -->
            <div class="flex items-center gap-4 mb-10">
                <h2 class="text-2xl font-bold text-gray-900">
                    {{ __('Events') }} <span class="text-red-600">{{ $selectedYear }}</span>
                </h2>
                @if ($events->isNotEmpty())
                    <span class="text-sm text-gray-500 font-medium bg-gray-100 px-3 py-1 rounded-full">
                        {{ $events->count() }} {{ $events->count() > 1 ? __('events') : __('event') }}
                    </span>
                @endif
            </div>

            @if ($events->isNotEmpty())
                <!-- Events Grid -->
                <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">
                    @foreach ($events as $event)
                        <article
                            class="group flex flex-col rounded-lg border border-border bg-[hsl(0,0%,99%)] p-6 transition-smooth hover:border-[hsl(0,84%,50%)]/20 hover:shadow-lg hover:shadow-[hsl(0,84%,50%)]/5">
                            <a wire:navigate href="{{ route('event.show', $event) }}">
                                <h3 class="mb-4 text-xl font-bold text-[hsl(0,84%,50%)] leading-tight">
                                    {{ $event->name }}
                                </h3>
                            </a>
                            <div class="mb-4 space-y-2">
                                <div class="flex items-center gap-2 text-sm text-[hsl(220,9%,46%)]">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="h-4 w-4 shrink-0 text-[hsl(0,84%,50%)]/60">
                                        <path d="M8 2v4" /><path d="M16 2v4" />
                                        <rect width="18" height="18" x="3" y="4" rx="2" />
                                        <path d="M3 10h18" />
                                    </svg>
                                    <span>{{ $event->date->format('d/m/Y à H:i') }}</span>
                                </div>
                                <div class="flex items-center gap-2 text-sm text-[hsl(220,9%,46%)]">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                        stroke-linejoin="round"
                                        class="h-4 w-4 shrink-0 text-[hsl(0,84%,50%)]/60">
                                        <path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0" />
                                        <circle cx="12" cy="10" r="3" />
                                    </svg>
                                    <span>{{ $event->place }}</span>
                                </div>
                            </div>

                            <p class="mb-6 flex-1 text-sm leading-relaxed text-[hsl(220,9%,46%)] line-clamp-3">
                                {{ $event->description }}
                            </p>

                            <a wire:navigate href="{{ route('event.show', $event) }}"
                                class="inline-flex items-center justify-center gap-2 whitespace-nowrap rounded-md text-sm font-medium transition-colors bg-[hsl(0,84%,50%)] text-white hover:bg-[hsl(0,84%,50%)]/90 h-10 px-4 py-2">
                                {{ __('View details') }}
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none"
                                    stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="h-4 w-4 transition-transform group-hover:translate-x-1">
                                    <path d="M5 12h14" /><path d="m12 5 7 7-7 7" />
                                </svg>
                            </a>
                        </article>
                    @endforeach
                </div>
            @else
                <!-- Empty State -->
                <div class="text-center py-16 max-w-2xl mx-auto">
                    <svg class="mx-auto h-20 w-20 text-gray-300 mb-8" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1"
                            d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z">
                        </path>
                    </svg>
                    <h3 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4 leading-tight tracking-tight">
                        {{ __('No event found') }}</h3>
                    <p class="text-lg md:text-xl text-gray-600 mb-10 font-light leading-relaxed">
                        @if ($search)
                            {{ __('No event found for your search') }} "{{ $search }}" {{ __('in') }} {{ $selectedYear }}.
                        @else
                            {{ __('No event is currently scheduled') }} {{ __('for') }} {{ $selectedYear }}.
                        @endif
                    </p>
                    @if ($search)
                        <button wire:click="$set('search', '')"
                            class="inline-flex items-center justify-center bg-red-600 text-white px-8 py-4 rounded-xl font-semibold hover:bg-red-700 transition-all duration-200">
                            {{ __('View all events') }}
                        </button>
                    @endif
                </div>
            @endif
        </div>
    </section>

</div>
