<x-header></x-header>
<x-layout>
    <div class="relative min-h-screen w-full overflow-hidden bg-gray-200/50 dark:bg-gray-800/50">
        <x-video-background lightOpacity="opacity-10" darkOpacity="opacity-40" />
        <div class="relative mx-auto max-w-2xl px-4 py-8 sm:py-12">
            <div class="rounded-xl border border-gray-100 bg-gray-50 p-5 shadow-2xl dark:border-gray-800 sm:p-8 md:p-12">
                <h1 class="mb-5 text-2xl font-bold text-gray-900 sm:mb-6 sm:text-3xl">Contact Us</h1>
                <p class="mb-8 text-gray-600">
                    Have a question or need help with a build? Send us a message below!
                </p>

                <form action="{{ route('contact.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                        <div>
                            <label for="name" class="mb-1 block text-sm font-medium text-gray-700">Name</label>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                value="{{ old('name', auth()->check() ? trim(auth()->user()->first_name . ' ' . auth()->user()->last_name) : '') }}"
                                class="w-full rounded-md border border-gray-300 p-2 shadow-sm focus:border-gray-500 focus:ring-gray-500 dark:bg-white/10"
                                placeholder="Your name"
                            >
                        </div>

                        <div>
                            <label for="email" class="mb-1 block text-sm font-medium text-gray-700">Email</label>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                value="{{ old('email', optional(auth()->user())->email) }}"
                                class="w-full rounded-md border border-gray-300 p-2 shadow-sm focus:border-gray-500 focus:ring-gray-500 dark:bg-white/10"
                                placeholder="you@example.com"
                            >
                        </div>
                    </div>

                    <div>
                        <label for="subject" class="mb-1 block text-sm font-medium text-gray-700">Subject</label>
                        <input
                            type="text"
                            name="subject"
                            id="subject"
                            value="{{ old('subject') }}"
                            required
                            class="w-full rounded-md border border-gray-300 p-2 shadow-sm focus:border-gray-500 focus:ring-gray-500 dark:bg-white/10"
                            placeholder="What is this regarding?"
                        >
                    </div>

                    <div>
                        <label for="message" class="mb-1 block text-sm font-medium text-gray-700">Message</label>
                        <textarea
                            name="message"
                            id="message"
                            rows="5"
                            required
                            class="w-full rounded-md border border-gray-300 p-2 shadow-sm focus:border-gray-500 focus:ring-gray-500 dark:bg-white/10"
                            placeholder="How can we help you today?"
                        >{{ old('message') }}</textarea>
                    </div>

                    <div>
                        <button type="submit" class="flex w-full justify-center rounded-md border border-transparent bg-gray-800 px-4 py-3 text-sm font-medium text-white shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-offset-2 dark:bg-gray-900">
                            Send Message
                        </button>
                    </div>

                    @if (session('status'))
                        <div class="mt-4 rounded-md bg-green-100 p-4 text-green-700">
                            {{ session('status') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="mt-4 rounded-md bg-red-100 p-4 text-red-700">
                            {{ $errors->first() }}
                        </div>
                    @endif
                </form>
            </div>
        </div>
    </div>
</x-layout>

<x-footer></x-footer>
