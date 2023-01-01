<template>
  <DashboardLayout title="create student">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Student Registration
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

          <div>
            <div class="mt-8">
              <div class="mt-4">
                <div class="p-6 bg-white rounded-md shadow-md">
                  <h2 class="text-lg font-semibold text-gray-700 capitalize">
                    Student Registration
                  </h2>

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
                        <div
                          class="text-sm text-red-400"
                          v-if="form.errors.name"
                        >
                          {{ form.errors.name }}
                        </div>
                      </div>

                      <div>
                        <label class="text-gray-700" for="fname"
                          >Father Name</label
                        >
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
                        <div
                          class="text-sm text-red-400"
                          v-if="form.errors.fname"
                        >
                          {{ form.errors.fname }}
                        </div>
                      </div>

                      <div>
                        <label class="text-gray-700" for="lname"
                          >G.Father Name</label
                        >
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
                        <div
                          class="text-sm text-red-400"
                          v-if="form.errors.lname"
                        >
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
                        <div
                          class="text-sm text-red-400"
                          v-if="form.errors.age"
                        >
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
                          v-model="form.sex"
                        >
                          <option>Male</option>
                          <option>Female</option>
                        </select>
                        <div
                          class="text-sm text-red-400"
                          v-if="form.errors.sex"
                        >
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
                        <div
                          class="text-sm text-red-400"
                          v-if="form.errors.grade"
                        >
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
                        <div
                          class="text-sm text-red-400"
                          v-if="form.errors.school"
                        >
                          {{ form.errors.school }}
                        </div>
                      </div>
                      <div>
                        <label class="text-gray-700" for="academic_session_id"
                          >academic_session_id</label
                        >
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
                          v-model="form.academic_session_id"
                        >
                          <!-- @change="onChange($event)" -->

                          <option
                            v-for="(
                              academic_session, index
                            ) of academic_sessions"
                            :key="index"
                            :value="academic_session.id"
                          >
                            {{ academic_session.name }}
                          </option>
                        </select>
                        <div
                          class="text-sm text-red-400"
                          v-if="form.errors.academic_session_id"
                        >
                          {{ form.errors.academic_session_id }}
                        </div>
                      </div>

                      <div>
                        <label class="text-gray-700" for="group_id"
                          >group
                        </label>
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
                          v-model="form.group_id"
                        >
                          <option
                            v-for="(academic_session, index) in grade_s.value"
                            :key="index"
                            :value="academic_session.id"
                          >
                            {{ academic_session.name }}
                          </option>
                        </select>
                        <div
                          class="text-sm text-red-400"
                          v-if="form.errors.group_id"
                        >
                          {{ form.errors.group_id }}
                        </div>
                      </div>
                      <div>
                        <label class="text-gray-700" for="group_id"
                          >Project
                        </label>
                        <label>
                          <input
                            type="checkbox"
                            class="
                              w-5
                              h-5
                              text-indigo-600
                              rounded-md
                              focus:ring-indigo-500
                            "
                            name="radio"
                            v-model="form.isProject"
                          />
                        </label>
                        <div
                          class="text-sm text-red-400"
                          v-if="form.errors.isProject"
                        >
                          {{ form.errors.isProject }}
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
                        Save
                      </button>
                    </div>
                  </form>
                </div>
              </div>
            </div>
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
import Calendar from "primevue/calendar";
import { toRefs } from "@vue/reactivity";
import Dropdown from "primevue/dropdown";

const props = defineProps({
  grades: Object,
  schools: Object,
  academic_sessions: Object,
});

const form = useForm({
  name: "",
  fname: "",
  lname: "",
  school_id: "",
  sex: "",
  age: "",
  grade_id: "",
  academic_session_id: "",
  group_id: "",
  isProject: false,
});

function register() {
  form.post("/admin/student");
}

const grade_s = [];

watch(
  () => form.academic_session_id,
  (college_id, prevCollege_id) => {
    var data = JSON.parse(JSON.stringify(props.academic_sessions));

    data.forEach((element) => {
      if (college_id == element.id) {
        grade_s.value = element.section;
        console.log(element.section);
      }
    });
  }
);
</script>
