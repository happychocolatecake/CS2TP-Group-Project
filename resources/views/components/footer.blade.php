<footer class="rounded-t-[2rem] bg-gradient-to-br from-orange-500 via-orange-600 to-amber-600 text-white shadow-[0_-12px_30px_rgba(249,115,22,0.2)] transition-colors duration-300 dark:bg-gradient-to-b dark:from-gray-800 dark:to-gray-900 dark:shadow-none">
    <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">

        <div class="flex flex-col sm:flex-row justify-center gap-12 sm:gap-24 sm:gap-40 text-center sm:text-left">
            <div class="px-4">
                <h2 class="text-xl font-semibold text-white"> Happy Hardware </h2>
                <p class="mt-2 text-sm text-orange-100 dark:text-gray-400"> Quality hardware at the best prices. </p>
</div>

            <div class="w-auto">
                <h3 class="text-sm font-semibold text-gray-100 tracking-wider uppercase dark:text-gray-100">
                    <strong>HELP</strong>
                </h3>
                <ul role="list" class="mt-4 space-y-4">
                    <li>
                        <a href="{{ route('faq') }}" class="text-base text-orange-100 transition-colors duration-200 hover:text-white dark:text-gray-400 dark:hover:text-white">
                            FAQ
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('build-guide') }}" class="text-base text-orange-100 transition-colors duration-200 hover:text-white dark:text-gray-400 dark:hover:text-white">
                            How-to Guides
                        </a>
                    </li>
                </ul>
            </div>

            <div class="w-auto">
                <h3 class="text-sm font-semibold text-gray-100 tracking-wider uppercase dark:text-gray-100">
                    <strong>OTHER</strong>
                </h3>
                <ul role="list" class="mt-4 space-y-4">
                    <li>
                        <a href="{{ route('privacy') }}" class="text-base text-orange-100 transition-colors duration-200 hover:text-white dark:text-gray-400 dark:hover:text-white">
                            Privacy Policy
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('sitemap') }}" class="text-base text-orange-100 transition-colors duration-200 hover:text-white dark:text-gray-400 dark:hover:text-white">
                            Sitemap
                        </a>
                    </li>
                </ul>
            </div>

        </div>

        <div class="mt-12 border-t border-white/20 pt-8 text-center dark:border-gray-700">
            <p class="text-sm text-orange-100 dark:text-gray-400">
                &copy; 2026 Happy Hardware. Group 27.
            </p>
        </div>
    </div>
</footer>
