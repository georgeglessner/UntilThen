<x-layouts.app title="Dashboard">
    <div class="min-h-screen flex flex-col items-center justify-center bg-gradient-to-br from-blue-50 via-white to-blue-100 dark:from-neutral-900 dark:via-neutral-800 dark:to-neutral-900 p-0 m-0">
        <div class="w-full max-w-3xl mx-auto py-12">
            <h1 class="text-4xl font-extrabold text-center text-blue-700 dark:text-blue-300 mb-10 drop-shadow-lg tracking-tight">Dashboard</h1>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="rounded-2xl bg-white dark:bg-neutral-900 shadow-xl p-6 border border-blue-100 dark:border-blue-700">
                    <h2 class="text-xl font-bold text-blue-700 dark:text-blue-300 mb-2">Your Events</h2>
                    <ul class="space-y-2">
                        @forelse($events as $event)
                        <li>
                            <a href="{{ route('events.show', $event->id) }}" class="text-blue-600 dark:text-blue-300 hover:underline font-semibold">{{ $event->event_name }}</a>
                        </li>
                        @empty
                        <li class="text-neutral-500 dark:text-neutral-400">No events yet.</li>
                        @endforelse
                    </ul>
                </div>
                <div class="rounded-2xl bg-white dark:bg-neutral-900 shadow-xl p-6 border border-blue-100 dark:border-blue-700">
                    <h2 class="text-xl font-bold text-blue-700 dark:text-blue-300 mb-2">RSVPs</h2>
                    <ul class="space-y-2">
                        @forelse($rsvps as $rsvp)
                        <li>
                            <span class="font-semibold text-neutral-700 dark:text-neutral-200">{{ $rsvp->event->event_name }}</span>:
                            <span class="text-blue-600 dark:text-blue-300">{{ $rsvp->response }}</span>
                        </li>
                        @empty
                        <li class="text-neutral-500 dark:text-neutral-400">No RSVPs yet.</li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app>
