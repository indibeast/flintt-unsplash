<template>
    <teleport to="body">
        <div v-show="show" class="fixed inset-0 overflow-hidden">
            <div class="absolute inset-0 overflow-hidden">
                <Transition
                    enter-active-class="duration-500 ease-in-out"
                    enter-class="opacity-0"
                    enter-to-class="opacity-100"
                    leave-active-class="duration-500 ease-in-out"
                    leave-class="opacity-100"
                    leave-to-class="opacity-0"
                >
                    <button v-show="show" @click="show = false" tabindex="-1" class="absolute inset-0 block w-full h-full transition-opacity bg-gray-500 bg-opacity-25 outline-none cursor-default"></button>
                </Transition>
                <div class="absolute inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
                <div class="pointer-events-none fixed inset-y-0 right-0 flex max-w-full pl-10">
                    <Transition
                        enter-active-class="sm:duration-700 transition duration-500 ease-in-out transform"
                        enter-class="translate-x-full"
                        enter-to-class="translate-x-0"
                        leave-active-class="sm:duration-700 transition duration-500 ease-in-out transform"
                        leave-class="translate-x-0"
                        leave-to-class="translate-x-full"
                    >
                        <div v-show="show" class="pointer-events-auto relative w-screen max-w-2xl" >
                            <div
                                v-if="show"
                                enter-active-class="duration-500 ease-in-out"
                                enter-class="opacity-0"
                                enter-to-class="opacity-100"
                                leave-active-class="duration-500 ease-in-out"
                                leave-class="opacity-100"
                                leave-to-class="opacity-0"
                                class="sm:-ml-10 sm:pr-4 absolute top-0 left-0 flex pt-4 pr-2 -ml-8"
                            >
                                <button aria-label="Close panel" class="hover:text-white text-gray-50 transition duration-150 ease-in-out" @click="show = false">
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            </div>
                            <div class="flex flex-col h-full py-6 space-y-6 overflow-y-scroll bg-white shadow-xl">
                                <div class="px-4 sm:px-6">
                                    <slot name="title"></slot>
                                </div>
                                <div class="sm:px-6 relative flex-1 px-4">
                                    <slot />
                                </div>
                            </div>
                        </div>
                    </Transition>
                </div>
            </div>
        </div>
    </teleport>
</template>

<script>

import { ref, watch, onMounted, onUnmounted} from 'vue'

export default {
    emits: ['slideOverClosed'],

    setup(props, context) {
        const show = ref(false)

        watch(show, () => {
            document.documentElement.style.overflow = show.value ? 'hidden' : 'auto'
            if (show.value === false) {
                context.emit("slideOverClosed")
            }
        })

        onMounted(() => {
            const onEscape = event => {
                if (event && event.key === 'Escape') show.value = false
            }

            document.addEventListener('keydown', onEscape)
            onUnmounted(() => document.removeEventListener('keydown', onEscape))

            window.bus.on('slideover', () => show.value = true)
            window.bus.on('slideoverClose', () => show.value = false)
        })

        return { show }
    },
}
</script>
