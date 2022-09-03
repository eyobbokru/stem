<template>
  <DashboardLayout title="create school">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Create School
      </h2>
    </template>

    <div class="py-2">
      <div class="max-w-7xl mx-auto">
        <section class="container mx-auto p-6 font-mono">
          <div class="w-full flex mb-4 p-2">
            <Link
              :href="route('admin.school.index')"
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
              sm:max-w-md
              p-6
              overflow-hidden
              bg-white
              rounded-lg
              shadow-lg
            "
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
                <jet-label for="level" value="Level" />
                <select
                  id="level"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.level"
                  required
                >
                  <option>Primary School</option>
                  <option>High School</option>
                  <option>Preparatory School</option>
                </select>
                <div class="text-sm text-red-400" v-if="form.errors.level">
                  {{ form.errors.level }}
                </div>

                <jet-label for="title" value="Address" />
                <jet-input
                  id="address"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.address"
                  autofocus
                  autocomplete="title"
                  required
                />
                <div class="text-sm text-red-400" v-if="form.errors.address">
                  {{ form.errors.address }}
                </div>

                <jet-label for="phone" value="Phone" />
                <jet-input
                  id="phone"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.phone"
                  autofocus
                  required
                />
                <div class="text-sm text-red-400" v-if="form.errors.phone">
                  {{ form.errors.phone }}
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

const props = defineProps({});

const form = useForm({
  name: "",
  address: "",
  phone: "",
  level: "",
});

function storeParam() {
  form.post("/admin/school");
}
</script>
