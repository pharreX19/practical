<template>
    <h1 class="font-bold text-2xl mb-5">Upload Image</h1>
    <div>
        <input
            type="file"
            name="image"
            id="image"
            accept="image/*"
            @change="onFileChange"
            hidden="true"
            ref="fileInput"
        />
        <form
            @submit.prevent="upload"
            class="flex flex-col justify-center items-center space-y-5"
        >
            <div
                class="bg-white flex flex-col space-y-3 justify-center items-center p-52 border border-gray-200 rounded-md"
            >
                <div v-if="imageUrl">
                    <img
                        :src="imageUrl"
                        alt="Selected Image"
                        style="max-width: 300px; max-height: 300px"
                    />
                </div>
                <button
                    type="button"
                    @click="fileInput.click()"
                    class="w-56 bg-gray-200 text-gray-600 text-sm py-3 px-12 rounded-full"
                >
                    Upload Image
                </button>
            </div>
            <div
                class="bg-white flex flex-col justify-center items-start mt-10 p-10 border border-gray-200 rounded-md w-full"
            >
                <label for="description" class="text-gray-500 pb-1"
                    >Description</label
                >
                <textarea
                    class="w-full text-sm text-gray-300 p-3 border border-gray-200 rounded-md"
                    type="text"
                    name="description"
                    id="description"
                    v-model="form.description"
                    roes="5"
                    placeholder="Write something about the photo"
                />
            </div>
            <div class="flex flex-col justify-center items-center">
                <p
                    class="text-red-600 text-sm mb-3"
                    v-if="Object.keys(imageStore.errors).length > 0"
                >
                    {{ imageStore.errors.photo[0] }}
                </p>

                <button
                    type="submit"
                    class="w-56 bg-orange-300 text-white text-sm py-3 px-12 rounded-full"
                    @click="deleteImage"
                >
                    Create
                </button>
            </div>
        </form>
    </div>
</template>

<script setup>
import { reactive, ref } from "vue";
import { useImageStore } from "../stores/image";

const imageStore = useImageStore();
const fileInput = ref(null);
const imageUrl = ref(null);

const form = reactive({
    photo: "",
    description: "",
});

const onFileChange = (event) => {
    form.photo = event.target.files[0];
    imageUrl.value = URL.createObjectURL(form.photo);
};

const upload = () => {
    const formData = new FormData();
    formData.append("description", form.description);
    formData.append("photo", form.photo);
    imageStore.createImage(formData);
};
</script>

<style lang="scss" scoped></style>
