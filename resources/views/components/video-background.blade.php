@props(['lightOpacity', 'darkOpacity'])
<div class="fixed inset-0 z-[-1] pointer-events-none overflow-hidden">
    <!-- video background -->
    <video
        autoplay muted loop playsinline
        class="absolute inset-0 w-full h-full object-cover invert hue-rotate-[270deg] contrast-150 brightness-200 {{ $lightOpacity }}
               dark:invert-0 dark:grayscale-0 dark:hue-rotate-180 dark:{{ $darkOpacity }} transition-opacity duration-700">
        <source src="{{ asset('videos/testhigh.mp4') }}" type="video/mp4">
        Your browser does not support the video tag.
    </video>
    <!-- to blend the background with a gradient to make it look smoother -->
    <div class="absolute inset-0 bg-gradient-to-b from-transparent to-white dark:to-gray-900 opacity-50"></div>
</div>
