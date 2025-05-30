<x-layouts.app :title="__('RSVP')">
     @if($errors->any())
    <div class="mb-6">
        @foreach($errors->all() as $error)
            <div class="bg-red-500 text-white px-6 py-3 rounded-xl shadow-lg text-lg font-semibold mb-2 animate-fade-in">
                {{ $error }}
            </div>
        @endforeach
    </div>
    @endif
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-200 via-blue-100 to-blue-400 dark:from-blue-950 dark:via-blue-900 dark:to-blue-800">
        <div class="relative w-full max-w-xl p-0">
            <div class="absolute inset-0 rounded-3xl bg-gradient-to-tr from-blue-400 via-blue-300 to-blue-200 blur-xl opacity-60 scale-105 z-0"></div>
            <div class="relative z-10 rounded-3xl bg-white/80 dark:bg-neutral-900/80 shadow-2xl border-0 backdrop-blur-xl p-10 md:p-14 flex flex-col items-center">
                <div class="w-full max-w-md mb-6">
                    <h1 class="text-4xl font-extrabold mb-6 text-center text-blue-700 dark:text-blue-300 drop-shadow-lg tracking-tight z-10 relative">
                        RSVP
                    </h1>
                    <form method="POST" action="{{ route('rsvp.store') }}" class="space-y-6 z-10 relative w-full">
                        @csrf
                        <input type="hidden" name="event_id" value="{{ $event_id }}">
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
                            <label class="block mb-2 text-sm font-medium text-neutral-700 dark:text-neutral-200" for="comment">Comment</label>
                            <textarea id="comment" name="comment" rows="4"
                                class="w-full rounded-lg border border-neutral-300 dark:border-neutral-700 bg-neutral-50 dark:bg-neutral-800 px-4 py-2 text-neutral-900 dark:text-white focus:ring-2 focus:ring-blue-400 outline-none transition"
                            >{{ old('comment') }}</textarea>
                        </div>
                        <div>
                            <label class="block mb-2 text-sm font-medium text-neutral-700 dark:text-neutral-200" for="response">Response</label>
                            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center w-full">
                                <input type="radio" id="response_yes" name="response" value="yes" class="hidden" {{ old('response') == 'yes' ? 'checked' : '' }}>
                                <label for="response_yes" id="label_yes" class="w-full sm:w-auto cursor-pointer px-6 py-4 rounded-full bg-blue-100 dark:bg-blue-900 text-blue-700 dark:text-blue-200 font-bold text-lg flex items-center justify-center gap-2 shadow transition-all text-center">
                                    ✅ Yes
                                </label>
                                <input type="radio" id="response_no" name="response" value="no" class="hidden" {{ old('response') == 'no' ? 'checked' : '' }}>
                                <label for="response_no" id="label_no" class="w-full sm:w-auto cursor-pointer px-6 py-4 rounded-full bg-red-100 dark:bg-red-900 text-red-700 dark:text-red-200 font-bold text-lg flex items-center justify-center gap-2 shadow transition-all text-center">
                                    ❌ No
                                </label>
                                <input type="radio" id="response_maybe" name="response" value="maybe" class="hidden" {{ old('response') == 'maybe' ? 'checked' : '' }}>
                                <label for="response_maybe" id="label_maybe" class="w-full sm:w-auto cursor-pointer px-6 py-4 rounded-full bg-yellow-100 dark:bg-yellow-900 text-yellow-700 dark:text-yellow-200 font-bold text-lg flex items-center justify-center gap-2 shadow transition-all text-center">
                                    🤔 Maybe
                                </label>
                            </div>
                        </div>
                        <div class="flex flex-col items-center mt-8">
                            @auth
                            <a href="/events" class="text-blue-600 hover:underline text-sm mb-4">← Back to Events</a>
                            @endauth
                            <button type="submit"
                                class="px-8 py-3 rounded-full bg-gradient-to-r from-blue-500 via-blue-400 to-blue-600 text-white font-extrabold shadow-xl hover:scale-105 hover:from-pink-500 hover:to-blue-500 transition-all duration-200 text-lg tracking-wide ring-2 ring-blue-200 dark:ring-blue-700">🎉 Submit RSVP</button>
                        </div>
                    </form>
                </div>
                <div class="w-full max-w-md mt-8 z-10 relative">
                    <div class="flex flex-col sm:flex-row gap-4 justify-center rounded-xl bg-white/70 dark:bg-neutral-900/70 shadow-lg py-4 border border-blue-100 dark:border-blue-800">
                        <div class="flex items-center gap-2 text-green-600 dark:text-green-400 font-semibold text-lg justify-center">
                            👍 Yes: <span>{{ $yesCount ?? 0 }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-red-500 dark:text-red-400 font-semibold text-lg justify-center">
                            ❌ No: <span>{{ $noCount ?? 0 }}</span>
                        </div>
                        <div class="flex items-center gap-2 text-yellow-500 dark:text-yellow-300 font-semibold text-lg justify-center">
                            🤔 Maybe: <span>{{ $maybeCount ?? 0 }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const radios = document.querySelectorAll('input[name="response"]');
            const labels = {
                yes: document.getElementById('label_yes'),
                no: document.getElementById('label_no'),
                maybe: document.getElementById('label_maybe')
            };
            function highlightSelected() {
                radios.forEach(radio => {
                    if (radio.checked) {
                        if (radio.value === 'yes') {
                            labels.yes.classList.add('bg-blue-500', 'text-white');
                        } else {
                            labels.yes.classList.remove('bg-blue-500', 'text-white');
                        }
                        if (radio.value === 'no') {
                            labels.no.classList.add('bg-red-500', 'text-white');
                        } else {
                            labels.no.classList.remove('bg-red-500', 'text-white');
                        }
                        if (radio.value === 'maybe') {
                            labels.maybe.classList.add('bg-yellow-400', 'text-white');
                        } else {
                            labels.maybe.classList.remove('bg-yellow-400', 'text-white');
                        }
                    }
                });
            }
            radios.forEach(radio => {
                radio.addEventListener('change', highlightSelected);
            });
            highlightSelected();
        });
    </script>
</x-layouts.app>
