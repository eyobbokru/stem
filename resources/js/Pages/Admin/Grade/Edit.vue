<template>
  <DashboardLayout title="edit grade">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Edit Grade
      </h2>
    </template>

    <div class="py-2">
      <div class="max-w-7xl mx-auto">
        <section class="container mx-auto p-6 font-mono">
          <div class="w-full flex mb-1 p-1">
            <Link
              :href="route('admin.management.index')"
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
            <form @submit.prevent="storeParam(index2)">
              <div>
                <div class="flex flex-col">
                  <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="py-2 inline-block min-w-full sm:px-6 lg:px-8">
                      <div class="overflow-x-auto">
                        <table class="min-w-full border">
                          <thead class="border-b">
                            <tr class="border">
                              <th
                                scope="col"
                                class="
                                  text-sm
                                  font-medium
                                  text-gray-900
                                  px-3
                                  py-2
                                  text-left
                                  border
                                "
                              >
                                #
                              </th>
                              <th
                                scope="col"
                                class="
                                  text-sm
                                  font-medium
                                  text-gray-900 text-left
                                  border
                                "
                              >
                                Name
                              </th>
                              <template
                                v-for="(courses, index) in course"
                                :key="index"
                              >
                                <th
                                  scope="col"
                                  class="
                                    text-sm
                                    font-medium
                                    text-gray-900
                                    px-6
                                    py-2
                                    text-left
                                    border
                                  "
                                >
                                  {{ courses }}
                                </th>
                              </template>
                            </tr>
                          </thead>
                          <tbody>
                            <template
                              v-for="(student, index1) in students"
                              :key="index1"
                            >
                              <tr class="border-b">
                                <td
                                  class="
                                    px-6
                                    whitespace-nowrap
                                    text-sm
                                    font-medium
                                    text-gray-900
                                    border
                                  "
                                >
                                  {{ index1 + 1 }}
                                </td>
                                <td
                                  class="
                                    px-6
                                    py-2
                                    whitespace-nowrap
                                    text-sm
                                    font-medium
                                    text-gray-900
                                    border
                                  "
                                >
                                  {{ student_list[index1] }}
                                </td>

                                <template
                                  v-for="(student1, index2) in student"
                                  :key="index2"
                                >
                                  <td
                                    class="
                                      text-sm text-gray-900
                                      font-light
                                      whitespace-nowrap
                                      border
                                    "
                                  >
                                    <input
                                      v-model="student1.score"
                                      class="
                                        text-sm text-gray-900
                                        font-light
                                        px-2
                                        py-2
                                        whitespace-nowrap
                                        box-border
                                        w-[100%]
                                      "
                                      placeholder="insert score"
                                      type="number"
                                      min="0"
                                      max="100"
                                    />
                                  </td>
                                </template>
                                <td
                                  class="
                                    text-sm text-gray-900
                                    font-light
                                    whitespace-nowrap
                                    border
                                  "
                                >
                                  <!-- <jet-button
                                    class="
                                      mx-auto
                                      w-20
                                      items-center
                                      bg-green-600
                                    "
                                    :class="{ 'opacity-25': form.processing }"
                                    :disabled="form.processing"
                                  >
                                    save
                                  </jet-button> -->
                                </td>
                              </tr>
                            </template>
                          </tbody>
                        </table>
                        <div class="flex justify-end">
                          <jet-button
                            class="
                              mt-3
                              w-20
                              items-center
                              bg-green-600
                              justify-center
                            "
                            :class="{ 'opacity-25': form.processing }"
                            :disabled="form.processing"
                          >
                            save
                          </jet-button>
                        </div>
                      </div>
                      <div class="m-2 p-2">
                        <Pagination :links="students.links" />
                      </div>
                    </div>
                  </div>
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
import { Inertia } from "@inertiajs/inertia";
const props = defineProps({
  students: Object,
  course: Array,
  student_list: Array,
});

const form = useForm({
  academic_session_id: "",
  course_id: "",
  course_name: "",
  created_at: "",
  fname: "",
  group_id: "",
  id: "",
  lname: "",
  name: "",
  score: "",
  student_id: "",
});

// <!-- form.put("/admin/lab/" + props.lab.id); -->
function storeParam(index2) {
  // var student = json
  var student = JSON.parse(JSON.stringify(props.students));
  var json = { ...student };
  const form = useForm({ ...json });
  Inertia.post("/admin/grade", json);
}
</script>
  