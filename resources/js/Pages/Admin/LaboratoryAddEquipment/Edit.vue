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
                <div class="text-sm text-red-400" v-if="form.errors.name">
                  {{ form.errors.name }}
                </div>

                <section class="container mx-auto p-2 font-serif">
                  <div>
                    <div class="mt-1 block w-full mb-3">
                      <div>
                        <div>
                          <label class="text-gray-700" for="grade"
                            >Equipment</label
                          >
                          <select
                            class="w-full mt-2 border-gray-200 rounded-md focus:border-indigo-600 focus:ring focus:ring-opacity-40 focus:ring-indigo-500"
                            v-model="form.lab_equipment_id"
                          >
                            <option
                              v-for="(equipment, index) of equipments"
                              :key="index"
                              :value="equipment.id"
                            >
                              {{ equipment.name }}
                            </option>
                          </select>
                          <div
                            class="text-sm text-red-400"
                            v-if="form.errors.lab_equipment_id"
                          >
                            {{ form.errors.lab_equipment_id }}
                          </div>
                        </div>
                      </div>

                      <div>
                        <jet-label for="title" value="Quantity" />
                        <jet-input
                          id="title"
                          type="text"
                          class="mt-1 block w-full"
                          v-model="form.quantity"
                          autofocus
                          autocomplete="title"
                          required
                        />
                        <div
                          class="text-sm text-red-400"
                          v-if="form.errors.quantity"
                        >
                          {{ form.errors.quantity }}
                        </div>
                      </div>

                      <div>
                        <jet-label for="title" value="Number/Size" />
                        <jet-input
                          id="title"
                          type="number"
                          class="mt-1 block w-full"
                          v-model="form.number"
                          autofocus
                          autocomplete="title"
                          required
                        />
                        <div
                          class="text-sm text-red-400"
                          v-if="form.errors.number"
                        >
                          {{ form.errors.number }}
                        </div>
                      </div>
                      <br />
                      <div class="flex items-center mt-4">
                        <jet-button
                          class="ml-4"
                          :class="{ 'opacity-25': form.processing }"
                          :disabled="form.processing"
                        >
                          ADD
                        </jet-button>
                      </div>
                      <br />
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
  students: Object,
  lab: Object,
  equipments: Object,
});

const form = useForm({
  lab_id: props.lab.id,
  lab_equipment_id: "",
  quantity: "",
  number: "",
  // stage: props.incubation.stage,
});

function storeParam() {
  // form.post("/admin/project");
  // form.put("/admin/projectProgress/" + props.project.id);

  Inertia.post(`/admin/addEquipment/${props.lab.id}`, {
    _method: "put",
    // stage: form.stage,
    lab_id: form.lab_id,
    lab_equipment_id: form.lab_equipment_id,
    quantity: form.quantity,
    number: form.number,
  });
}
</script>
      