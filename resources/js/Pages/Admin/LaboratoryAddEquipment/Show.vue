<template>
  <DashboardLayout title="create project">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        add equipment to labs
      </h2>
    </template>

    <div class="py-2">
      <div class="max-w-7xl mx-auto">
        <section class="container mx-auto p-6 font-mono">
          <div class="w-full flex mb-4 p-2">
            <Link
              :href="route('admin.addEquipment.index')"
              class="bg-green-500 hover:bg-green-700 text-white px-4 py-2 rounded-lg"
            >
              Back
            </Link>
          </div>

          <div
            class="w-full mb-10 p-6 overflow-hidden bg-white rounded-lg shadow-lg"
          >
            <form @submit.prevent="storeParam" enctype="multipart/form-data">
              <div>
                <jet-label for="title" value="Name" />
                <jet-input
                  id="title"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="lab.name"
                  autofocus
                  autocomplete="title"
                  required
                  disabled
                />

                <section class="container mx-auto p-2 font-serif">
                  <div>
                    <div class="w-full overflow-x-auto">
                      <table class="w-full">
                        <thead>
                          <tr
                            class="text-md font-semibold tracking-wide text-left text-gray-900 bg-gray-100 uppercase border-b border-gray-600"
                          >
                            <th class="px-4 py-3">ID</th>
                            <th class="px-4 py-3">Name</th>

                            <th class="px-4 py-3">quantity</th>
                            <th class="px-4 py-3">number/size</th>
                          </tr>
                        </thead>
                        <tbody class="bg-white">
                          <tr
                            v-for="lab in lab.equipments"
                            :key="lab.id"
                            class="text-gray-700"
                          >
                            <td class="px-4 py-3 border">{{ lab.id }}</td>
                            <td class="px-4 py-3 border">{{ lab.name }}</td>

                            <td class="px-4 py-3 text-sm border">
                              {{ lab.quantity }}
                            </td>
                            <td class="px-4 py-3 text-sm border">
                              {{ lab.number }}
                            </td>
                          </tr>
                        </tbody>
                      </table>
                      <div class="m-2 p-2">
                        <Pagination :links="lab.equipments.links" />
                      </div>
                    </div>
                  </div>
                </section>
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
import { Inertia } from "@inertiajs/inertia";
import { ref, watch } from "vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetLabel from "@/Jetstream/Label.vue";

import Textarea from "primevue/textarea";

const props = defineProps({
  lab: Object,
});
</script>
        