<div class="fixed cursor-pointer text-center py-4 lg:px-4 absolute bottom-0 left-0" x-data="{ open: true }" @click="open = ! open"
    x-show="open" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 scale-90"
    x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-300"
    x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
    <div class="p-2 bg-red-400 items-center text-white leading-none lg:rounded-full flex lg:inline-flex shadow-md"
        role="alert">
        <span class="flex rounded-full bg-white uppercase px-2 py-1 text-xs text-red-400 font-bold mr-3">Nuevo</span>
        <span class="font-semibold mr-2 text-left flex-auto">{{ session('warning') }}</span>
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="w-6 h-6">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
        </svg>
    </div>
</div>
<!-- 12345678 -->
