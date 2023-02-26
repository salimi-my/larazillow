<template>
  <Box>
    <template #header>Upload New Images</template>
    <form @submit.prevent="upload" enctype="multipart/form-data">
      <section class="flex items-start gap-2 my-4">
        <div class="flex flex-col">
          <input
            class="border rounded-md file:px-4 file:py-2 border-gray-200 dark:border-gray-700 file:text-gray-700 file:dark:text-gray-400 file:border-0 file:bg-gray-100 file:dark:bg-gray-800 file:font-medium file:hover:bg-gray-200 file:dark:hover:bg-gray-700 file:hover:cursor-pointer file:mr-4"
            type="file" multiple @input="addFiles" />
          <div v-if="form.progress" class="w-full bg-neutral-200 dark:bg-neutral-600 rounded-lg mt-4">
            <div class="bg-indigo-600 p-0.5 text-center text-xs font-medium leading-none text-white rounded-lg"
              :style="{ width: form.progress.percentage + '%' }">
              {{ form.progress.percentage }}%
            </div>
          </div>
        </div>
        <button type="submit" class="btn-outline disabled:opacity-25 disabled:cursor-not-allowed"
          :disabled="!canUpload">Upload</button>
        <button type="reset" @click="reset" class="btn-outline">Reset</button>
      </section>
    </form>
  </Box>

  <Box v-if="listing.images.length" class="mt-4">
    <template #header>Current Listing Images</template>
    <section class="mt-4 grid grid-cols-3 gap-4">
      <div v-for="image in listing.images" :key="image.id" class="flex flex-col justify-between">
        <img :src="image.src" class="rounded-md object-cover h-full" />
        <Link :href="route('realtor.listing.image.destroy', { listing: props.listing.id, image: image.id })" method="delete"
          as="button" class="mt-2 btn-outline text-xs">Delete</Link>
      </div>
    </section>
  </Box>
</template>

<script setup>
import Box from '@/Components/UI/Box.vue'
import { Link, useForm } from '@inertiajs/vue3'
import { computed } from 'vue'

const props = defineProps(
  { listing: Object },
)

const form = useForm({
  images: [],
})

const canUpload = computed(() => form.images.length)

const upload = () => {
  form.post(
    route('realtor.listing.image.store', { listing: props.listing.id }),
    { onSuccess: () => form.reset('images') },
  )
}

const addFiles = (e) => {
  for (const image of e.target.files) {
    form.images.push(image)
  }
}

const reset = () => form.reset('images')
</script>