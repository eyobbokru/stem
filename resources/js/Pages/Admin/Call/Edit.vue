<template>
  <DashboardLayout title="create lab">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Edit Call
      </h2>
    </template>

    <div class="py-2">
      <div class="max-w-7xl mx-auto">
        <section class="container mx-auto p-6 font-mono">
          <div class="w-full flex mb-4 p-2">
            <Link
              :href="route('admin.calls.index')"
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

                <jet-label for="endingYear" value="Closing Date" />
                <Calendar
                  id="endingYear"
                  class="mt-1 block w-full"
                  v-model="form.end_date"
                  :showIcon="true"
                />
                <div class="text-sm text-red-400" v-if="form.errors.end_date">
                  {{ form.errors.end_date }}
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
// import { ref, watch } from "vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetLabel from "@/Jetstream/Label.vue";
import Calendar from "primevue/calendar";

const props = defineProps({
  call: Object,
});

const form = useForm({
  name: props.call.name,
  end_date: props.call.end_date,
});

function storeParam() {
  form.put("/admin/calls/" + props.call.id);
}
</script>
    