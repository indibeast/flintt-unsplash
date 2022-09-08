<template>
    <div>
        <div v-if="$page.props.flash.success && show" class="rounded-md bg-green-50 p-4">
            <div class="flex">
                <div class="ml-3">
                    <div class="mt-2 text-sm text-green-700">
                        <p>{{ $page.props.flash.success }}</p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default {
    data() {
        return {
            show: true,
        }
    },
    watch: {
        '$page.props.flash': {
            handler() {
                this.show = true
            },
            deep: true,
        },
    },
}
</script>
