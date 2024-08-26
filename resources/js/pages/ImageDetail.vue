<template>
    <h1 class="font-bold text-2xl mb-5">Image Single Page</h1>
    <AlertDialog
        v-if="confirmDialogVisible"
        :handleCancel="onCancel"
        :handleConfirm="onConfirm"
    />
    <div
        class="flex flex-col justify-center items-center space-y-10 w-3/5 relative"
    >
        <ImageContainer :image="image" />
        <div class="bg-white p-4">
            <p class="text-sm">
                Lorem ipsum dolor sit, amet consectetur adipisicing elit. Ab
                corrupti accusantium, magni quas sint explicabo dolore eum
                provident dolorem, quaerat nulla eos ratione voluptatem sed
                animi rerum temporibus? Commodi, dolore.
            </p>

            <div class="flex flex-row text-xs mt-6 text-gray-400">
                <p>12 August 2023</p>
                <p class="ml-10">{{ image.user?.name }}</p>
            </div>
        </div>

        <div class="flex flex-col justify-center items-center">
            <p
                class="text-red-600 text-sm mb-3"
                v-if="Object.keys(imageStore.errors).length > 0"
            >
                {{ imageStore.errors }}
            </p>

            <button
                class="w-56 bg-gray-200 text-red-600 text-sm py-3 px-12 rounded-full"
                @click="deleteImage"
            >
                Delete
            </button>
        </div>
    </div>
</template>
<script setup>
import { onMounted } from "vue";
import { useImageStore } from "../stores/image";
import { useRouter } from "vue-router";
import { storeToRefs } from "pinia";
import ImageContainer from "../components/ImageContainer.vue";
import { useAuthStore } from "../stores/auth";
import AlertDialog from "../components/AlertDialog.vue";
import { ref } from "vue";

const imageStore = useImageStore();
const authStore = useAuthStore();
const router = useRouter();
const { image } = storeToRefs(imageStore);
const confirmDialogVisible = ref(false);
const currentImage = router.currentRoute.value.params.image;

onMounted(() => {
    imageStore.getImage(currentImage);
});

const deleteImage = () => {
    confirmDialogVisible.value = true;
};

const onCancel = () => {
    console.log("hello world");
    confirmDialogVisible.value = false;
};

const onConfirm = () => {
    imageStore.deleteImage(currentImage);
    // if (imageStore.errors) {
    console.log(imageStore.errors);
    // }
    confirmDialogVisible.value = false;
};
</script>
<style></style>
