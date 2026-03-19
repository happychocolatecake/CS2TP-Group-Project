<x-admin-layout title="Admin Messages">
    <section class="mx-auto max-w-7xl space-y-8 px-4 py-8">
        @include('admin.partials.alerts')

        <section class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-800 dark:bg-gray-900">
            <div class="flex flex-col gap-3 md:flex-row md:items-end md:justify-between">
                <div>
                    <p class="text-sm font-medium uppercase tracking-[0.2em] text-gray-500 dark:text-gray-400">Customer Messages</p>
                    <h1 class="mt-2 text-3xl font-bold text-gray-900 dark:text-white">Contact Inbox</h1>
                    <p class="mt-2 text-sm text-gray-600 dark:text-gray-300">View the messages submitted from the contact-us page.</p>
                </div>
                <span class="rounded-full bg-gray-100 px-3 py-1 text-sm font-medium text-gray-700 dark:bg-white/10 dark:text-gray-300">{{ $messages->total() }} messages</span>
            </div>
        </section>

        <section class="space-y-4">
            @forelse ($messages as $message)
                <article class="rounded-3xl border border-gray-200 bg-white p-6 shadow-sm dark:border-gray-800 dark:bg-gray-900">
                    <div class="flex flex-col gap-4 lg:flex-row lg:items-start lg:justify-between">
                        <div>
                            <div class="flex flex-wrap items-center gap-3">
                                <h2 class="text-xl font-semibold text-gray-900 dark:text-white">{{ $message->subject }}</h2>
                                <span class="rounded-full px-3 py-1 text-xs font-medium {{ $message->user_id ? 'bg-emerald-100 text-emerald-700 dark:bg-emerald-500/10 dark:text-emerald-200' : 'bg-gray-100 text-gray-700 dark:bg-white/10 dark:text-gray-300' }}">
                                    {{ $message->user_id ? 'Registered User' : 'Guest / Unknown' }}
                                </span>
                            </div>
                            <p class="mt-2 text-sm text-gray-500 dark:text-gray-400">
                                {{ $message->sender_name ?: ($message->user ? $message->user->first_name . ' ' . $message->user->last_name : 'Unknown sender') }}
                                @if ($message->sender_email)
                                    · {{ $message->sender_email }}
                                @endif
                            </p>
                        </div>
                        <div class="text-sm text-gray-500 dark:text-gray-400">
                            {{ optional($message->created_at)->format('d M Y H:i') }}
                        </div>
                    </div>

                    <div class="mt-4 rounded-2xl bg-gray-50 p-4 text-sm leading-7 text-gray-700 dark:bg-slate-950/60 dark:text-gray-300">
                        {!! nl2br(e($message->message)) !!}
                    </div>
                </article>
            @empty
                <p class="rounded-3xl border border-gray-200 bg-white px-6 py-8 text-sm text-gray-500 shadow-sm dark:border-gray-800 dark:bg-gray-900 dark:text-gray-400">No contact messages have been submitted yet.</p>
            @endforelse

            <div>{{ $messages->links() }}</div>
        </section>
    </section>
</x-admin-layout>
