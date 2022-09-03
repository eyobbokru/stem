<template>
  <DashboardLayout title="create teacher">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Create teacher
      </h2>
    </template>

    <div class="py-2">
      <div class="max-w-7xl mx-auto">
        <section class="container mx-auto p-6 font-mono">
          <div class="w-full flex mb-4 p-2">
            <Link
              :href="route('admin.teacher.index')"
              class="
                bg-green-500
                hover:bg-green-700
                text-white
                px-4
                py-2
                rounded-lg
              "
            >
              Back
            </Link>
          </div>

          <div
            class="
              w-full
              mb-8
              p-6
              overflow-hidden
              bg-white
              rounded-lg
              shadow-lg
            "
          >
            <form @submit.prevent="storeParam">
              <div>
                <div class="md:flex md:items-center mb-6">
                  <div class="inline-block w-1/3">
                    <jet-label for="title" value="Name" />
                  </div>
                  <jet-input
                    id="title"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.name"
                    autofocus
                    autocomplete="title"
                    required
                  />
                  <div class="text-sm text-red-400" v-if="form.errors.name">
                    {{ form.errors.name }}
                  </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                  <div class="inline-block w-1/3">
                    <jet-label for="fname" value="Father's Name" />
                  </div>
                  <jet-input
                    id="fname"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.fname"
                    autofocus
                    required
                  />
                  <div class="text-sm text-red-400" v-if="form.errors.name">
                    {{ form.errors.fname }}
                  </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                  <div class="inline-block w-1/3">
                    <jet-label for="ty" value="Type" />
                  </div>
                  <select
                    id="ty"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.type"
                    required
                  >
                    <option>Lecturer</option>
                    <option>Lab Assistance</option>
                  </select>
                  <div class="text-sm text-red-400" v-if="form.errors.type">
                    {{ form.errors.type }}
                  </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                  <div class="inline-block w-1/3">
                    <jet-label for="ty" value="Academic Rank" />
                  </div>
                  <select
                    id="ty"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.rank"
                    required
                  >
                    <option>ARA</option>
                    <option>SARA</option>
                    <option>CARA I</option>
                    <option>CARA I</option>
                    <option>Lecturer</option>
                    <option>Asso. Professor</option>
                    <option>Assis. Professor</option>
                    <option>Professor</option>
                  </select>
                  <div class="text-sm text-red-400" v-if="form.errors.rank">
                    {{ form.errors.rank }}
                  </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                  <div class="inline-block w-1/3">
                    <jet-label for="email" value="Email" />
                  </div>
                  <jet-input
                    id="email"
                    type="email"
                    class="mt-1 block w-full"
                    v-model="form.email"
                    autofocus
                    required
                  />
                  <div class="text-sm text-red-400" v-if="form.errors.email">
                    {{ form.errors.email }}
                  </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                  <div class="inline-block w-1/3">
                    <jet-label for="phone" value="Phone" />
                  </div>
                  <jet-input
                    id="phone"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.phone"
                    autofocus
                    required
                  />
                  <div class="text-sm text-red-400" v-if="form.errors.phone">
                    {{ form.errors.phone }}
                  </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                  <div class="inline-block w-1/3">
                    <jet-label for="dept" value="Department" />
                  </div>
                  <jet-input
                    id="dept"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.department"
                    autofocus
                    required
                  />
                  <div
                    class="text-sm text-red-400"
                    v-if="form.errors.department"
                  >
                    {{ form.errors.department }}
                  </div>
                </div>
                <div class="flex mt-4">
                  <jet-button
                    class="mx-auto w-20 items-center"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                  >
                    ADD
                  </jet-button>
                </div>
              </div>
            </form>
          </div>
        </section>
      </div>
    </div>
  </DashboardLayout>
</template>

<script setup>
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import { Link, useForm } from "@inertiajs/inertia-vue3";
import { ref, watch } from "vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetLabel from "@/Jetstream/Label.vue";

const props = defineProps({});

const form = useForm({
  name: "",
  fname: "",
  email: "",
  phone: "",
  type: "",
  department: "",
  rank: "",
});

function storeParam() {
  form.post("/admin/teacher");
}
</script>
