<template>
  <DashboardLayout title="edit course">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Edit Course
      </h2>
    </template>

    <div class="py-2">
      <div class="max-w-7xl mx-auto">
        <section class="container mx-auto p-6 font-mono">
          <div class="w-full flex mb-4 p-2">
            <Link
              :href="route('admin.course.index')"
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
                    <jet-label
                      for="tolecperweek"
                      value="Total Lecture Hours/Per Week"
                    />
                  </div>
                  <jet-input
                    id="tolecperweek"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.totalLecPerWeek"
                    autofocus
                    required
                  />
                  <div
                    class="text-sm text-red-400"
                    v-if="form.errors.totalLecPerWeek"
                  >
                    {{ form.errors.totalLecPerWeek }}
                  </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                  <div class="inline-block w-1/3">
                    <jet-label
                      for="tolabperweek"
                      value="Total Lab Hours/Per Week"
                    />
                  </div>
                  <jet-input
                    id="tolabperweek"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.totalLabPerWeek"
                    autofocus
                    required
                  />
                  <div
                    class="text-sm text-red-400"
                    v-if="form.errors.totalLabPerWeek"
                  >
                    {{ form.errors.totalLabPerWeek }}
                  </div>
                </div>

                <div class="md:flex md:items-center mb-6">
                  <div class="inline-block w-1/3">
                    <jet-label for="ty" value="Responsible Lecturer" />
                  </div>
                  <select
                    id="ty"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.responsible_lec_id"
                    required
                  >
                    <option
                      v-for="(lecturer, index) of lecturers"
                      :key="index"
                      :value="lecturer.id"
                    >
                      {{ lecturer.name }} {{ lecturer.fname }}
                    </option>
                  </select>
                  <div
                    class="text-sm text-red-400"
                    v-if="form.errors.responsible_lec_id"
                  >
                    {{ form.errors.responsible_lec_id }}
                  </div>
                </div>
                <div class="md:flex md:items-center mb-6">
                  <div class="inline-block w-1/3">
                    <jet-label for="ty" value="Responsible Lab Assistance" />
                  </div>
                  <select
                    id="ty"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.responsible_lab_id"
                    required
                  >
                    <option
                      v-for="(labAssistance, index) of labAssistances"
                      :key="index"
                      :value="labAssistance.id"
                    >
                      {{ labAssistance.name }} {{ labAssistance.fname }}
                    </option>
                  </select>
                  <div
                    class="text-sm text-red-400"
                    v-if="form.errors.responsible_lab_id"
                  >
                    {{ form.errors.responsible_lab_id }}
                  </div>
                </div>

                <div class="flex mt-4">
                  <jet-button
                    class="mx-auto w-20 items-center"
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
import { ref, watch } from "vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetCheckbox from "@/Jetstream/Checkbox.vue";

const props = defineProps({
  course: Object,
  lecturers: Object,
  labAssistances: Object,
});

const form = useForm({
  name: props.course.name,
  totalLecPerWeek: props.course.totalLecPerWeek,
  totalLabPerWeek: props.course.totalLabPerWeek,
  responsible_lec_id: props.course.responsible_lec_id,
  responsible_lab_id: props.course.responsible_lab_id,
});

function storeParam() {
  form.put("/admin/course/" + props.course.id);
}
</script>
