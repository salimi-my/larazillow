<template>
  <form :action="route('realtor.listing.image.store', { listing: listing.id })" method="POST">
    <input type="file" multiple name="files" />
    <button type="submit">Send</button>
  </form>
</template>

<script setup>
defineProps(
  { listing: Object },
)
</script>