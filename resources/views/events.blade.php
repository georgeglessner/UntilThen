<x-layouts.app :title="__('Events')">
    <div class="flex h-full w-full flex-1 flex-col gap-6 rounded-xl">
        <div class="grid gap-8 sm:grid-cols-2 lg:grid-cols-3">
            @foreach($events as $event)
            @if($event->is_active)
                <a href="events/{{ $event->id }}"
                   class="group relative flex flex-col justify-between overflow-hidden rounded-2xl border border-neutral-200 bg-gradient-to-br from-white via-neutral-50 to-neutral-100 shadow-lg transition-all duration-200 hover:scale-[1.03] hover:shadow-2xl dark:border-neutral-700 dark:from-neutral-900 dark:via-neutral-800 dark:to-neutral-900">
                    <div class="p-6">
                        <h2 class="mb-2 text-xl font-bold text-neutral-900 dark:text-white group-hover:text-blue-600 transition-colors duration-200">
                            {{ $event->event_name }}
                        </h2>
                        <p class="mb-1 text-sm text-neutral-500 dark:text-neutral-400">
                            Hosted by: <span class="font-medium text-neutral-700 dark:text-neutral-200">{{ $event->user->name ?? 'Unknown'  }}</span>
                        </p>
                        <p class="mb-3 text-base text-neutral-700 dark:text-neutral-200 line-clamp-2">
                            {{ $event->description }}
                        </p>
                        <div class="flex items-center gap-2 mb-2">
                            <svg class="h-4 w-4 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 12.414a4 4 0 10-5.657 5.657l4.243 4.243a8 8 0 0011.314-11.314l-4.243-4.243a8 8 0 00-11.314 11.314l4.243 4.243"></path>
                            </svg>
                            <span class="text-sm text-neutral-600 dark:text-neutral-300">{{ $event->location }}</span>
                        </div>
                        <div class="flex gap-4 text-xs text-neutral-500 dark:text-neutral-400">
                            <span class="flex items-center gap-1">
                                <svg class="h-4 w-4 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ \Carbon\Carbon::parse($event->start_date)->format('M d, Y H:i A') }}
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="h-4 w-4 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ \Carbon\Carbon::parse($event->end_date)->format('M d, Y H:i A') }}
                            </span>
                        </div>
                    </div>
                    <div class="absolute inset-0 bg-blue-500/0 group-hover:bg-blue-500/10 transition-colors duration-200 pointer-events-none"></div>
                </a>
                @else
                <hr>
                Deleted Events
                <a href="events/{{ $event->id }}"
                   class="group relative flex flex-col justify-between overflow-hidden rounded-2xl border border-neutral-200 bg-gradient-to-br from-white via-neutral-50 to-neutral-100 shadow-lg transition-all duration-200 hover:scale-[1.03] hover:shadow-2xl dark:border-neutral-700 dark:from-neutral-900 dark:via-neutral-800 dark:to-neutral-900">
                    <div class="p-6">
                        <h2 class="mb-2 text-xl font-bold text-neutral-900 dark:text-white group-hover:text-blue-600 transition-colors duration-200">
                            {{ $event->event_name }}
                        </h2>
                        <p class="mb-1 text-sm text-neutral-500 dark:text-neutral-400">
                            Hosted by: <span class="font-medium text-neutral-700 dark:text-neutral-200">{{ $event->user->name ?? 'Unknown'  }}</span>
                        </p>
                        <p class="mb-3 text-base text-neutral-700 dark:text-neutral-200 line-clamp-2">
                            {{ $event->description }}
                        </p>
                        <div class="flex items-center gap-2 mb-2">
                            <svg class="h-4 w-4 text-blue-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 12.414a4 4 0 10-5.657 5.657l4.243 4.243a8 8 0 0011.314-11.314l-4.243-4.243a8 8 0 00-11.314 11.314l4.243 4.243"></path>
                            </svg>
                            <span class="text-sm text-neutral-600 dark:text-neutral-300">{{ $event->location }}</span>
                        </div>
                        <div class="flex gap-4 text-xs text-neutral-500 dark:text-neutral-400">
                            <span class="flex items-center gap-1">
                                <svg class="h-4 w-4 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ \Carbon\Carbon::parse($event->start_date)->format('M d, Y H:i A') }}
                            </span>
                            <span class="flex items-center gap-1">
                                <svg class="h-4 w-4 text-red-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                                </svg>
                                {{ \Carbon\Carbon::parse($event->end_date)->format('M d, Y H:i A') }}
                            </span>
                        </div>
                    </div>
                    <div class="absolute inset-0 bg-blue-500/0 group-hover:bg-blue-500/10 transition-colors duration-200 pointer-events-none"></div>
                </a>
                @endif
            @endforeach
        </div>
    </div>
</x-layouts.app>