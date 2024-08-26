<template>
    <div
        class="group aspect-h-7 aspect-w-10 block w-96 overflow-hidden rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100"
    >
        <img
            :src="fullImageUrl"
            alt=""
            class="pointer-events-none object-cover group-hover:opacity-75"
        />
    </div>
</template>
<script setup>
import { computed } from "vue";

const props = defineProps({
    image: {
        type: Object,
        required: true,
    },
});

const fullImageUrl = computed(() => {
    return `http://localhost:8000/storage/${props.image.photo_url}`;
});
</script>
<style></style>
