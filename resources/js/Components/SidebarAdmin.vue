<template>
  <div class="flex">
    <!-- Backdrop -->
    <div
      :class="isOpen ? 'block' : 'hidden'"
      @click="isOpen = false"
      class="
        fixed
        inset-0
        z-20
        transition-opacity
        bg-black
        opacity-50
        lg:hidden
      "
    ></div>
    <!-- End Backdrop -->

    <div
      :class="isOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
      class="
        fixed
        inset-y-0
        left-0
        z-30
        w-64
        overflow-y-auto
        transition
        duration-300
        transform
        bg-gray-900
        lg:translate-x-0 lg:static lg:inset-0
      "
    >
      <div class="flex items-center justify-center mt-8">
        <div class="flex items-center">
          <svg
            class="w-12 h-12"
            viewBox="0 0 512 512"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M364.61 390.213C304.625 450.196 207.37 450.196 147.386 390.213C117.394 360.22 102.398 320.911 102.398 281.6C102.398 242.291 117.394 202.981 147.386 172.989C147.386 230.4 153.6 281.6 230.4 307.2C230.4 256 256 102.4 294.4 76.7999C320 128 334.618 142.997 364.608 172.989C394.601 202.981 409.597 242.291 409.597 281.6C409.597 320.911 394.601 360.22 364.61 390.213Z"
              fill="#4C51BF"
              stroke="#4C51BF"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
            <path
              d="M201.694 387.105C231.686 417.098 280.312 417.098 310.305 387.105C325.301 372.109 332.8 352.456 332.8 332.8C332.8 313.144 325.301 293.491 310.305 278.495C295.309 263.498 288 256 275.2 230.4C256 243.2 243.201 320 243.201 345.6C201.694 345.6 179.2 332.8 179.2 332.8C179.2 352.456 186.698 372.109 201.694 387.105Z"
              fill="white"
            />
          </svg>

          <span class="mx-2 text-2xl font-semibold text-white">STEM</span>
        </div>
      </div>

      <nav class="mt-10">
        <Link
          class="flex items-center px-6 py-2 mt-4 duration-200 border-l-4"
          :class="[$page.url === '/dashboard' ? activeClass : inactiveClass]"
          :href="route('dashboard')"
        >
          <svg
            class="w-5 h-5"
            viewBox="0 0 20 20"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M2 10C2 5.58172 5.58172 2 10 2V10H18C18 14.4183 14.4183 18 10 18C5.58172 18 2 14.4183 2 10Z"
              fill="currentColor"
            />
            <path
              d="M12 2.25195C14.8113 2.97552 17.0245 5.18877 17.748 8.00004H12V2.25195Z"
              fill="currentColor"
            />
          </svg>

          <span class="mx-4">Dashboard</span>
        </Link>

        <Link
          class="flex items-center px-6 py-2 mt-4 duration-200 border-l-4"
          :class="[
            $page.url.startsWith('/admin/academicSession')
              ? activeClass
              : inactiveClass,
          ]"
          :href="route('admin.academicSession.index')"
        >
          <img
            src="/images/degre.svg"
            alt="degree"
            class="w-5 h-5"
            fill="currentColor"
          />

          <span class="mx-4">Academic Session</span>
        </Link>

        <Link
          class="flex items-center px-6 py-2 mt-4 duration-200 border-l-4"
          :class="[
            $page.url.startsWith('/admin/student')
              ? activeClass
              : inactiveClass,
          ]"
          :href="route('admin.student.index')"
        >
          <img
            src="/images/student.svg"
            alt="lab"
            class="w-5 h-5"
            fill="currentColor"
          />

          <span class="mx-4">Student</span>
        </Link>
      </nav>
    </div>
  </div>
</template>
  
  <script setup lang="ts">
import { ref } from "vue";
import { useSidebar } from "../hooks/useSidebar";
import { Link } from "@inertiajs/inertia-vue3";

const { isOpen } = useSidebar();
const activeClass = ref(
  "bg-gray-600 bg-opacity-25 text-gray-100 border-gray-100"
);
const inactiveClass = ref(
  "border-gray-900 text-gray-500 hover:bg-white-100 hover:bg-opacity-25 hover:text-gray-100 "
);
</script>
  