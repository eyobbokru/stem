<template>
  <DashboardLayout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Certificate
      </h2>
    </template>

    <div class="py-2">
      <div>
        <section class="container mx-auto p-6 font-mono">
          <div class="w-full flex mb-2 p-2 justify-end"></div>
          <div
            class="w-full mb-2 overflow-hidden bg-white rounded-lg shadow-lg"
          >
            <div class="mt-2">
              <div class="mt-2">
                <div
                  class="
                    flex
                    items-center
                    px-4
                    py-4
                    space-x-4
                    overflow-x-auto
                    bg-white
                    rounded-md
                  "
                >
                  <label>
                    <div class="flex">
                      <span class="mr-2 text-gray-700 mt-2"
                        >Academic Session</span
                      >
                      <select
                        v-model="academicSession"
                        class="
                          px-4
                          py-3
                          w-48
                          rounded-md
                          bg-gray-100
                          border-transparent
                          focus:border-gray-500 focus:bg-white focus:ring-0
                          text-sm
                        "
                      >
                        <option
                          v-for="(academic_session, index) of academicSessions"
                          :key="index"
                          :value="academic_session.id"
                        >
                          {{ academic_session.name }}
                        </option>
                      </select>
                    </div>
                  </label>

                  <label>
                    <div class="flex">
                      <span class="mr-2 text-gray-700 mt-2">Group</span>
                      <select
                        v-model="group"
                        class="
                          px-4
                          py-3
                          w-32
                          rounded-md
                          bg-gray-100
                          border-transparent
                          focus:border-gray-500 focus:bg-white focus:ring-0
                          text-sm
                        "
                      >
                        <option selected>Group-1</option>
                        <option>Group-2</option>
                        <option>Group-3</option>
                        <option>Group-4</option>
                        <option>Group-5</option>
                      </select>
                    </div>
                  </label>
                </div>
              </div>
            </div>
          </div>
        </section>
      </div>
    </div>

    <div class="py-2">
      <div class="">
        <section class="container mx-auto p-6 font-mono">
          <div class="w-full flex mb-2 p-2 justify-end"></div>

          <div
            class="w-full mb-2 overflow-hidden bg-white rounded-lg shadow-lg"
          >
            <div class="p-2 m-2">
              <div class="flex justify-between">
                <div class="flex-1">
                  <div class="relative">
                    <div class="absolute flex items-center ml-2 h-full">
                      <svg
                        class="w-4 h-4 fill-current text-primary-gray-dark"
                        viewBox="0 0 16 16"
                        fill="none"
                        xmlns="http://www.w3.org/2000/svg"
                      >
                        <path
                          d="M15.8898 15.0493L11.8588 11.0182C11.7869 10.9463 11.6932 10.9088 11.5932 10.9088H11.2713C12.3431 9.74952 12.9994 8.20272 12.9994 6.49968C12.9994 2.90923 10.0901 0 6.49968 0C2.90923 0 0 2.90923 0 6.49968C0 10.0901 2.90923 12.9994 6.49968 12.9994C8.20272 12.9994 9.74952 12.3431 10.9088 11.2744V11.5932C10.9088 11.6932 10.9495 11.7869 11.0182 11.8588L15.0493 15.8898C15.1961 16.0367 15.4336 16.0367 15.5805 15.8898L15.8898 15.5805C16.0367 15.4336 16.0367 15.1961 15.8898 15.0493ZM6.49968 11.9994C3.45921 11.9994 0.999951 9.54016 0.999951 6.49968C0.999951 3.45921 3.45921 0.999951 6.49968 0.999951C9.54016 0.999951 11.9994 3.45921 11.9994 6.49968C11.9994 9.54016 9.54016 11.9994 6.49968 11.9994Z"
                        ></path>
                      </svg>
                    </div>

                    <input
                      v-model="search"
                      type="text"
                      placeholder="Search by name"
                      class="
                        px-8
                        py-3
                        w-full
                        md:w-2/6
                        rounded-md
                        bg-gray-100
                        border-transparent
                        focus:border-gray-500 focus:bg-white focus:ring-0
                        text-sm
                      "
                    />
                  </div>
                </div>
              </div>
            </div>

            <div class="w-full overflow-x-auto">
              <table class="w-full">
                <thead>
                  <tr
                    class="
                      text-md
                      font-semibold
                      tracking-wide
                      text-left text-gray-900
                      bg-gray-100
                      uppercase
                      border-b border-gray-600
                    "
                  >
                    <th>NO.</th>
                    <th class="px-4 py-3">Name</th>

                    <th class="px-4 py-3">Manage</th>
                  </tr>
                </thead>
                <tbody class="bg-white">
                  <tr
                    v-for="(student, index) in students.data"
                    :key="student.id"
                    class="text-gray-700"
                  >
                    <td class="px-4 py-3 border">{{ index + 1 }}</td>
                    <td class="px-4 py-3 border">
                      {{ student.name }} {{ student.fname }}
                    </td>

                    <td class="px-4 py-3 text-sm border">
                      <div class="flex justify-around">
                        <a
                          :href="route('admin.certificates.edit', student.id)"
                          class="
                            bg-green-500
                            hover:bg-green-700
                            text-white
                            px-4
                            py-2
                            rounded-lg
                          "
                          download
                        >
                          Certificate
                        </a>
                        <!--
                          <Link
                            :href="route('admin.student.destroy', student.id)"
                            method="delete"
                            as="button"
                            type="button"
                            class="
                              bg-red-500
                              hover:bg-red-700
                              text-white
                              px-4
                              py-2
                              rounded-lg
                            "
                          >
                            Delete
                          </Link> -->
                      </div>
                    </td>
                  </tr>
                </tbody>
              </table>
              <div class="m-2 p-2">
                <Pagination :links="students.links" />
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
import { Link } from "@inertiajs/inertia-vue3";
import Pagination from "@/Components/Pagination.vue";
import { ref, watch, defineProps } from "vue";
import { Inertia } from "@inertiajs/inertia";

const props = defineProps({
  students: Object,
  filters: Object,
  academicSessions: Object,
});

const search = ref("");
const group = ref("");
const academicSession = ref("");
const perPage = ref(5);

const rep = ref(
  "/admin/certificates?academicSession=" +
    academicSession.value +
    "&group=" +
    group.value +
    "&perPage=" +
    5 +
    "&search=" +
    search.value
);

watch(search, (value) => {
  Inertia.get(
    "/admin/certificates",
    {
      search: value,
      perPage: perPage.value,
      academicSession: academicSession.value,
      group: group.value,
    },
    {
      preserveState: true,
      replace: true,
    }
  );
});

watch(group, (value) => {
  Inertia.get(
    "/admin/certificates",
    {
      group: value,
      perPage: perPage.value,
      search: search.value,
      academicSession: academicSession.value,
    },
    {
      preserveState: true,
      replace: true,
    }
  );
});

watch(academicSession, (value) => {
  Inertia.get(
    "/admin/certificates",
    {
      academicSession: value,
      group: group.value,
      perPage: perPage.value,
      search: search.value,
    },
    {
      preserveState: true,
      replace: true,
    }
  );
});
</script>
  
  <style>
</style>
  