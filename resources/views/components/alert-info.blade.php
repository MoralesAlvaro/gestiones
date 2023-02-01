<div class="fixed cursor-pointer text-center py-4 lg:px-4 absolute bottom-0 left-0" x-data="{ open: true }" @click="open = ! open"
    x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
    x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
    <div class="p-2 bg-ligthBlue-400 items-center text-blue-800 leading-none lg:rounded-full flex lg:inline-flex shadow-md"
        role="alert">
        <span class="flex rounded-full bg-white uppercase px-2 py-1 text-xs text-blue-400 font-bold mr-3">Nuevo</span>
        <span class="font-semibold mr-2 text-left flex-auto">{{ session('info') }}</span>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round" d="M11.25 11.25l.041-.02a.75.75 0 011.063.852l-.708 2.836a.75.75 0 001.063.853l.041-.021M21 12a9 9 0 11-18 0 9 9 0 0118 0zm-9-3.75h.008v.008H12V8.25z" />
          </svg>
    </div>
</div>
<!-- 12345678 -->
