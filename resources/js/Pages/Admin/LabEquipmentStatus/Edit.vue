<template>
  <DashboardLayout title="edit grade">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Edit Equipment Status
      </h2>
    </template>

    <div class="py-2">
      <div class="max-w-7xl mx-auto">
        <section class="container mx-auto p-6 font-mono">
          <div class="w-full flex mb-4 p-2">
            <Link
              :href="route('admin.equipmentStatus.index')"
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
                  v-model="labEquipment.equipment.name"
                  autofocus
                  autocomplete="title"
                  disabled
                />
                <br />
                <section class="container mx-auto p-2 font-serif">
                  <div>
                    <div class="mt-1 block w-full mb-3">
                      <div>
                        <div>
                          <jet-label for="type" value="Type" />
                          <select
                            id="department"
                            class="mt-1 block w-full"
                            v-model="form.type"
                            required
                          >
                            <option>decrease</option>
                            <option>increase</option>
                          </select>
                          <div
                            class="text-sm text-red-400"
                            v-if="form.errors.status"
                          >
                            {{ form.errors.status }}
                          </div>

                          <label class="text-gray-700" for="username">
                            Report Lab equipment status</label
                          >

                          <textarea
                            v-model="form.description"
                            rows="5"
                            cols="155"
                            class="mt- block w-full"
                          />
                        </div>
                        <div
                          class="text-sm text-red-400"
                          v-if="form.errors.description"
                        >
                          {{ form.errors.description }}
                        </div>

                        <jet-label for="type" value="Status" />
                        <select
                          id="department"
                          class="mt-1 block w-full"
                          v-model="form.status"
                          required
                        >
                          <option>broken</option>
                          <option>requires maintenance</option>
                          <option>finished</option>
                          <option>new equipment</option>
                        </select>
                        <div
                          class="text-sm text-red-400"
                          v-if="form.errors.status"
                        >
                          {{ form.errors.status }}
                        </div>

                        <jet-label
                          for="address"
                          :value="'Number; ' + labEquipment.number"
                        />
                        <jet-input
                          id="address"
                          type="number"
                          class="mt-1 block w-full"
                          v-model="form.number"
                          autofocus
                          autocomplete="title"
                          required
                          :max="labEquipment.number"
                          min="0"
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
                          class="ml-4 mb-4"
                          :class="{ 'opacity-25': form.processing }"
                          :disabled="form.processing"
                        >
                          ADD
                        </jet-button>
                      </div>

                      <hr />

                      <template
                        v-for="(EquStatus, index) in labEquipment.report_status
                          .slice()
                          .reverse()"
                        :key="index"
                      >
                        <div class="mt-5">
                          <div>
                            <label class="text-gray-700" for="username">
                              Report Lab equipment status
                              {{ formatDate(EquStatus.created_at) }}</label
                            >

                            <textarea
                              v-model="EquStatus.description"
                              rows="5"
                              cols="155"
                              class="mt- block w-full"
                              disabled
                            />
                          </div>

                          <jet-label for="type" value="Status" />
                          <select
                            id="department"
                            class="mt-1 block w-full"
                            v-model="EquStatus.status"
                            required
                            disabled
                          >
                            <option :selected="EquStatus.status == 'broken'">
                              broken
                            </option>
                            <option
                              :selected="
                                EquStatus.status == 'requires maintenance'
                              "
                            >
                              requires maintenance
                            </option>
                            <option :selected="EquStatus.status == 'finished'">
                              finished
                            </option>
                          </select>

                          <jet-label for="address" value="Number" />
                          <jet-input
                            id="address"
                            type="text"
                            class="mt-1 block w-full"
                            v-model="EquStatus.number"
                            autofocus
                            autocomplete="title"
                            required
                            disabled
                          />
                        </div>
                      </template>
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
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetLabel from "@/Jetstream/Label.vue";

const props = defineProps({
  labEquipment: Object,
});
function formatDate(dateString) {
  const date = new Date(dateString);
  return date.toLocaleDateString("en-GB");
}

const form = useForm({
  laboratory_equipment_id: props.labEquipment.id,
  description: "",
  status: "",
  number: "",
  type: "",
});

function storeParam() {
  form.put("/admin/equipmentStatus/" + props.labEquipment.id);
}
</script>
