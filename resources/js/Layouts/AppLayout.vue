<template>
    <div>
        <div class="hidden md:fixed md:inset-y-0 md:flex md:w-64 md:flex-col">
            <div class="flex flex-grow flex-col overflow-y-auto border-r border-gray-200 bg-white pt-5">
                <div class="mt-5 flex flex-grow flex-col">
                    <nav class="flex-1 space-y-1 px-2 pb-4">
                        <a href="/images" class="text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md" :class="route().current('images.search') ? 'bg-gray-100' : ''">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-gray-500 mr-3 flex-shrink-0 h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909m-18 3.75h16.5a1.5 1.5 0 001.5-1.5V6a1.5 1.5 0 00-1.5-1.5H3.75A1.5 1.5 0 002.25 6v12a1.5 1.5 0 001.5 1.5zm10.5-11.25h.008v.008h-.008V8.25zm.375 0a.375.375 0 11-.75 0 .375.375 0 01.75 0z" />
                            </svg>

                            Image Search
                        </a>
                        <a href="/saved-images" class="text-gray-900 group flex items-center px-2 py-2 text-sm font-medium rounded-md" :class="route().current('images.saved') ? 'bg-gray-100' : ''">

                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="text-gray-500 mr-3 flex-shrink-0 h-6 w-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 13.5l3 3m0 0l3-3m-3 3v-6m1.06-4.19l-2.12-2.12a1.5 1.5 0 00-1.061-.44H4.5A2.25 2.25 0 002.25 6v12a2.25 2.25 0 002.25 2.25h15A2.25 2.25 0 0021.75 18V9a2.25 2.25 0 00-2.25-2.25h-5.379a1.5 1.5 0 01-1.06-.44z" />
                            </svg>

                            Saved Images
                        </a>

                    </nav>
                </div>
            </div>
        </div>
        <div class="flex flex-1 flex-col md:pl-64">

            <main class="flex-1">
               <slot />
            </main>
        </div>
    </div>
</template>
