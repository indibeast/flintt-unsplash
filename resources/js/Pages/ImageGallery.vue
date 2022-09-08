<template>
    <layout>
        <div class="mx-auto max-w-7xl px-4 pt-8 sm:px-6 lg:px-8">
            <div v-if="images?.items && images.items.length > 0">
                <ul role="list" class="columns-4 gap-8">

                    <li class="mb-10" v-for="image in images.items">
                        <div class="group aspect-w-10 aspect-auto block w-full overflow-hidden rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                            <img :src="image.url" alt="" class="pointer-events-none object-cover group-hover:opacity-75">
                        </div>
                    </li>

                </ul>
                <PaginationLinks :pagination="images" class="mt-6 mb-10"></PaginationLinks>
            </div>
            <div class="text-center" v-else>

                <h3 class="mt-2 text-sm font-medium text-gray-900">No Images</h3>

            </div>
        </div>

    </layout>

</template>

<script>
import Layout from '@/Layouts/AppLayout.vue'
import PaginationLinks from "@/Shared/PaginationLinks.vue"

export default {
    components: { Layout, PaginationLinks },
    props: {
        images: Object,
    },
    mounted() {
        console.log(this.images)
    }

}
</script>
