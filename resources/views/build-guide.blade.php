<x-header></x-header>
<x-layout>

    <div class="min-h-screen bg-slate-200 font-sans text-slate-900 dark:text-slate-100 py-12">

        <!-- Hero -->
        <div class="bg-gradient-to-r from-indigo-600 to-purple-700 text-white py-16 mb-10 text-center">
            <div class="container mx-auto px-4">
                <h1 class="text-4xl md:text-5xl font-extrabold mb-2">Let's Build Your Dream PC</h1>
                    <p class="text-lg text-indigo-100 max-w-2xl mx-auto">
                    Feeling nervous? Don't be! We're here to guide you through every click, screw, and plug. It's just like LEGO, but expensive!
                    </p>
            </div>
        </div>

        <main class="container mx-auto px-6 max-w-4xl space-y-8">

            <!-- CHECKLIST -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-md border border-slate-200 dark:border-slate-700 p-6 text-center">
                <h2 class="text-2xl font-bold mb-4 flex items-center justify-center gap-2">
                    <i data-lucide="wrench" class="text-indigo-600"></i>
                    Initial Checklist
                </h2>
            <div class="grid md:grid-cols-2 gap-4 text-center">


            <!-- TOOLKIT -->
            <div>
                <h3 class="font-bold text-lg mb-2">Toolkit</h3>
                <div class="space-y-1">
                    <div x-data="{checked:false}" @click="checked=!checked"
                        class="flex items-center justify-center gap-2 p-2 border rounded-lg cursor-pointer transition"
                        :class="checked ? 'bg-green-50 border-green-200 dark:bg-amber-500/20 dark:border-amber-400' : 'border-slate-200 dark:border-slate-600'">

                        <div class="h-4 w-4 border rounded flex items-center justify-center"
                            :class="checked ? 'bg-green-500 border-green-500 dark:bg-amber-500 dark:border-amber-400' : 'border-slate-300 dark:border-slate-500'">

                            <i x-show="checked" data-lucide="check" class="w-3 h-3 text-white"></i>

                        </div>

                        <span :class="checked ? 'line-through opacity-70 dark:text-amber-200' : 'dark:text-slate-200'">
                            Phillips screwdriver
                        </span>

                    </div>

                    <div x-data="{checked:false}" @click="checked=!checked"
                        class="flex items-center justify-center gap-2 p-2 border rounded-lg cursor-pointer transition"
                        :class="checked ? 'bg-green-50 border-green-200 dark:bg-amber-500/20 dark:border-amber-400' : 'border-slate-200 dark:border-slate-600'">

                        <div class="h-4 w-4 border rounded flex items-center justify-center"
                            :class="checked ? 'bg-green-500 border-green-500 dark:bg-amber-500 dark:border-amber-400' : 'border-slate-300 dark:border-slate-500'">

                            <i x-show="checked" data-lucide="check" class="w-3 h-3 text-white"></i>

                        </div>

                        <span :class="checked ? 'line-through opacity-70 dark:text-amber-200' : 'dark:text-slate-200'">
                            Flathead screwdriver
                        </span>

                    </div>

                    <div x-data="{checked:false}" @click="checked=!checked"
                        class="flex items-center justify-center gap-2 p-2 border rounded-lg cursor-pointer transition"
                        :class="checked ? 'bg-green-50 border-green-200 dark:bg-amber-500/20 dark:border-amber-400' : 'border-slate-200 dark:border-slate-600'">

                        <div class="h-4 w-4 border rounded flex items-center justify-center"
                            :class="checked ? 'bg-green-500 border-green-500 dark:bg-amber-500 dark:border-amber-400' : 'border-slate-300 dark:border-slate-500'">

                            <i x-show="checked" data-lucide="check" class="w-3 h-3 text-white"></i>

                        </div>

                        <span :class="checked ? 'line-through opacity-70 dark:text-amber-200' : 'dark:text-slate-200'">
                            Cable ties
                        </span>

                    </div>

                </div>
            </div>


            <!-- SANITY -->
            <div>
                <h3 class="font-bold text-lg mb-2">Sanity Check</h3>

                <div class="space-y-1">

                    <div x-data="{checked:false}" @click="checked=!checked"
                        class="flex items-center justify-center gap-2 p-2 border rounded-lg cursor-pointer transition"
                        :class="checked ? 'bg-green-50 border-green-200 dark:bg-amber-500/20 dark:border-amber-400' : 'border-slate-200 dark:border-slate-600'">

                        <div class="h-4 w-4 border rounded flex items-center justify-center"
                            :class="checked ? 'bg-green-500 border-green-500 dark:bg-amber-500 dark:border-amber-400' : 'border-slate-300 dark:border-slate-500'">

                            <i x-show="checked" data-lucide="check" class="w-3 h-3 text-white"></i>

                        </div>

                        <span :class="checked ? 'line-through opacity-70 dark:text-amber-200' : 'dark:text-slate-200'">
                            GPU fits case
                        </span>

                    </div>


                    <div x-data="{checked:false}" @click="checked=!checked"
                        class="flex items-center justify-center gap-2 p-2 border rounded-lg cursor-pointer transition"
                        :class="checked ? 'bg-green-50 border-green-200 dark:bg-amber-500/20 dark:border-amber-400' : 'border-slate-200 dark:border-slate-600'">

                        <div class="h-4 w-4 border rounded flex items-center justify-center"
                            :class="checked ? 'bg-green-500 border-green-500 dark:bg-amber-500 dark:border-amber-400' : 'border-slate-300 dark:border-slate-500'">

                            <i x-show="checked" data-lucide="check" class="w-3 h-3 text-white"></i>

                        </div>

                        <span :class="checked ? 'line-through opacity-70 dark:text-amber-200' : 'dark:text-slate-200'">
                            CPU compatible
                        </span>

                    </div>


                    <div x-data="{checked:false}" @click="checked=!checked"
                        class="flex items-center justify-center gap-2 p-2 border rounded-lg cursor-pointer transition"
                        :class="checked ? 'bg-green-50 border-green-200 dark:bg-amber-500/20 dark:border-amber-400' : 'border-slate-200 dark:border-slate-600'">

                        <div class="h-4 w-4 border rounded flex items-center justify-center"
                            :class="checked ? 'bg-green-500 border-green-500 dark:bg-amber-500 dark:border-amber-400' : 'border-slate-300 dark:border-slate-500'">

                            <i x-show="checked" data-lucide="check" class="w-3 h-3 text-white"></i>

                        </div>

                        <span :class="checked ? 'line-through opacity-70 dark:text-amber-200' : 'dark:text-slate-200'">
                            Workspace ready
                        </span>

                    </div>

                </div>
            </div>
            </div>
            </div>

            <!-- STEP 1 -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-md border border-slate-200 dark:border-slate-700 p-5 text-center">
                <h3 class="text-xl font-bold flex items-center justify-center gap-3 mb-2">
                    <div class="h-9 w-9 bg-indigo-600 text-white rounded-lg flex items-center justify-center font-bold">1</div>
                    Prep the Case
                </h3>
                <ul class="list-disc list-inside text-slate-600 dark:text-slate-300">
                    <li>Remove panels</li>
                    <li>Remove packaging</li>
                    <li>Install I/O shield</li>
                    <li>Check standoffs</li>
                </ul>
            </div>

            <!-- STEP 2 -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-md border border-slate-200 dark:border-slate-700 p-5 text-center">
                <h3 class="text-xl font-bold flex items-center justify-center gap-3 mb-2">
                    <div class="h-9 w-9 bg-indigo-600 text-white rounded-lg flex items-center justify-center font-bold">2</div>
                    CPU, Cooler & RAM
                </h3>
                <ul class="list-disc list-inside text-slate-600 dark:text-slate-300">
                    <li>Align triangle on CPU</li>
                    <li>Add thermal paste</li>
                    <li>Mount cooler</li>
                    <li>Insert RAM until click</li>
                </ul>
            </div>

            <!-- STEP 3 -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-md border border-slate-200 dark:border-slate-700 p-5 text-center">
                <h3 class="text-xl font-bold flex items-center justify-center gap-3 mb-2">
                    <div class="h-9 w-9 bg-indigo-600 text-white rounded-lg flex items-center justify-center font-bold">3</div>
                    Install Motherboard
                </h3>
                <ul class="list-disc list-inside text-slate-600 dark:text-slate-300">
                    <li>Lower into case</li>
                    <li>Align with I/O shield</li>
                    <li>Screw to standoffs</li>
                    <li>Connect case cables</li>
                </ul>
            </div>

            <!-- STEP 4 -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-md border border-slate-200 dark:border-slate-700 p-5 text-center">
                <h3 class="text-xl font-bold flex items-center justify-center gap-3 mb-2">
                    <div class="h-9 w-9 bg-indigo-600 text-white rounded-lg flex items-center justify-center font-bold">4</div>
                    Storage
                </h3>
                <ul class="list-disc list-inside text-slate-600 dark:text-slate-300">
                    <li>Install M.2 SSD</li>
                    <li>Mount SATA drive</li>
                    <li>Connect cables</li>
                </ul>
            </div>

            <!-- STEP 5 -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-md border border-slate-200 dark:border-slate-700 p-5 text-center">
                <h3 class="text-xl font-bold flex items-center justify-center gap-3 mb-2">
                    <div class="h-9 w-9 bg-indigo-600 text-white rounded-lg flex items-center justify-center font-bold">5</div>
                    Power Supply
                </h3>
                <ul class="list-disc list-inside text-slate-600 dark:text-slate-300">
                    <li>Slide PSU in</li>
                    <li>Fan facing down</li>
                    <li>Connect 24-pin</li>
                    <li>Connect CPU power</li>
                </ul>
            </div>

            <!-- STEP 6 -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-md border border-slate-200 dark:border-slate-700 p-5 text-center">
                <h3 class="text-xl font-bold flex items-center justify-center gap-3 mb-2">
                    <div class="h-9 w-9 bg-indigo-600 text-white rounded-lg flex items-center justify-center font-bold">6</div>
                    Graphics Card
                </h3>
                <ul class="list-disc list-inside text-slate-600 dark:text-slate-300">
                    <li>Insert into PCIe slot</li>
                    <li>Screw bracket</li>
                    <li>Connect power cables</li>
                </ul>
            </div>

            <!-- STEP 7 -->
            <div class="bg-white dark:bg-slate-800 rounded-xl shadow-md border border-slate-200 dark:border-slate-700 p-6 text-center">
                <h3 class="text-xl font-bold flex items-center justify-center gap-3 mb-3">
                    <div class="h-9 w-9 bg-indigo-600 text-white rounded-lg flex items-center justify-center font-bold">7</div>
                    Final Steps
                </h3>
                <p class="text-slate-600 dark:text-slate-300 mb-3"> Plug in monitor, keyboard, and mouse, then press power. </p>
                <div class="bg-green-50 dark:bg-green-900 border border-green-200 dark:border-green-700 text-green-800 dark:text-green-200 rounded-lg p-3 font-bold">
                    If it lights up and spins, YOU DID IT 🎉
                </div>
            </div>

        </main>

        <script>
        lucide.createIcons();
        </script>

    </div>

</x-layout>
<x-footer></x-footer>
