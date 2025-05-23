<x-layouts.app :title="__('Event')">
    <div class="flex justify-center items-center min-h-screen bg-gradient-to-br from-blue-50 via-white to-blue-100 dark:from-neutral-900 dark:via-neutral-800 dark:to-neutral-900">
        @php
            $isCreate = $isCreate ?? false;
            $isOwner = $isCreate ? true : (auth()->check() && auth()->id() === $event->created_by);
        @endphp

        @if($isOwner)
            <form method="POST" action="{{ $isCreate ? route('events.store') : route('events.update', $event->id) }}" class="w-full max-w-xl bg-white dark:bg-neutral-900 rounded-2xl shadow-2xl p-10 space-y-6 border border-neutral-200 dark:border-neutral-700">
                @csrf
                @if(!$isCreate)
                    @method('PUT')
                @endif
                <h1 class="text-3xl font-bold mb-6 text-center text-neutral-900 dark:text-white">
                    {{ $isCreate ? 'Create Event' : 'Edit Event' }}
                </h1>
                <!-- <h1 class="text-3xl font-bold mb-6 text-center text-neutral-900 dark:text-white">Edit Event</h1> -->
                <div>
                    <label class="block mb-2 text-sm font-medium text-neutral-700 dark:text-neutral-200" for="event_name">Event Name</label>
                    <input type="text" id="event_name" name="event_name" value="{{ old('event_name', $event->event_name) }}"
                        class="w-full rounded-lg border border-neutral-300 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-800 px-4 py-2 text-neutral-900 dark:text-white focus:ring-2 focus:ring-blue-400 outline-none transition"
                        required>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-neutral-700 dark:text-neutral-200" for="description">Description</label>
                    <textarea id="description" name="description" rows="4"
                        class="w-full rounded-lg border border-neutral-300 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-800 px-4 py-2 text-neutral-900 dark:text-white focus:ring-2 focus:ring-blue-400 outline-none transition"
                        required>{{ old('description', $event->description) }}</textarea>
                </div>
                <div>
                    <label class="block mb-2 text-sm font-medium text-neutral-700 dark:text-neutral-200" for="location">Location</label>
                    <input type="text" id="location" name="location" value="{{ old('location', $event->location) }}"
                        class="w-full rounded-lg border border-neutral-300 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-800 px-4 py-2 text-neutral-900 dark:text-white focus:ring-2 focus:ring-blue-400 outline-none transition"
                        required>
                </div>
                <div class="flex gap-4">
                    <div class="flex-1">
                        <label class="block mb-2 text-sm font-medium text-neutral-700 dark:text-neutral-200" for="start_date">Start Date & Time</label>
                        <input type="datetime-local" id="start_date" name="start_date"
                            value="{{ old('start_date', \Carbon\Carbon::parse($event->start_date)->format('Y-m-d\TH:i')) }}"
                            class="w-full rounded-lg border border-neutral-300 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-800 px-4 py-2 text-neutral-900 dark:text-white focus:ring-2 focus:ring-blue-400 outline-none transition"
                            required>
                    </div>
                    <div class="flex-1">
                        <label class="block mb-2 text-sm font-medium text-neutral-700 dark:text-neutral-200" for="end_date">End Date & Time</label>
                        <input type="datetime-local" id="end_date" name="end_date"
                            value="{{ old('end_date', \Carbon\Carbon::parse($event->end_date)->format('Y-m-d\TH:i')) }}"
                            class="w-full rounded-lg border border-neutral-300 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-800 px-4 py-2 text-neutral-900 dark:text-white focus:ring-2 focus:ring-blue-400 outline-none transition"
                            required>
                    </div>
                </div>
                <div class="flex justify-between items-center mt-8">
                    <a href="/events" class="text-blue-600 hover:underline text-sm">← Back to Events</a>
                    <button type="submit"
                        class="px-6 py-2 rounded-lg bg-blue-600 text-white font-semibold shadow hover:bg-blue-700 transition">Save Changes</button>
                </div>
            </form>
        @else
            <div class="w-full max-w-xl bg-white dark:bg-neutral-900 rounded-2xl shadow-2xl p-10 space-y-6 border border-neutral-200 dark:border-neutral-700">
                <h1 class="text-3xl font-bold mb-6 text-center text-neutral-900 dark:text-white">{{ $event->event_name }}</h1>
                <div class="mb-4">
                    <span class="block text-sm font-medium text-neutral-700 dark:text-neutral-200">Description</span>
                    <p class="text-base text-neutral-700 dark:text-neutral-100">{!! nl2br(e($event->description)) !!}</p>
                </div>
                <div class="mb-2 text-sm text-neutral-500 dark:text-neutral-400">
                    Hosted by: <span class="font-medium">{{ $event->user->name ?? 'Unknown' }}</span>
                </div>
                <div class="mb-2 text-sm text-neutral-500 dark:text-neutral-400">
                    Location: <span class="font-medium">{{ $event->location }}</span>
                </div>
                <div class="mb-2 text-sm text-neutral-500 dark:text-neutral-400">
                    Start: <span class="font-medium">{{ \Carbon\Carbon::parse($event->start_date)->format('M d, Y H:i A') }}</span>
                </div>
                <div class="mb-2 text-sm text-neutral-500 dark:text-neutral-400">
                    End: <span class="font-medium">{{ \Carbon\Carbon::parse($event->end_date)->format('M d, Y H:i A') }}</span>
                </div>
            </div>
        @endif
    </div>
</x-layouts.app>