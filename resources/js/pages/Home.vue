<template>
    <h1 class="font-bold text-2xl mb-5">Feed</h1>
    <ul
        role="list"
        class="grid grid-cols-2 gap-x-4 gap-y-8 sm:grid-cols-3 sm:gap-x-6 lg:grid-cols-3 xl:gap-x-8 mx-16"
    >
        <li v-for="image in images" :key="image.id" class="relative">
            <div
                class="group aspect-h-7 aspect-w-10 block w-full overflow-hidden rounded-lg bg-gray-100 focus-within:ring-2 focus-within:ring-indigo-500 focus-within:ring-offset-2 focus-within:ring-offset-gray-100"
            >
                <img
                    :src="image.photo_url"
                    alt=""
                    class="pointer-events-none object-cover group-hover:opacity-75"
                />
                <button
                    type="button"
                    class="absolute inset-0 focus:outline-none"
                    @click="toDetailPage(image)"
                ></button>
            </div>
        </li>
    </ul>
</template>

<script setup>
import { useImageStore } from "../stores/image";
import { onMounted, computed } from "vue";
import { storeToRefs } from "pinia";
import { useRouter } from "vue-router";

const imageStore = useImageStore();
const router = useRouter();
const { images } = storeToRefs(imageStore);

onMounted(() => {
    imageStore.getImages();
});

const toDetailPage = (image) => {
    console.log(image);
    router.push({ name: "image-detail", params: { image: image.id } });
};
</script>
<style></style>
