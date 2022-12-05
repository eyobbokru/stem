<template>
  <DashboardLayout title="edit student">
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
              :href="route('admin.student.index')"
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
            <form @submit.prevent="register">
              <div class="grid grid-cols-1 gap-6 mt-4 sm:grid-cols-3">
                <div>
                  <label class="text-gray-700" for="name">name</label>
                  <input
                    class="
                      w-full
                      mt-2
                      border-gray-200
                      rounded-md
                      focus:border-indigo-600
                      focus:ring
                      focus:ring-opacity-40
                      focus:ring-indigo-500
                    "
                    type="text"
                    v-model="form.name"
                  />
                  <div class="text-sm text-red-400" v-if="form.errors.name">
                    {{ form.errors.name }}
                  </div>
                </div>

                <div>
                  <label class="text-gray-700" for="fname">Father Name</label>
                  <input
                    class="
                      w-full
                      mt-2
                      border-gray-200
                      rounded-md
                      focus:border-indigo-600
                      focus:ring
                      focus:ring-opacity-40
                      focus:ring-indigo-500
                    "
                    type="text"
                    v-model="form.fname"
                  />
                  <div class="text-sm text-red-400" v-if="form.errors.fname">
                    {{ form.errors.fname }}
                  </div>
                </div>

                <div>
                  <label class="text-gray-700" for="lname">G.Father Name</label>
                  <input
                    class="
                      w-full
                      mt-2
                      border-gray-200
                      rounded-md
                      focus:border-indigo-600
                      focus:ring
                      focus:ring-opacity-40
                      focus:ring-indigo-500
                    "
                    type="text"
                    v-model="form.lname"
                  />
                  <div class="text-sm text-red-400" v-if="form.errors.lname">
                    {{ form.errors.lname }}
                  </div>
                </div>
                <div>
                  <label class="text-gray-700" for="age">Age</label>
                  <input
                    class="
                      w-full
                      mt-2
                      border-gray-200
                      rounded-md
                      focus:border-indigo-600
                      focus:ring
                      focus:ring-opacity-40
                      focus:ring-indigo-500
                    "
                    type="text"
                    v-model="form.age"
                  />
                  <div class="text-sm text-red-400" v-if="form.errors.age">
                    {{ form.errors.age }}
                  </div>
                </div>

                <div>
                  <label class="text-gray-700" for="school">Sex</label>
                  <select
                    class="
                      w-full
                      mt-2
                      border-gray-200
                      rounded-md
                      focus:border-indigo-600
                      focus:ring
                      focus:ring-opacity-40
                      focus:ring-indigo-500
                    "
                    type="text"
                    v-model="form.sex"
                  >
                    <option>Male</option>
                    <option>Female</option>
                  </select>
                  <div class="text-sm text-red-400" v-if="form.errors.sex">
                    {{ form.errors.sex }}
                  </div>
                </div>
                <div>
                  <label class="text-gray-700" for="grade">Grade</label>
                  <select
                    class="
                      w-full
                      mt-2
                      border-gray-200
                      rounded-md
                      focus:border-indigo-600
                      focus:ring
                      focus:ring-opacity-40
                      focus:ring-indigo-500
                    "
                    v-model="form.grade_id"
                  >
                    <option
                      v-for="(grade, index) of grades"
                      :key="index"
                      :value="grade.id"
                    >
                      {{ grade.name }}
                    </option>
                  </select>
                  <div class="text-sm text-red-400" v-if="form.errors.grade">
                    {{ form.errors.grade }}
                  </div>
                </div>

                <div>
                  <label class="text-gray-700" for="school">School</label>
                  <select
                    class="
                      w-full
                      mt-2
                      border-gray-200
                      rounded-md
                      focus:border-indigo-600
                      focus:ring
                      focus:ring-opacity-40
                      focus:ring-indigo-500
                    "
                    v-model="form.school_id"
                  >
                    <option
                      v-for="(school, index) of schools"
                      :key="index"
                      :value="school.id"
                    >
                      {{ school.name }}
                    </option>
                  </select>
                  <div class="text-sm text-red-400" v-if="form.errors.school">
                    {{ form.errors.school }}
                  </div>
                </div>
              </div>

              <div class="flex justify-end mt-4">
                <button
                  class="
                    px-4
                    py-2
                    text-gray-200
                    bg-gray-800
                    rounded-md
                    hover:bg-gray-700
                    focus:outline-none focus:bg-gray-700
                  "
                >
                  Update
                </button>
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
import Calendar from "primevue/calendar";
import Dropdown from "primevue/dropdown";
const props = defineProps({
  student: Object,
  grades: Object,
  schools: Object,
});

const form = useForm({
  name: props.student.name,
  fname: props.student.fname,
  lname: props.student.lname,
  age: props.student.age,
  sex: props.student.sex,
  school_id: props.student.school_id,
  grade_id: props.student.grade_id,
});

function register() {
  form.put("/admin/student/" + props.student.id);
}
</script>
