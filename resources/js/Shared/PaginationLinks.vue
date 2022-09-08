<template>
    <div class="flex items-center justify-between">
        <div class="lg:hidden flex justify-between flex-1">
            <Link v-if="pagination.previous" :href="pagination.previous.href" class="hover:text-gray-500 border-gray-focus:ring-cyan-400 focus:ring focus:outline-none focus:z-10 relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border rounded-md">
                Previous
            </Link>
            <Link v-if="pagination.next" :href="pagination.next.href" class="hover:text-gray-500 border-gray-focus:ring-cyan-400 focus:ring focus:outline-none focus:z-10 relative inline-flex items-center px-4 py-2 ml-3 text-sm font-medium text-gray-700 bg-white border rounded-md">
                Next
            </Link>
        </div>
        <div class="lg:flex-1 lg:flex lg:items-center lg:justify-between hidden">
            <div>
                <p class="text-sm text-gray-700">
                    Showing
                    <span class="font-medium">{{ pagination.showingFromItemNumber }}</span>
                    to
                    <span class="font-medium">{{ pagination.showingToItemNumber }}</span>
                    of
                    <span class="font-medium">{{ pagination.totalItems }}</span>
                    results.
                </p>
            </div>
            <div>
                <nav class="relative z-0 inline-flex -space-x-px rounded-md shadow-sm" aria-label="Pagination">
                    <Link v-if="pagination.previous" :href="pagination.previous.href" class="rounded-l-md hover:bg-gray-50 focus:ring-cyan-400 focus:ring focus:outline-none focus:z-10 relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300">
                        <span class="sr-only">Previous</span>
                        <!-- Heroicon name: solid/chevron-left -->
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
                        </svg>
                    </Link>
                    <Link v-for="link in pagination.linksBefore" :key="link.label" :href="link.href" class="hover:bg-gray-50 focus:ring-cyan-400 focus:ring focus:outline-none focus:z-10 relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300" :class="{ 'font-bold': `${link.label}` === `${pagination.currentPage}` }">
                        {{ link.label }}
                    </Link>
                    <span v-if="pagination.linksBefore.length && pagination.linksBetween.length" class="focus:ring-cyan-400 focus:ring focus:outline-none focus:z-10 relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300">
                        ...
                    </span>
                    <span v-if="pagination.linksBetween.length === 0 && pagination.linksAfter.length" class="focus:ring-cyan-400 focus:ring focus:outline-none focus:z-10 relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300">
                        ...
                    </span>
                    <Link v-for="link in pagination.linksBetween" :key="link.label" :href="link.href" class="hover:bg-gray-50 focus:ring-cyan-400 focus:ring focus:outline-none focus:z-10 relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300" :class="{ 'font-bold': `${link.label}` === `${pagination.currentPage}` }">
                        {{ link.label }}
                    </Link>
                    <span v-if="pagination.linksBetween.length && pagination.linksAfter.length" class="focus:ring-cyan-400 focus:ring focus:outline-none focus:z-10 relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300">
                        ...
                    </span>
                    <Link v-for="link in pagination.linksAfter" :key="link.label" :href="link.href" class="hover:bg-gray-50 focus:ring-cyan-400 focus:ring focus:outline-none focus:z-10 relative inline-flex items-center px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300" :class="{ 'font-bold': `${link.label}` === `${pagination.currentPage}` }">
                        {{ link.label }}
                    </Link>
                    <Link v-if="pagination.next" :href="pagination.next.href" class="rounded-r-md hover:bg-gray-50 focus:ring-cyan-400 focus:ring focus:outline-none focus:z-10 relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-white border border-gray-300">
                        <span class="sr-only">Next</span>
                        <!-- Heroicon name: solid/chevron-right -->
                        <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                        </svg>
                    </Link>
                </nav>
            </div>
        </div>
    </div>
</template>

<script>
import { defineComponent } from 'vue'
import { Link } from '@inertiajs/inertia-vue3'

export default defineComponent({
    components: {Link},
    props: {
        pagination: Object,

    },
})
</script>
