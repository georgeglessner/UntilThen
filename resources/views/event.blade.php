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

    @if($isOwner)
    <form method="POST" action="{{ $isCreate ? route('events.store') : route('events.update', $event->id) }}" class="min-h-screen w-full flex flex-col items-center justify-center bg-gradient-to-br from-blue-50 via-white to-blue-100 dark:from-neutral-900 dark:via-neutral-800 dark:to-neutral-900 p-0 m-0">
        @csrf
        @if(!$isCreate)
        @method('PUT')
        @endif
        <div class="w-full max-w-3xl px-8 py-12">
            <h1 class="text-4xl font-bold mb-10 text-center text-neutral-900 dark:text-white">
                {{ $isCreate ? 'Create Event' : $event->event_name }}
            </h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div>
                    <label class="block mb-2 text-sm font-medium text-neutral-700 dark:text-neutral-200" for="event_name">Event Name</label>
                    <input type="text" id="event_name" name="event_name" value="{{ old('event_name', $event->event_name) }}"
                        class="w-full rounded-lg border border-neutral-300 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-800 px-4 py-2 text-neutral-900 dark:text-white focus:ring-2 focus:ring-blue-400 outline-none transition"
                        required>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-neutral-700 dark:text-neutral-200" for="location">Location</label>
                    <input type="text" id="location" name="location" value="{{ old('location', $event->location) }}"
                        class="w-full rounded-lg border border-neutral-300 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-800 px-4 py-2 text-neutral-900 dark:text-white focus:ring-2 focus:ring-blue-400 outline-none transition"
                        required>
                </div>
            </div>
            <div class="mb-8">
                <label class="block mb-2 text-sm font-medium text-neutral-700 dark:text-neutral-200" for="description">Description</label>
                <textarea id="description" name="description" rows="4"
                    class="w-full rounded-lg border border-neutral-300 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-800 px-4 py-2 text-neutral-900 dark:text-white focus:ring-2 focus:ring-blue-400 outline-none transition"
                    required>{{ old('description', $event->description) }}</textarea>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 mb-8">
                <div>
                    <label class="block mb-2 text-sm font-medium text-neutral-700 dark:text-neutral-200" for="start_date">Start Date & Time</label>
                    <input type="datetime-local" id="start_date" name="start_date"
                        value="{{ old('start_date', $event->start_date ? \Carbon\Carbon::parse($event->start_date)->format('Y-m-d\TH:i') : '') }}"
                        class="w-full rounded-lg border border-neutral-300 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-800 px-4 py-2 text-neutral-900 dark:text-white focus:ring-2 focus:ring-blue-400 outline-none transition"
                        required>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-neutral-700 dark:text-neutral-200" for="end_date">End Date & Time</label>
                    <input type="datetime-local" id="end_date" name="end_date"
                        value="{{ old('end_date', $event->end_date ? \Carbon\Carbon::parse($event->end_date)->format('Y-m-d\TH:i') : '') }}"
                        class="w-full rounded-lg border border-neutral-300 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-800 px-4 py-2 text-neutral-900 dark:text-white focus:ring-2 focus:ring-blue-400 outline-none transition"
                        required>
                </div>
            </div>
            <div class="flex items-center mb-8">
                <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $event->is_active || $isCreate) ? 'checked' : '' }}
                    class="h-5 w-5 rounded border-neutral-300 dark:border-neutral-700 text-blue-600 focus:ring-blue-500">
                <label for="is_active" class="ml-3 text-neutral-700 dark:text-neutral-200 font-medium text-lg">Active Event</label>
            </div>
            <div class="flex justify-between items-center mt-8">
                <a href="/events" class="text-blue-600 hover:underline text-sm">← Back to Events</a>
                <div class="flex gap-4 items-center">
                    @if(!$isCreate)
                        <button type="button" onclick="navigator.clipboard.writeText(window.location.href);this.innerText='Link Copied!'" class="px-8 py-3 rounded-lg bg-blue-600 text-white font-semibold shadow hover:bg-blue-700 transition text-lg">
                            🔗 Share Event
                        </button>
                    @endif
                    <button type="submit"
                        class="px-8 py-3 rounded-lg bg-blue-600 text-white font-semibold shadow hover:bg-blue-700 transition text-lg">Save Changes</button>
                </div>
            </div>

            @if(!$isCreate)
            {{-- RSVP List Section --}}
            <div class="mt-12">
                <h2 class="text-2xl font-bold mb-4 text-blue-700 dark:text-blue-300 text-center">RSVP List</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white dark:bg-neutral-900 rounded-xl shadow divide-y divide-blue-100 dark:divide-neutral-800">
                        <thead>
                            <tr>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-blue-600 dark:text-blue-200">Name</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-blue-600 dark:text-blue-200">Response</th>
                                <th class="px-4 py-2 text-left text-sm font-semibold text-blue-600 dark:text-blue-200">Comment</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($rsvps as $rsvp)
                            <tr class="border-b last:border-0 border-blue-50 dark:border-neutral-800">
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
        </div>
    </form>
    @else
    <div class="flex justify-center items-center min-h-screen bg-gradient-to-br from-blue-100 via-white to-blue-200 dark:from-neutral-900 dark:via-neutral-800 dark:to-neutral-900">
        <div class="w-full max-w-xl bg-white dark:bg-neutral-900 rounded-3xl shadow-2xl p-12 space-y-8 border-2 border-blue-200 dark:border-blue-700 relative overflow-hidden">
            <div class="absolute -top-8 -right-8 bg-blue-500/20 rounded-full w-32 h-32 blur-2xl z-0"></div>
            <h1 class="text-4xl font-extrabold mb-6 text-center text-blue-700 dark:text-blue-300 drop-shadow-lg tracking-tight z-10 relative">
                {{ $event->event_name }}
            </h1>
            <div class="mb-6 z-10 relative">
                <span class="block text-xl font-semibold text-blue-500 dark:text-blue-200 mb-2">Description</span>
                <p class="text-lg text-neutral-700 dark:text-neutral-100 leading-relaxed">{!! nl2br(e($event->description)) !!}</p>
            </div>
            <div class="mb-2 text-base text-neutral-600 dark:text-neutral-300 z-10 relative">
                <span class="font-semibold">Hosted by:</span> <span class="font-medium">{{ $event->user->name ?? 'Unknown' }}</span>
            </div>
            <div class="mb-2 text-base text-neutral-600 dark:text-neutral-300 z-10 relative">
                <span class="font-semibold">Location:</span> <span class="font-medium">{{ $event->location }}</span>
            </div>
            <div class="mb-2 text-base text-neutral-600 dark:text-neutral-300 z-10 relative">
                <span class="font-semibold">Start:</span> <span class="font-medium">{{ \Carbon\Carbon::parse($event->start_date)->format('M d, Y h:i A') }}</span>
            </div>
            <div class="mb-2 text-base text-neutral-600 dark:text-neutral-300 z-10 relative">
                <span class="font-semibold">End:</span> <span class="font-medium">{{ \Carbon\Carbon::parse($event->end_date)->format('M d, Y h:i A') }}</span>
            </div>
            <div class="flex justify-center mt-10 z-10 relative">
                <a href="{{ route('rsvp.create', ['event_id' => $event->id]) }}"
                    class="px-8 py-3 rounded-full bg-gradient-to-r from-blue-500 via-blue-400 to-blue-600 text-white font-extrabold shadow-xl hover:scale-105 hover:from-pink-500 hover:to-blue-500 transition-all duration-200 text-lg tracking-wide ring-2 ring-blue-200 dark:ring-blue-700">
                    🎉 RSVP Now!
                </a>
            </div>
            <div class="absolute bottom-0 left-0 w-24 h-24 bg-pink-400/20 rounded-full blur-2xl z-0"></div>
            {{-- RSVP Response Counts --}}
            @php
            $yesCount = $rsvps->where('response', 'yes')->count();
            $noCount = $rsvps->where('response', 'no')->count();
            $maybeCount = $rsvps->where('response', 'maybe')->count();
            @endphp
            <div class="flex gap-6 mb-6 justify-center">
                <div class="flex items-center gap-2 text-green-600 dark:text-green-400 font-semibold">
                    👍 Yes: <span>{{ $yesCount }}</span>
                </div>
                <div class="flex items-center gap-2 text-red-500 dark:text-red-400 font-semibold">
                    ❌ No: <span>{{ $noCount }}</span>
                </div>
                <div class="flex items-center gap-2 text-yellow-500 dark:text-yellow-300 font-semibold">
                    🤔 Maybe: <span>{{ $maybeCount }}</span>
                </div>
            </div>
        </div>
    </div>
    @endif
</x-layouts.app>