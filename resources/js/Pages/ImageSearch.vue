<template>
    <layout>
        <div class="mx-auto max-w-lg">
            <div>

                <form action="#" class="mt-6 flex">
                    <input type="text" name="search" id="search" class="w-full rounded-md border-white px-5 py-3 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-indigo-700" placeholder="Search" v-model="search" autocomplete="off">
                    <button type="button" @click="submit" :disabled="searching" class="ml-4 flex-shrink-0 rounded-md border border-transparent bg-indigo-600 px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">Search</button>
                </form>
            </div>

        </div>
        <div class="mx-auto max-w-7xl px-4 pt-8 sm:px-6 lg:px-8">
           <FlashMessage/>
        </div>

        <div class="mx-auto max-w-7xl px-4 pt-8 sm:px-6 lg:px-8" v-if="images?.items && images.items.length > 0">
            <ul role="list" class="columns-4 gap-8">

                <li class="mb-10" v-for="(image, index) in images.items">
                    <div class="group aspect-w-10 aspect-auto block w-full overflow-hidden rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100">
                        <a href="#" @click="showImage(index)">
                         <img :src="image.smallUrl" alt="" class="pointer-events-none object-cover group-hover:opacity-75">
                        </a>
                    </div>
                </li>

            </ul>
            <PaginationLinks :pagination="images" class="mt-6 mb-10"></PaginationLinks>
        </div>

        <div class="text-center" v-if="!hasSearchParam || images?.items.length === 0">
            <h3 class="mt-2 text-sm font-medium text-gray-900">No Images</h3>
            <p class="mt-1 text-sm text-gray-500" v-if="!hasSearchParam">Please type something in search box.</p>
            <p class="mt-1 text-sm text-gray-500" v-if="hasSearchParam && images?.items?.length === 0">We are unable to find any images with that term.</p>
        </div>
        <div class="text-center" v-if="hasApiError">
            <p class="mt-1 text-sm text-gray-500" >There is something wrong with Unsplash API. Please try again later.</p>
        </div>
        <SlideOver>
            <div class="flex flex-col flex-auto p-6 md:p-8" v-if="selectedImage">
                <div class="mt-8 aspect-[9/6]">
                    <div class="flex items-center justify-center h-full border rounded-lg bg-gray-50 dark:bg-card">
                        <img :src="selectedImage.regularUrl" alt="" class="object-cover">
                    </div>
                </div>
                <div class="flex flex-col items-start mt-8">
                    <div class="text-xl font-medium">{{ selectedImage.description }}</div>
                </div>
                <div class="mt-8">
                    <h3 class="font-medium text-gray-900">Information</h3>
                    <dl class="mt-2 divide-y divide-gray-200 border-t border-b border-gray-200">
                        <div class="flex justify-between py-3 text-sm font-medium">
                            <dt class="text-gray-500">Uploaded by</dt>
                            <dd class="text-gray-900">{{ selectedImage.createdBy }}</dd>
                        </div>
                        <div class="flex justify-between py-3 text-sm font-medium">
                            <dt class="text-gray-500">Created</dt>
                            <dd class="text-gray-900">{{ selectedImage.createdAt }}</dd>
                        </div>
                    </dl>
                </div>
                <div class="flex">
                    <button type="button" @click=saveImage :disabled="selectedImage.isDownloaded || isDownloading" class="mt-4 flex-1 rounded-md border border-transparent bg-indigo-600 py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:bg-slate-50 disabled:text-slate-500 disabled:border-slate-200 disabled:shadow-none">
                        {{ downloadButtonText }}
                    </button>
                </div>
            </div>
        </SlideOver>
    </layout>

</template>

<script>
import Layout from '@/Layouts/AppLayout.vue'
import PaginationLinks from "@/Shared/PaginationLinks.vue"
import SlideOver from "@/Shared/SlideOver.vue"
import FlashMessage from "@/Shared/FlashMessage.vue"
export default {
    components: {SlideOver, Layout, PaginationLinks, FlashMessage },
    props: {
        images: Object,
        hasSearchParam: Boolean,
        hasApiError: Boolean,
    },
    data () {
        let params =  new URLSearchParams(window.location.search)

        return {
          searching:false,
          selectedImage: null,
          isDownloading: false,
          search: params.get("search") ? params.get('search') : '',
        }
    },
    computed: {
        downloadButtonText() {
            if (this.isDownloading) {
                return 'Downloading please wait...'
            }
            if (this.selectedImage.isDownloaded) {
                return 'Image already saved'
            }

            return 'Download'
        }
    },
    methods: {
        submit() {
            this.$inertia.visit(location.pathname, {
                data: {'search': this.search}
            })
        },
        showImage(index) {
            this.selectedImage = this.images.items[index]

            window.bus.emit('slideover')
        },
        saveImage() {
            this.isDownloading = true
            this.$inertia.post(route('image.download'), { id: this.selectedImage.id }, {
                onSuccess: () => {
                    window.bus.emit('slideoverClose')
                },
                onFinish: () => {
                    this.isDownloading = false
                }
            })
        }

    }
}
</script>
