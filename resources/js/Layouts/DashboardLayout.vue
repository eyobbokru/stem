<template>
  <div class="flex h-screen bg-gray-200 font-roboto">
    <Sidebar />

    <div class="flex-1 flex flex-col overflow-hidden">
      <Header />

      <header class="bg-white shadow" v-if="$slots.header">
        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
          <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <slot name="header"></slot>
          </h2>
        </div>
      </header>

      <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
        <div class="container mx-auto px-6 py-8">
          <jet-banner />
          <slot />
        </div>
      </main>
    </div>
  </div>
</template>

<script setup >
import Sidebar from "@/Components/Sidebar.vue";
import Header from "@/Components/Header.vue";
import JetBanner from "@/Jetstream/Banner.vue";
</script>
