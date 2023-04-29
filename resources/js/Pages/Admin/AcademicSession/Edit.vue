<template>
  <DashboardLayout title="edit academicSession">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Edit Academic Session
      </h2>
    </template>

    <div class="py-2">
      <div class="max-w-7xl mx-auto">
        <section class="container mx-auto p-6 font-mono">
          <div class="w-full flex mb-4 p-2">
            <Link
              :href="route('admin.academicSession.index')"
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
                  autocomplete="title"
                  required
                />
                <div class="text-sm text-red-400" v-if="form.errors.name">
                  {{ form.errors.name }}
                </div>
                <jet-label for="acYear" value="Academic Year" />
                <jet-input
                  id="acYear"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.academicYear"
                  autocomplete="title"
                  required
                />
                <div
                  class="text-sm text-red-400"
                  v-if="form.errors.academicYear"
                >
                  {{ form.errors.academicYear }}
                </div>
                <jet-label for="acYear" value="Starting Date" />
                <Calendar
                  id="icon"
                  class="mt-1 block w-full"
                  v-model="form.startingDate"
                  :showIcon="true"
                  :required="true"
                />
                <div
                  class="text-sm text-red-400"
                  v-if="form.errors.startingDate"
                >
                  {{ form.errors.startingDate }}
                </div>

                <jet-label for="endingYear" value="Ending Date" />
                <Calendar
                  id="endingYear"
                  class="mt-1 block w-full"
                  v-model="form.endingDate"
                  :showIcon="true"
                />
                <div class="text-sm text-red-400" v-if="form.errors.endingDate">
                  {{ form.errors.endingDate }}
                </div>
                <jet-label for="ty" value="Type" />
                <Dropdown
                  v-model="form.type"
                  :options="TypeChoice"
                  class="mt-1 block w-full"
                  optionLabel="name"
                  placeholder="Select a Type"
                  required
                />
                <div class="text-sm text-red-400" v-if="form.errors.type">
                  {{ form.errors.type }}
                </div>
                <jet-label for="group" value="Courses" />
                <MultiSelect
                  class="mt-1 block w-full"
                  v-model="form.selectCourse"
                  :options="courses"
                  optionLabel="name"
                  placeholder="Select Courses"
                  display="chip"
                />
                <div
                  class="text-sm text-red-400"
                  v-if="form.errors.selectCourse"
                >
                  {{ form.errors.selectCourse }}
                </div>

                <div class="flex items-center mt-4">
                  <jet-button
                    class="ml-4"
                    :class="{ 'opacity-25': form.processing }"
                    :disabled="form.processing"
                  >
                    Update
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
import { ref } from "vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import Calendar from "primevue/calendar";
import Dropdown from "primevue/dropdown";
import MultiSelect from "primevue/multiselect";

const props = defineProps({
  academicSession: Object,
  courses: Object,
});

const form = useForm({
  name: props.academicSession.name,
  academicYear: props.academicSession.academicYear,
  startingDate: props.academicSession.startingDate,
  endingDate: props.academicSession.endingDate,
  type: props.academicSession.type,
  selectCourse: props.academicSession.courses,
  active: props.academicSession.active,
});
const TypeChoice = ref([{ name: "Daily" }, { name: "weekly" }]);

function storeParam() {
  form.put("/admin/academicSession/" + props.academicSession.id);
}
</script>
