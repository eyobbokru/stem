<template>
  <DashboardLayout title="create lab">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Create Museum Report
      </h2>
    </template>

    <div class="py-2">
      <div class="max-w-7xl mx-auto">
        <section class="container mx-auto p-6 font-mono">
          <div class="w-full flex mb-4 p-2">
            <Link
              :href="route('stem.museum.index')"
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
                <jet-label for="title" value="Institution Name" />
                <jet-input
                  id="title"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.from"
                  autofocus
                  autocomplete="title"
                  required
                />
                <div class="text-sm text-red-400" v-if="form.errors.from">
                  {{ form.errors.from }}
                </div>

                <jet-label for="title" value="Number of Participant" />
                <jet-input
                  id="title"
                  type="number"
                  class="mt-1 block w-full"
                  v-model="form.numberOfStudents"
                  autofocus
                  autocomplete="title"
                  required
                />
                <div
                  class="text-sm text-red-400"
                  v-if="form.errors.numberOfStudents"
                >
                  {{ form.errors.numberOfStudents }}
                </div>

                <jet-label for="title" value="Participant Remark" />
                <textarea
                  id="title"
                  type="number"
                  class="mt-1 block w-full"
                  v-model="form.remark"
                  autofocus
                  autocomplete="title"
                  required
                />
                <div class="text-sm text-red-400" v-if="form.errors.remark">
                  {{ form.errors.remark }}
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
import { ref, watch } from "vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetLabel from "@/Jetstream/Label.vue";

const props = defineProps({
  museum: Object,
});

const form = useForm({
  from: props.museum.from,
  numberOfStudents: props.museum.numberOfStudents,
  remark: props.museum.remark,
});

function storeParam() {
  form.put("/stem/museum/" + props.museum.id);
}
</script>
      