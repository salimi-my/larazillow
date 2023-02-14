<template>
  <form @submit.prevent="register">
    <div class="w-1/2 mx-auto">
      <div>
        <label for="name">Your Name</label>
        <input type="text" v-model="form.name" id="name" class="input" />
        <div class="input-error" v-if="form.errors.name">{{ form.errors.name }}</div>
      </div>
      <div class="mt-4">
        <label for="email">E-mail</label>
        <input type="text" v-model="form.email" id="email" class="input" />
        <div class="input-error" v-if="form.errors.email">{{ form.errors.email }}</div>
      </div>
      <div class="mt-4">
        <label for="password">Password</label>
        <input type="password" v-model="form.password" id="password" class="input" />
        <div class="input-error" v-if="form.errors.password">{{ form.errors.password }}</div>
      </div>
      <div class="mt-4">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" v-model="form.password_confirmation" id="password_confirmation" class="input" />
        <div class="input-error" v-if="form.errors.password">{{ form.errors.password }}</div>
      </div>
      <div class="mt-4">
        <button class="btn-primary w-full" type="submit">Create Account</button>
      </div>
    </div>
  </form>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  name: null,
  email: null,
  password: null,
  password_confirmation: null,
})

const register = () => form.post('')
</script>