<template>
  <DashboardLayout title="edit grade">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Edit Grade
      </h2>
    </template>

    <div class="py-2">
      <div class="max-w-7xl mx-auto">
        <section class="container mx-auto p-6 font-mono">
          <div class="w-full flex mb-4 p-2">
            <Link
              :href="route('admin.labEquipment.index')"
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

                <jet-label for="type" value="Type" />
                <select
                  id="department"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.type"
                  required
                >
                  <option>Fixed</option>
                  <option>Consumable</option>
                </select>
                <div class="text-sm text-red-400" v-if="form.errors.type">
                  {{ form.errors.type }}
                </div>

                <jet-label for="address" value="Quantity" />
                <jet-input
                  id="address"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.quantity"
                  autofocus
                  autocomplete="title"
                  required
                />
                <div class="text-sm text-red-400" v-if="form.errors.quantity">
                  {{ form.errors.si_unit }}
                </div>

                <jet-label for="address" value="SI Unit" />
                <jet-input
                  id="address"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.si_unit"
                  autofocus
                  autocomplete="title"
                  required
                />
                <div class="text-sm text-red-400" v-if="form.errors.si_unit">
                  {{ form.errors.si_unit }}
                </div>

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
import JetCheckbox from "@/Jetstream/Checkbox.vue";

const props = defineProps({
  labEquipment: Object,
});

const form = useForm({
  name: props.labEquipment.name,
  type: props.labEquipment.type,
  quantity: props.labEquipment.quantity,
  si_unit: props.labEquipment.si_unit,
});

function storeParam() {
  form.put("/admin/labEquipment/" + props.labEquipment.id);
}
</script>
