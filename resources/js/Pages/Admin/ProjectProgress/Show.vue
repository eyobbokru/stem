<template>
  <DashboardLayout title="create project">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        add project progress
      </h2>
    </template>

    <div class="py-2">
      <div class="max-w-7xl mx-auto">
        <section class="container mx-auto p-6 font-mono">
          <div class="w-full flex mb-4 p-2">
            <Link
              :href="route('admin.projectProgress.index')"
              class="bg-green-500 hover:bg-green-700 text-white px-4 py-2 rounded-lg"
            >
              Back
            </Link>
          </div>

          <div
            class="w-full mb-10 p-6 overflow-hidden bg-white rounded-lg shadow-lg"
          >
            <form @submit.prevent="storeParam">
              <div>
                <jet-label for="title" value="Name" />
                <jet-input
                  id="title"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="project.name"
                  autofocus
                  autocomplete="title"
                  required
                  disabled
                />

                <jet-label for="ty" value="Project Progress" />

                <select
                  id="ty"
                  type="text"
                  class="mt-1"
                  v-model="form.isProjectActive"
                  required
                  disabled
                >
                  <option
                    value="0"
                    :selected="project.isProjectActive == 0 ? 'true' : 'false'"
                  >
                    in Progress
                  </option>
                  <option
                    value="1"
                    :selected="project.isProjectActive == 1 ? 'true' : 'false'"
                  >
                    Complete
                  </option>
                </select>
                <div class="text-sm text-red-400" v-if="form.errors.type">
                  {{ form.errors.type }}
                </div>
                <div class="text-sm text-red-400" v-if="form.errors.name">
                  {{ form.errors.name }}
                </div>

                <section class="container mx-auto p-2 font-serif">
                  <div>
                    <div class="mt-1 block w-full mb-3">
                      <br />
                      <template
                        v-for="(prog, index) in project.progress
                          .slice()
                          .reverse()"
                        :key="index"
                      >
                        <div class="mb-3">
                          <label class="text-gray-700" for="username"
                            >Progress Report : on ({{
                              formatDate(prog.created_at)
                            }})</label
                          >

                          <Textarea
                            v-model="prog.progressReport"
                            rows="5"
                            cols="155"
                            class="mt- block w-full"
                            disabled
                          />
                        </div>

                        <div>
                          <a class="mt-1" href=""
                            >File: {{ prog.image_video }}</a
                          >
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
import { Inertia } from "@inertiajs/inertia";
import { ref, watch } from "vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetLabel from "@/Jetstream/Label.vue";

import Textarea from "primevue/textarea";
import MultiSelect from "primevue/multiselect";

const props = defineProps({
  students: Object,
  project: Object,
});

const form = useForm({
  image_video: "",
  progressReport: "",
  isProjectActive: props.project.isProjectActive,
});

function formatDate(dateString) {
  const date = new Date(dateString);
  return date.toLocaleDateString("en-GB");
}

function storeParam() {
  // form.post("/admin/project");
  // form.put("/admin/projectProgress/" + props.project.id);

  Inertia.post(`/admin/projectProgress/${props.project.id}`, {
    _method: "put",
    isProjectActive: form.isProjectActive,
    image_video: form.image_video,
    progressReport: form.progressReport,
  });
}
</script>
        