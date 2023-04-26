<template>
  <DashboardLayout title="create lab">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Create User
      </h2>
    </template>

    <div class="py-2">
      <div class="max-w-7xl mx-auto">
        <section class="container mx-auto p-6 font-mono">
          <div class="w-full flex mb-4 p-2">
            <Link
              :href="route('admin.users.index')"
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

                <jet-label for="title" value="Email" />
                <jet-input
                  id="title"
                  type="email"
                  class="mt-1 block w-full"
                  v-model="form.email"
                  autofocus
                  autocomplete="title"
                  required
                />
                <div class="text-sm text-red-400" v-if="form.errors.email">
                  {{ form.errors.email }}
                </div>

                <jet-label for="title" value="Role" />
                <select
                  id="ty"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.role"
                  required
                >
                  <option
                    v-for="(Role, index) of roles"
                    :key="index"
                    :value="Role.id"
                  >
                    {{ Role.name }}
                  </option>
                </select>
                <div class="text-sm text-red-400" v-if="form.errors.role">
                  {{ form.errors.role }}
                </div>

                <div v-if="form.role == 4">
                  <jet-label for="title" value="CoE" />
                  <select
                    id="ty"
                    type="text"
                    class="mt-1 block w-full"
                    v-model="form.office_id"
                  >
                    <option
                      v-for="(coe, index) of coes"
                      :key="index"
                      :value="coe.id"
                    >
                      {{ coe.name }}
                    </option>
                  </select>
                  <div
                    class="text-sm text-red-400"
                    v-if="form.errors.office_id"
                  >
                    {{ form.errors.office_id }}
                  </div>
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

const props = defineProps({
  roles: Object,
  coes: Object,
});

const form = useForm({
  name: "",
  email: "",
  role: "",
  office_id: "",
});

function storeParam() {
  form.post("/admin/users");
}
</script>
  