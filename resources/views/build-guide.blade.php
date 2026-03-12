<x-header></x-header>
<x-layout>
<div class="min-h-screen bg-slate-50 font-sans text-slate-900">



<!-- Hero Section -->
<div class="bg-gradient-to-r from-indigo-600 to-purple-700 text-white py-16">
    <div class="container mx-auto px-4 text-center">
        <h1 class="text-4xl md:text-5xl font-extrabold mb-4 tracking-tight">
            Let's Build Your Dream PC
        </h1>
        <p class="text-xl text-indigo-100 max-w-2xl mx-auto">
            Feeling nervous? Don't be! We're here to hold your hand through every click, screw, and plug. It's just like LEGO, but expensive!
        </p>
    </div>
</div>

<!-- Main Content -->
<main class="container mx-auto px-4 py-12 max-w-5xl">

    <!-- Pre-Flight Check -->
    <div class="mb-12">
        <h2 class="text-2xl font-bold text-slate-800 mb-6 flex items-center gap-2">
            <i data-lucide="wrench" class="text-indigo-600"></i>
            The Pre-Flight Check
        </h2>
        <div class="grid md:grid-cols-2 gap-6">
            <!-- Toolkit Card -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                <h3 class="font-bold text-lg mb-4 text-slate-700">Your Toolkit</h3>
                <div class="space-y-2">
                    <!-- Checklist Item Component -->
                    <div x-data="{ checked: false }"
                         @click="checked = !checked"
                         class="flex items-center gap-3 p-3 rounded-lg cursor-pointer transition-all border select-none"
                         :class="checked ? 'bg-green-50 border-green-200' : 'bg-white border-slate-200 hover:border-indigo-300'">
                        <div class="h-5 w-5 rounded border flex items-center justify-center transition-colors"
                             :class="checked ? 'bg-green-500 border-green-500' : 'border-slate-300'">
                            <i x-show="checked" data-lucide="check" class="w-3.5 h-3.5 text-white"></i>
                        </div>
                        <span :class="checked ? 'text-slate-800 line-through opacity-70' : 'text-slate-700'">Phillips head screwdriver</span>
                    </div>

                    <div x-data="{ checked: false }" @click="checked = !checked" class="flex items-center gap-3 p-3 rounded-lg cursor-pointer transition-all border select-none" :class="checked ? 'bg-green-50 border-green-200' : 'bg-white border-slate-200 hover:border-indigo-300'">
                        <div class="h-5 w-5 rounded border flex items-center justify-center transition-colors" :class="checked ? 'bg-green-500 border-green-500' : 'border-slate-300'"><i x-show="checked" data-lucide="check" class="w-3.5 h-3.5 text-white dark:text-black"></i></div>
                        <span :class="checked ? 'text-slate-800 line-through opacity-70' : 'text-slate-700'">Flat head screwdriver</span>
                    </div>

                    <div x-data="{ checked: false }" @click="checked = !checked" class="flex items-center gap-3 p-3 rounded-lg cursor-pointer transition-all border select-none" :class="checked ? 'bg-green-50 border-green-200' : 'bg-white border-slate-200 hover:border-indigo-300'">
                        <div class="h-5 w-5 rounded border flex items-center justify-center transition-colors" :class="checked ? 'bg-green-500 border-green-500' : 'border-slate-300'"><i x-show="checked" data-lucide="check" class="w-3.5 h-3.5 text-white"></i></div>
                        <span :class="checked ? 'text-slate-800 line-through opacity-70' : 'text-slate-700'">Cable ties (for tidiness)</span>
                    </div>

                    <div x-data="{ checked: false }" @click="checked = !checked" class="flex items-center gap-3 p-3 rounded-lg cursor-pointer transition-all border select-none" :class="checked ? 'bg-green-50 border-green-200': 'bg-white border-slate-200 hover:border-indigo-300'">
                        <div class="h-5 w-5 rounded border flex items-center justify-center transition-colors" :class="checked ? 'bg-green-500 border-green-500'  : 'border-slate-300'"><i x-show="checked" data-lucide="check" class="w-3.5 h-3.5 text-white"></i></div>
                        <span :class="checked ? 'text-slate-800 line-through opacity-70' : 'text-slate-700'">Scissors or wire cutters</span>
                    </div>
                </div>
            </div>

            <!-- Sanity Check Card -->
            <div class="bg-white p-6 rounded-xl shadow-sm border border-slate-200">
                <h3 class="font-bold text-lg mb-4 text-slate-700">Sanity Check</h3>
                <div class="space-y-2">
                    <div x-data="{ checked: false }" @click="checked = !checked" class="flex items-center gap-3 p-3 rounded-lg cursor-pointer transition-all border select-none" :class="checked ? 'bg-green-50 border-green-200' : 'bg-white border-slate-200 hover:border-indigo-300'">
                        <div class="h-5 w-5 rounded border flex items-center justify-center transition-colors" :class="checked ? 'bg-green-500 border-green-500' : 'border-slate-300'"><i x-show="checked" data-lucide="check" class="w-3.5 h-3.5 text-white"></i></div>
                        <span :class="checked ? 'text-slate-800 line-through opacity-70' : 'text-slate-700'">Does the GPU fit in your case?</span>
                    </div>
                    <div x-data="{ checked: false }" @click="checked = !checked" class="flex items-center gap-3 p-3 rounded-lg cursor-pointer transition-all border select-none" :class="checked ? 'bg-green-50 border-green-200' : 'bg-white border-slate-200 hover:border-indigo-300'">
                        <div class="h-5 w-5 rounded border flex items-center justify-center transition-colors" :class="checked ? 'bg-green-500 border-green-500' : 'border-slate-300'"><i x-show="checked" data-lucide="check" class="w-3.5 h-3.5 text-white"></i></div>
                        <span :class="checked ? 'text-slate-800 line-through opacity-70' : 'text-slate-700'">CPU compatible with Motherboard?</span>
                    </div>
                    <div x-data="{ checked: false }" @click="checked = !checked" class="flex items-center gap-3 p-3 rounded-lg cursor-pointer transition-all border select-none" :class="checked ? 'bg-green-50 border-green-200' : 'bg-white border-slate-200 hover:border-indigo-300'">
                        <div class="h-5 w-5 rounded border flex items-center justify-center transition-colors" :class="checked ? 'bg-green-500 border-green-500' : 'border-slate-300'"><i x-show="checked" data-lucide="check" class="w-3.5 h-3.5 text-white"></i></div>
                        <span :class="checked ? 'text-slate-800 line-through opacity-70' : 'text-slate-700'">Clean, flat table ready?</span>
                    </div>
                    <div x-data="{ checked: false }" @click="checked = !checked" class="flex items-center gap-3 p-3 rounded-lg cursor-pointer transition-all border select-none" :class="checked ? 'bg-green-50 border-green-200' : 'bg-white border-slate-200 hover:border-indigo-300'">
                        <div class="h-5 w-5 rounded border flex items-center justify-center transition-colors" :class="checked ? 'bg-green-500 border-green-500' : 'border-slate-300'"><i x-show="checked" data-lucide="check" class="w-3.5 h-3.5 text-white"></i></div>
                        <span :class="checked ? 'text-slate-800 line-through opacity-70' : 'text-slate-700'">Warm drink ready? ☕</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Steps Container -->
    <div class="grid gap-8">

        <!-- Step 1 -->

        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-slate-100 hover:shadow-xl transition-shadow duration-300">
            <div class="bg-slate-50 p-4 border-b border-slate-100 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 bg-indigo-600 rounded-lg flex items-center justify-center text-white font-bold text-xl shadow-sm">1</div>
                    <h3 class="text-xl font-bold text-slate-800">Prep the Case</h3>
                </div>
                <i data-lucide="wrench" class="text-slate-400 w-6 h-6"></i>
            </div>
            <div class="p-6">
                <p class="text-slate-600 mb-4">Let's get your PC case ready for its new organs.</p>
                <ul class="list-disc pl-5 space-y-2 text-slate-600">
                    <li><strong>Open it up:</strong> Remove both side panels (glass and metal).</li>
                    <li><strong>Clear it out:</strong> Remove any boxes or silica gel packets hiding inside.</li>
                    <li><strong>The I/O Shield:</strong> Snap that rectangular metal plate into the hole at the back of the case. Watch your fingers—it's sharp!</li>
                    <li><strong>Standoffs:</strong> Ensure the little brass screw risers are installed in the case where your motherboard holes will be.</li>
                </ul>
                <!-- Tip Box -->
                <div class="mt-6 bg-indigo-50 border border-indigo-100 rounded-lg p-4 flex gap-3 items-start">
                    <i data-lucide="heart" class="text-indigo-500 w-5 h-5 flex-shrink-0 mt-0.5"></i>
                    <p class="text-sm text-indigo-800 font-medium">
                        <span class="font-bold">Pro Tip:</span> Keep your screws in a bowl so they don't roll away!
                    </p>
                </div>
            </div>
        </div>

        <!-- Step 2 -->
        [Image of installing cpu on motherboard]
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-slate-100 hover:shadow-xl transition-shadow duration-300">
            <div class="bg-slate-50 p-4 border-b border-slate-100 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 bg-indigo-600 rounded-lg flex items-center justify-center text-white font-bold text-xl shadow-sm">2</div>
                    <h3 class="text-xl font-bold text-slate-800">The Motherboard (The Core)</h3>
                </div>
                <i data-lucide="cpu" class="text-slate-400 w-6 h-6"></i>
            </div>
            <div class="p-6">
                <p class="text-slate-600 mb-4">We're going to build the core outside the case first.</p>
                <div class="space-y-6">
                    <div class="bg-slate-50 p-4 rounded-lg border border-slate-200">
                        <h4 class="font-bold text-indigo-600 mb-2">A. Installing the CPU</h4>
                        <p class="text-slate-600">Lift the metal arm. Match the <strong>gold triangle</strong> on the CPU corner with the triangle on the socket. Drop it in gently (zero force!). Lock the arm down.</p>
                    </div>
                    <div class="bg-slate-50 p-4 rounded-lg border border-slate-200">
                        <h4 class="font-bold text-indigo-600 mb-2">B. The Cooler</h4>
                        <p class="text-slate-600">Peel the plastic sticker off the bottom! Apply a pea-sized drop of thermal paste to the CPU (unless pre-applied). Screw the cooler on and plug its fan into <code class="bg-slate-200 px-1 rounded text-sm">CPU_FAN</code>.</p>
                    </div>
                    <div class="bg-slate-50 p-4 rounded-lg border border-slate-200">
                        <h4 class="font-bold text-indigo-600 mb-2">C. The RAM</h4>
                        <p class="text-slate-600">Open the plastic latches. Line up the notch on the stick with the slot. Push down firmly until you hear a satisfying <strong>CLICK</strong>.</p>
                    </div>
                </div>
                <div class="mt-6 bg-indigo-50 border border-indigo-100 rounded-lg p-4 flex gap-3 items-start">
                    <i data-lucide="heart" class="text-indigo-500 w-5 h-5 flex-shrink-0 mt-0.5"></i>
                    <p class="text-sm text-indigo-800 font-medium">
                        <span class="font-bold">Pro Tip:</span> Install the CPU, Cooler, and RAM BEFORE putting the motherboard in the case. Trust us.
                    </p>
                </div>
            </div>
        </div>

        <!-- Step 3 -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-slate-100 hover:shadow-xl transition-shadow duration-300">
            <div class="bg-slate-50 p-4 border-b border-slate-100 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 bg-indigo-600 rounded-lg flex items-center justify-center text-white font-bold text-xl shadow-sm">3</div>
                    <h3 class="text-xl font-bold text-slate-800">Moving In</h3>
                </div>
                <i data-lucide="arrow-right" class="text-slate-400 w-6 h-6"></i>
            </div>
            <div class="p-6">
                <p class="text-slate-600 mb-4">Now your motherboard is fully loaded, let’s give it a home.</p>
                <ol class="list-decimal pl-5 space-y-2 text-slate-600">
                    <li>Gently lower the motherboard into the case.</li>
                    <li>Line up the ports with that I/O shield you installed earlier.</li>
                    <li>Screw the motherboard into the brass standoffs. Tighten gently—don't Hulk out!</li>
                    <li><strong>Case Cables:</strong> Connect the tiny cables (Power SW, Reset, LED) to the motherboard pins. (Consult your manual for this puzzle!).</li>
                </ol>
            </div>
        </div>

        <!-- Step 4 & 5 Combined Row -->
        <div class="grid md:grid-cols-2 gap-8">
            <!-- Step 4 -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-slate-100 hover:shadow-xl transition-shadow duration-300">
                <div class="bg-slate-50 p-4 border-b border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 bg-indigo-600 rounded-lg flex items-center justify-center text-white font-bold text-xl shadow-sm">4</div>
                        <h3 class="text-xl font-bold text-slate-800">Storage</h3>
                    </div>
                    <i data-lucide="hard-drive" class="text-slate-400 w-6 h-6"></i>
                </div>
                <div class="p-6">
                    <p class="text-slate-600"><strong>M.2 SSD:</strong> Slide the stick into the slot on the motherboard and screw it down.</p>
                    <div class="my-4 border-t border-slate-100"></div>
                    <p class="text-slate-600"><strong>SATA SSD/HDD:</strong> Mount the brick-style drive in a drive cage. You need two cables: one for power (from PSU) and one for data (to motherboard).</p>
                </div>
            </div>

            <!-- Step 5 -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden border border-slate-100 hover:shadow-xl transition-shadow duration-300">
                <div class="bg-slate-50 p-4 border-b border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="h-10 w-10 bg-indigo-600 rounded-lg flex items-center justify-center text-white font-bold text-xl shadow-sm">5</div>
                        <h3 class="text-xl font-bold text-slate-800">Power Supply</h3>
                    </div>
                    <i data-lucide="zap" class="text-slate-400 w-6 h-6"></i>
                </div>
                <div class="p-6">
                    <p class="text-slate-600">Slide the PSU into the bottom (or top) slot. Usually, fan faces <strong>down</strong> towards the vent.</p>
                    <p class="mt-2 text-slate-600">Thread your cables through to the front. You definitely need:</p>
                    <ul class="list-disc pl-5 mt-2 text-sm text-slate-600">
                        <li>Big 24-pin (Motherboard right side)</li>
                        <li>CPU Power (Motherboard top left)</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Step 6 -->

        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-slate-100 hover:shadow-xl transition-shadow duration-300">
            <div class="bg-slate-50 p-4 border-b border-slate-100 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 bg-indigo-600 rounded-lg flex items-center justify-center text-white font-bold text-xl shadow-sm">6</div>
                    <h3 class="text-xl font-bold text-slate-800">The Graphics Card</h3>
                </div>
                <i data-lucide="monitor" class="text-slate-400 w-6 h-6"></i>
            </div>
            <div class="p-6">
                <p class="text-slate-600 mb-4">The moment of truth for gamers.</p>
                <ol class="list-decimal pl-5 space-y-2 text-slate-600">
                    <li>Find the top long PCIe slot on the motherboard.</li>
                    <li>Remove the metal covers on the back of the case that align with it.</li>
                    <li>Push the GPU into the slot until it <strong>CLICKS</strong>.</li>
                    <li>Screw the metal bracket to the case so it doesn't sag.</li>
                    <li><strong>Power Up:</strong> Plug the PCIe power cables from the PSU into the card.</li>
                </ol>
                <div class="mt-6 bg-indigo-50 border border-indigo-100 rounded-lg p-4 flex gap-3 items-start">
                    <i data-lucide="heart" class="text-indigo-500 w-5 h-5 flex-shrink-0 mt-0.5"></i>
                    <p class="text-sm text-indigo-800 font-medium">
                        <span class="font-bold">Pro Tip:</span> Don't forget to remove the plastic covers on the GPU video ports!
                    </p>
                </div>
            </div>
        </div>

        <!-- Step 7 -->
        <div class="bg-white rounded-xl shadow-md overflow-hidden border border-slate-100 hover:shadow-xl transition-shadow duration-300">
            <div class="bg-slate-50 p-4 border-b border-slate-100 flex items-center justify-between">
                <div class="flex items-center gap-3">
                    <div class="h-10 w-10 bg-indigo-600 rounded-lg flex items-center justify-center text-white font-bold text-xl shadow-sm">7</div>
                    <h3 class="text-xl font-bold text-slate-800">Blast Off!</h3>
                </div>
                <i data-lucide="check-circle" class="text-slate-400 w-6 h-6"></i>
            </div>
            <div class="p-6">
                <p class="text-slate-600"><strong>Finishing Touches:</strong> Install any extra fans and use those cable ties to manage the mess in the back.</p>
                <p class="mt-4 text-slate-600">Now, plug in your monitor, keyboard, and mouse. Flip the switch on the PSU to 'I', and press the power button.</p>
                <div class="mt-6 p-4 bg-green-50 text-green-800 rounded-lg text-center font-bold text-lg border border-green-200">
                    If it lights up and spins, YOU DID IT! 🎉
                </div>
            </div>
        </div>

    </div>
</main>

<!-- Initialize Icons -->
<script>
    lucide.createIcons();
</script>
</div>
</x-layout>
<x-footer></x-footer>
