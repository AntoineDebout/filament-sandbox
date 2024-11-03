<template>
  <navbar />

  <div class="h-full bg-background font-sans text-text-primary">
    <Head title="TV & Show" />

    <main>

      <div class="container min-h-screen mx-auto pt-24 pb-4">
        <slot></slot>
      </div>

    </main>
  </div>

  <app-footer />
</template>

<script>
import { Head } from "@inertiajs/inertia-vue3";
import Navbar from "../partials/navbar.vue";
import AppFooter from "../partials/footer.vue";
export default {
components: {
  Navbar,
  Head,
  AppFooter,
}

}
</script>