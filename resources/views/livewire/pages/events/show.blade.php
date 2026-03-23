<div class="min-h-screen bg-white">

    @php
        $isUpcoming = now()->lt($event->date);
        $coverMedia = $event->getFirstMedia('events');
    @endphp

    <!-- Hero Banner -->
    <div class="relative w-full overflow-hidden"
         style="min-height: 420px;">

        @if ($coverMedia)
            <img
                src="{{ $coverMedia->getUrl() }}"
                alt="{{ $event->name }}"
                class="absolute inset-0 w-full h-full object-cover"
            />
            <div class="absolute inset-0 bg-gradient-to-t from-gray-900/80 via-gray-900/40 to-transparent"></div>
        @else
            <div class="absolute inset-0 bg-gradient-to-br from-red-700 via-red-600 to-gray-900"></div>
            <!-- Decorative pattern -->
            <div class="absolute inset-0 opacity-10"
                 style="background-image: radial-gradient(circle, white 1px, transparent 1px); background-size: 32px 32px;"></div>
        @endif

        <!-- Back button -->
        <div class="relative z-10 pt-8 px-8 sm:px-12 lg:px-16 max-w-7xl mx-auto">
            <a wire:navigate href="{{ route('events') }}"
               class="inline-flex items-center text-white/80 hover:text-white font-medium transition-colors group text-sm">
                <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                {{ __('Back to events') }}
            </a>
        </div>

        <!-- Hero Content -->
        <div class="relative z-10 flex flex-col justify-end pb-12 pt-16 px-8 sm:px-12 lg:px-16 max-w-7xl mx-auto" style="min-height: 360px;">
            <!-- Status Badge -->
            <div class="mb-6">
                @if ($isUpcoming)
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-green-500/20 text-green-300 border border-green-500/30 backdrop-blur-sm">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse"></span>
                        {{ __('Upcoming') }}
                    </span>
                @else
                    <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-semibold bg-white/10 text-white/70 border border-white/20 backdrop-blur-sm">
                        <span class="w-1.5 h-1.5 rounded-full bg-white/50"></span>
                        {{ __('Past event') }}
                    </span>
                @endif
            </div>

            <!-- Label -->
            <div class="inline-flex items-center gap-2 mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4 text-red-400">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M17.25 6.75 22.5 12l-5.25 5.25m-10.5 0L1.5 12l5.25-5.25m7.5-3-4.5 16.5" />
                </svg>
                <span class="text-xs font-medium text-red-400 uppercase tracking-wider">{{ __('Event') }}</span>
            </div>

            <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white leading-[1.1] tracking-tight max-w-3xl">
                {{ $event->name }}
            </h1>
        </div>
    </div>

    <!-- Main Content -->
    <div class="max-w-7xl mx-auto px-8 sm:px-12 lg:px-16 py-12">
        <div class="flex flex-col lg:flex-row gap-12">

            <!-- Left: Description + Gallery -->
            <div class="flex-1 min-w-0">

                <!-- Description -->
                <section class="mb-12">
                    <div class="flex items-center gap-3 mb-6">
                        <span class="h-px flex-1 max-w-[40px] bg-red-500"></span>
                        <span class="text-xs font-medium text-red-600 uppercase tracking-wider">{{ __('About this event') }}</span>
                    </div>
                    <div class="text-lg text-gray-700 leading-relaxed font-light whitespace-pre-wrap">
                        {{ $event->description }}
                    </div>
                </section>

                @php($mediaItems = $event->getMedia('events'))
                @if ($mediaItems->isNotEmpty())
                    <!-- Gallery -->
                    <section class="mb-12">
                        <div class="flex items-center gap-3 mb-6">
                            <span class="h-px flex-1 max-w-[40px] bg-red-500"></span>
                            <span class="text-xs font-medium text-red-600 uppercase tracking-wider">{{ __('Guest(s)') }}</span>
                        </div>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            @foreach ($mediaItems as $media)
                                <a href="{{ $media->getUrl() }}" target="_blank"
                                   class="group relative overflow-hidden rounded-xl bg-gray-100 aspect-[4/3] border border-gray-200 hover:border-red-300 transition-all duration-200 block">
                                    <img
                                        src="{{ $media->getUrl() }}"
                                        alt="{{ $event->name }} - {{ $loop->iteration }}"
                                        class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                        loading="lazy"
                                    />
                                    <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-10 transition-opacity duration-300"></div>
                                    <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                        <div class="bg-white/90 rounded-full p-2">
                                            <svg class="w-5 h-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"/>
                                            </svg>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </section>
                @endif

            </div>

            <!-- Right: Sticky Info Card -->
            <aside class="lg:w-80 xl:w-96 shrink-0">
                <div class="lg:sticky lg:top-8">
                    <div class="rounded-2xl border border-gray-200 bg-white shadow-sm overflow-hidden">

                        <!-- Card Header -->
                        <div class="bg-gray-50 border-b border-gray-200 px-6 py-4">
                            <p class="text-xs font-semibold text-gray-500 uppercase tracking-wider">{{ __('Event details') }}</p>
                        </div>

                        <!-- Card Body -->
                        <div class="px-6 py-6 space-y-5">
                            <!-- Date -->
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-red-50 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-400 uppercase tracking-wide mb-1">{{ __('Date & Time') }}</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ $event->date->translatedFormat('l d F Y') }}</p>
                                    <p class="text-sm text-gray-500">{{ $event->date->format('H:i') }}</p>
                                </div>
                            </div>

                            <!-- Location -->
                            <div class="flex items-start gap-4">
                                <div class="flex-shrink-0 w-10 h-10 rounded-lg bg-red-50 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="text-xs font-medium text-gray-400 uppercase tracking-wide mb-1">{{ __('Location') }}</p>
                                    <p class="text-sm font-semibold text-gray-900">{{ $event->place }}</p>
                                </div>
                            </div>
                        </div>

                        @if ($event->rsvp_link || $event->event_link)
                            <!-- Divider -->
                            <div class="mx-6 border-t border-gray-100"></div>

                            <!-- Action Buttons -->
                            <div class="px-6 py-5 space-y-3">
                                @if ($event->rsvp_link)
                                    <a href="{{ $event->rsvp_link }}" target="_blank"
                                       class="flex items-center justify-center gap-2 w-full bg-red-600 text-white px-5 py-3 rounded-xl text-sm font-semibold hover:bg-red-700 transition-all duration-200 group">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path>
                                        </svg>
                                        {{ __("Register for the event") }}
                                    </a>
                                @endif

                                @if ($event->event_link)
                                    <a href="{{ $event->event_link }}" target="_blank"
                                       class="flex items-center justify-center gap-2 w-full border border-gray-300 text-gray-700 px-5 py-3 rounded-xl text-sm font-semibold hover:border-red-500 hover:text-red-600 transition-all duration-200 group">
                                        <svg class="w-4 h-4 group-hover:translate-x-0.5 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path>
                                        </svg>
                                        {{ __('More information') }}
                                    </a>
                                @endif
                            </div>
                        @endif

                        <!-- Divider -->
                        <div class="mx-6 border-t border-gray-100"></div>

                        <!-- Share -->
                        <div class="px-6 py-5">
                            <p class="text-xs font-medium text-gray-400 uppercase tracking-wide mb-3">{{ __('Share') }}</p>
                            <div class="flex gap-2">
                                <a href="https://twitter.com/intent/tweet?text={{ urlencode($event->name) }}&url={{ urlencode(request()->url()) }}"
                                   target="_blank"
                                   class="flex items-center justify-center w-9 h-9 rounded-lg border border-gray-200 text-gray-500 hover:border-red-500 hover:text-red-600 transition-all duration-200">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M18.9 1.98h3.28l-7.17 8.2 8.43 11.84h-6.6l-5.17-6.78-5.91 6.78H1.47l7.67-8.8L1 1.98h6.8l4.7 6.17 6.4-6.17Z"/>
                                    </svg>
                                </a>
                                <a href="https://www.linkedin.com/sharing/share-offsite/?url={{ urlencode(request()->url()) }}"
                                   target="_blank"
                                   class="flex items-center justify-center w-9 h-9 rounded-lg border border-gray-200 text-gray-500 hover:border-red-500 hover:text-red-600 transition-all duration-200">
                                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                        <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                                    </svg>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </aside>

        </div>
    </div>

</div>
