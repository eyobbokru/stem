<template>
  <DashboardLayout title="create incubation">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Create incubation
      </h2>
    </template>

    <div class="py-2">
      <div class="max-w-7xl mx-auto">
        <section class="container mx-auto p-6 font-mono">
          <div class="w-full flex mb-4 p-2">
            <Link
              :href="route('admin.incubation.index')"
              class="bg-green-500 hover:bg-green-700 text-white px-4 py-2 rounded-lg"
            >
              Back
            </Link>
          </div>

          <div
            class="w-full mb-8 p-6 overflow-hidden bg-white rounded-lg shadow-lg"
          >
            <form @submit.prevent="storeParam">
              <div>
                <jet-label for="title" value="Name" />
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
                <jet-label for="title" value="Description" class="mt-2" />
                <Textarea
                  v-model="form.description"
                  rows="5"
                  cols="155"
                  class="mt- block w-full"
                />

                <jet-label for="title" value="" class="mt-2" />

                <section class="container mx-auto p-2 font-serif">
                  <jet-label
                    for="stakeholder"
                    value="Students Info"
                    class="mt-2"
                  />

                  <div
                    class="mt-1 block w-full mb-4 p-6 bg-gray-50 rounded-lg shadow-lg"
                    v-for="(owner, index) in form.owners"
                    :key="index"
                  >
                    <div class="grid grid-cols-2 gap-6 mt-4 sm:grid-cols-4">
                      <div>
                        <label class="text-gray-700 inline" for="fund"
                          >Name</label
                        >
                        <input
                          class="w-full mt-2 border-gray-200 rounded-md ring focus:ring focus:ring-opacity-40"
                          type="text"
                          v-model="owner.name"
                          required
                        />
                      </div>
                      <div>
                        <label class="text-gray-700" for="fund"
                          >Middle Name</label
                        >
                        <input
                          class="w-full mt-2 border-gray-200 rounded-md ring focus:ring focus:ring-opacity-40"
                          type="text"
                          v-model="owner.middle_name"
                          required
                        />
                      </div>

                      <div>
                        <label class="text-gray-700" for="fund"
                          >Last Name</label
                        >
                        <input
                          class="w-full mt-2 border-gray-200 rounded-md ring focus:ring focus:ring-opacity-40"
                          type="text"
                          v-model="owner.last_name"
                          required
                        />
                      </div>
                    </div>

                    <div class="grid grid-cols-2 gap-6 mt-4 sm:grid-cols-4">
                      <div>
                        <label class="text-gray-700 inline" for="fund"
                          >Phone</label
                        >
                        <input
                          class="w-full mt-2 border-gray-200 rounded-md ring focus:ring focus:ring-opacity-40"
                          type="text"
                          v-model="owner.phone"
                          required
                        />
                      </div>
                      <div>
                        <label class="text-gray-700" for="fund">email</label>
                        <input
                          class="w-full mt-2 border-gray-200 rounded-md ring focus:ring focus:ring-opacity-40"
                          type="email"
                          v-model="owner.email"
                          required
                        />
                      </div>
                    </div>
                    <div class="mt-9 flex justify-end">
                      <div class="">
                        <button
                          class="px-3 py-1 text-sm text-white bg-indigo-500 rounded-md hover:bg-indigo-500 focus:outline-none mr-3"
                          v-on:click="addStakeholder"
                          type="button"
                        >
                          Add
                        </button>
                        <button
                          class="px-3 py-1 text-sm text-white bg-indigo-500 rounded-md hover:bg-indigo-500 focus:outline-none"
                          v-on:click="removeStakeholder(index)"
                          type="button"
                        >
                          Remove
                        </button>
                      </div>
                    </div>
                  </div>
                </section>

                <div class="flex items-center mt-4">
                  <jet-button
                    class="ml-4"
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

import Textarea from "primevue/textarea";
import MultiSelect from "primevue/multiselect";

const props = defineProps({});

const form = useForm({
  name: "",
  description: "",

  owners: [
    {
      name: "",
      middle_name: "",
      last_name: "",
      phone: "",
      email: "",
    },
  ],
});

function storeParam() {
  form.post("/admin/incubation");
}

function addStakeholder() {
  form.owners.push({
    name: "",
    middle_name: "",
    last_name: "",
    phone: "",
    email: "",
  });
}
function removeStakeholder(index) {
  form.owners.splice(index, 1);
}
</script>
  