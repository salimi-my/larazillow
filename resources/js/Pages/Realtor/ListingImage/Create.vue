<template>
  <Box>
    <template #header>Upload New Images</template>
    <form @submit.prevent="upload" enctype="multipart/form-data">
      <section class="flex items-center gap-2 my-4">
        <input
          class="border rounded-md file:px-4 file:py-2 border-gray-200 dark:border-gray-700 file:text-gray-700 file:dark:text-gray-400 file:border-0 file:bg-gray-100 file:dark:bg-gray-800 file:font-medium file:hover:bg-gray-200 file:dark:hover:bg-gray-700 file:hover:cursor-pointer file:mr-4"
          type="file" multiple @input="addFiles" />
        <button type="submit" class="btn-outline disabled:opacity-25 disabled:cursor-not-allowed"
          :disabled="!canUpload">Upload</button>
        <button type="reset" @click="reset" class="btn-outline">Reset</button>
      </section>
    </form>
  </Box>
</template>

<script setup>
import Box from '@/Components/UI/Box.vue'
import { useForm } from '@inertiajs/vue3'
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