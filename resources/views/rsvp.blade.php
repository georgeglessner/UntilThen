<x-layouts.app :title="__('RSVP')">
    <div class="flex justify-center items-center min-h-screen bg-gradient-to-br from-blue-50 via-white to-blue-100 dark:from-neutral-900 dark:via-neutral-800 dark:to-neutral-900">
        <form method="POST" action="{{ route('rsvp.store') }}" class="w-full max-w-xl bg-white dark:bg-neutral-900 rounded-2xl shadow-2xl p-10 space-y-6 border border-neutral-200 dark:border-neutral-700">
            @csrf
            <input type="hidden" name="event_id" value="{{ $event_id }}">
            <h1 class="text-3xl font-bold mb-6 text-center text-neutral-900 dark:text-white">RSVP</h1>
            <div>
                <label class="block mb-2 text-sm font-medium text-neutral-700 dark:text-neutral-200" for="name">Name</label>
                <input type="text" id="name" name="name" value="{{ old('name', auth()->check() ? auth()->user()->name : '') }}"
                    class="w-full rounded-lg border border-neutral-300 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-800 px-4 py-2 text-neutral-900 dark:text-white focus:ring-2 focus:ring-blue-400 outline-none transition"
                    required>
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-neutral-700 dark:text-neutral-200" for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', auth()->check() ? auth()->user()->email : '') }}"
                    class="w-full rounded-lg border border-neutral-300 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-800 px-4 py-2 text-neutral-900 dark:text-white focus:ring-2 focus:ring-blue-400 outline-none transition"
                    required>
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-neutral-700 dark:text-neutral-200" for="phone">Phone</label>
                <input type="tel" id="phone" name="phone" value="{{ old('phone') }}"
                    class="w-full rounded-lg border border-neutral-300 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-800 px-4 py-2 text-neutral-900 dark:text-white focus:ring-2 focus:ring-blue-400 outline-none transition">
            </div>
            <div>
                <label class="block mb-2 text-sm font-medium text-neutral-700 dark:text-neutral-200" for="response">Response</label>
                <select id="response" name="response" required
                    class="w-full rounded-lg border border-neutral-300 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-800 px-4 py-2 text-neutral-900 dark:text-white focus:ring-2 focus:ring-blue-400 outline-none transition">
                    <option value="">Select your response</option>
                    <option value="yes" {{ old('response') == 'yes' ? 'selected' : '' }}>Yes</option>
                    <option value="no" {{ old('response') == 'no' ? 'selected' : '' }}>No</option>
                    <option value="maybe" {{ old('response') == 'maybe' ? 'selected' : '' }}>Maybe</option>
                </select>
            </div>
            <div class="flex justify-between items-center mt-8">
                @auth
                <a href="/events" class="text-blue-600 hover:underline text-sm">← Back to Events</a>
                @endauth
                <button type="submit"
                    class="px-6 py-2 rounded-lg bg-blue-600 text-white font-semibold shadow hover:bg-blue-700 transition">Submit RSVP</button>
            </div>
        </form>
    </div>
</x-layouts.app>
