<x-layouts.app :title="__($event->event_name)">
    @if(session('success'))
    <div class="fixed top-6 left-1/2 transform -translate-x-1/2 z-50 bg-green-500 text-white px-6 py-3 rounded-xl shadow-lg text-lg font-semibold animate-fade-in">
        {{ session('success') }}
    </div>
    @endif
    @php
    $isCreate = $isCreate ?? false;
    $isOwner = $isCreate ? true : (auth()->check() && auth()->id() === $event->created_by);
    @endphp

    <div class="min-h-screen flex items-center justify-center bg-white-100 dark:bg-neutral-900">
        @if($isOwner)
        <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-200 via-blue-100 to-blue-400 dark:from-blue-950 dark:via-blue-900 dark:to-blue-800">
            <div class="w-full max-w-xl bg-white dark:bg-white/80 rounded-2xl shadow-2xl p-6 md:p-10 border border-neutral-200 dark:border-neutral-700">
                <form method="POST" action="{{ $isCreate ? route('events.store') : route('events.update', $event->id) }}" class="space-y-8">
                    @csrf
                    @if(!$isCreate)
                    @method('PUT')
                    @endif
                    <h1 class="text-2xl md:text-3xl font-bold text-center text-neutral-900 dark:text-white mb-6">{{ $isCreate ? 'Create Event' : $event->event_name }}</h1>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-neutral-700 dark:text-neutral-200" for="event_name">Event Name</label>
                            <input type="text" id="event_name" name="event_name" value="{{ old('event_name', $event->event_name) }}"
                                class="w-full rounded border border-neutral-200 dark:border-neutral-700 bg-white/80 dark:bg-neutral-900 px-4 py-2 text-neutral-900 dark:text-white focus:ring-2 focus:ring-blue-400 outline-none transition text-base"
                                required>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-neutral-700 dark:text-neutral-200" for="location">Location</label>
                            <input type="text" id="location" name="location" value="{{ old('location', $event->location) }}"
                                class="w-full rounded border border-neutral-200 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-900 px-4 py-2 text-neutral-900 dark:text-white focus:ring-2 focus:ring-blue-400 outline-none transition text-base"
                                required>
                        </div>
                    </div>
                    <div>
                        <label class="block mb-2 text-sm font-medium text-neutral-700 dark:text-neutral-200" for="description">Description</label>
                        <textarea id="description" name="description" rows="3"
                            class="w-full rounded border border-neutral-200 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-900 px-4 py-2 text-neutral-900 dark:text-white focus:ring-2 focus:ring-blue-400 outline-none transition text-base resize-none"
                            required>{{ old('description', $event->description) }}</textarea>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block mb-2 text-sm font-medium text-neutral-700 dark:text-neutral-200" for="start_date">Start Date & Time</label>
                            <input type="datetime-local" id="start_date" name="start_date"
                                value="{{ old('start_date', $event->start_date ? \Carbon\Carbon::parse($event->start_date)->format('Y-m-d\TH:i') : '') }}"
                                class="w-full rounded border border-neutral-200 dark:border-neutral-700 bg-white/80 dark:bg-neutral-900 px-4 py-2 text-neutral-900 dark:text-white focus:ring-2 focus:ring-blue-400 outline-none transition text-base"
                                required>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-neutral-700 dark:text-neutral-200" for="end_date">End Date & Time</label>
                            <input type="datetime-local" id="end_date" name="end_date"
                                value="{{ old('end_date', $event->end_date ? \Carbon\Carbon::parse($event->end_date)->format('Y-m-d\TH:i') : '') }}"
                                class="w-full rounded border border-neutral-200 dark:border-neutral-700 bg-white/80 dark:bg-neutral-900 px-4 py-2 text-neutral-900 dark:text-white focus:ring-2 focus:ring-blue-400 outline-none transition text-base"
                                required>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $event->is_active || $isCreate) ? 'checked' : '' }}
                            class="h-5 w-5 rounded border-neutral-300 dark:border-neutral-700 text-blue-600 focus:ring-blue-500">
                        <label for="is_active" class="text-neutral-700 dark:text-neutral-200 font-medium text-base">Active Event</label>
                    </div>
                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4 items-center justify-center">
                        @if(!$isCreate)
                            <button type="button" onclick="navigator.clipboard.writeText(window.location.href);this.innerText='Link Copied!'" class="px-4 sm:px-6 py-2 sm:py-3 rounded bg-blue-600 text-white font-semibold hover:bg-blue-700 transition text-base sm:text-lg whitespace-nowrap">
                                🔗 Share Event
                            </button>
                        @endif
                        <button type="submit"
                            class="px-4 sm:px-6 py-2 sm:py-3 rounded bg-blue-600 text-white font-bold hover:bg-blue-700 transition text-base sm:text-lg">Save Changes</button>
                    </div>
                    @if(!$isCreate)
                    <div class="mt-10">
                        <h2 class="text-xl font-bold mb-4 text-blue-700 dark:text-blue-300 text-center">RSVP List</h2>
                        <div class="overflow-x-auto rounded shadow">
                            <table class="min-w-full bg-white dark:bg-neutral-900 rounded divide-y divide-neutral-100 dark:divide-neutral-800">
                                <thead>
                                    <tr>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-blue-600 dark:text-blue-200">Name</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-blue-600 dark:text-blue-200">Response</th>
                                        <th class="px-4 py-2 text-left text-sm font-semibold text-blue-600 dark:text-blue-200">Comment</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($rsvps as $rsvp)
                                    <tr class="border-b last:border-0 border-neutral-100 dark:border-neutral-800 hover:bg-neutral-50 dark:hover:bg-neutral-800/50 transition">
                                        <td class="px-4 py-2 text-neutral-900 dark:text-white">{{ $rsvp->name }}</td>
                                        <td class="px-4 py-2 text-neutral-700 dark:text-neutral-200">{{ $rsvp->response }}</td>
                                        <td class="px-4 py-2 text-neutral-700 dark:text-neutral-200">{{ $rsvp->comment ?? '' }}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3" class="px-4 py-4 text-center text-neutral-500 dark:text-neutral-400">No RSVPs yet.</td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </form>
            </div>
        </div>
        @else
        <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-200 via-blue-100 to-blue-400 dark:from-blue-950 dark:via-blue-900 dark:to-blue-800">
            <div class="relative w-full max-w-xl p-0">
                <div class="absolute inset-0 rounded-3xl bg-gradient-to-tr from-blue-400 via-blue-300 to-blue-200 blur-xl opacity-60 scale-105 z-0"></div>
                <div class="relative z-10 rounded-3xl bg-white/80 dark:bg-neutral-900/80 shadow-2xl border-0 backdrop-blur-xl p-10 md:p-14 flex flex-col items-center">
                    <h1 class="text-4xl font-extrabold mb-6 text-center text-blue-700 dark:text-blue-300 drop-shadow-lg tracking-tight z-10 relative">{{ $event->event_name }}</h1>
                    <div class="mb-6 w-full z-10 relative">
                        <span class="block text-xl font-semibold text-blue-500 dark:text-blue-200 mb-2">Description</span>
                        <p class="text-lg text-neutral-700 dark:text-neutral-100 leading-relaxed">{!! nl2br(e($event->description)) !!}</p>
                    </div>
                    <div class="mb-2 text-base text-neutral-600 dark:text-neutral-300 w-full z-10 relative">
                        <span class="font-semibold">Hosted by:</span> <span class="font-medium">{{ $event->user->name ?? 'Unknown' }}</span>
                    </div>
                    <div class="mb-2 text-base text-neutral-600 dark:text-neutral-300 w-full z-10 relative">
                        <span class="font-semibold">Location:</span> <span class="font-medium">{{ $event->location }}</span>
                    </div>
                    <div class="mb-2 text-base text-neutral-600 dark:text-neutral-300 w-full z-10 relative">
                        <span class="font-semibold">Start:</span> <span class="font-medium">{{ \Carbon\Carbon::parse($event->start_date)->format('M d, Y h:i A') }}</span>
                    </div>
                    <div class="mb-6 text-base text-neutral-600 dark:text-neutral-300 w-full z-10 relative">
                        <span class="font-semibold">End:</span> <span class="font-medium">{{ \Carbon\Carbon::parse($event->end_date)->format('M d, Y h:i A') }}</span>
                    </div>
                    <div class="flex justify-center mt-4 w-full z-10 relative">
                        <a href="{{ route('rsvp.create', ['event_id' => $event->id]) }}"
                            class="px-8 py-3 rounded-full bg-gradient-to-r from-blue-500 via-blue-400 to-blue-600 text-white font-extrabold shadow-xl hover:scale-105 hover:from-pink-500 hover:to-blue-500 transition-all duration-200 text-lg tracking-wide ring-2 ring-blue-200 dark:ring-blue-700">
                            🎉 RSVP Now!
                        </a>
                    </div>
                    <div class="w-full max-w-md mt-8 z-10 relative">
                        <div class="flex flex-col sm:flex-row gap-4 justify-center rounded-xl bg-white/70 dark:bg-neutral-900/70 shadow-lg py-4 border border-blue-100 dark:border-blue-800">
                            <div class="flex items-center gap-2 text-green-600 dark:text-green-400 font-semibold text-lg justify-center">
                                👍 Yes: <span>{{ $rsvps->where('response', 'yes')->count() }}</span>
                            </div>
                            <div class="flex items-center gap-2 text-red-500 dark:text-red-400 font-semibold text-lg justify-center">
                                ❌ No: <span>{{ $rsvps->where('response', 'no')->count() }}</span>
                            </div>
                            <div class="flex items-center gap-2 text-yellow-500 dark:text-yellow-300 font-semibold text-lg justify-center">
                                🤔 Maybe: <span>{{ $rsvps->where('response', 'maybe')->count() }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
</x-layouts.app>