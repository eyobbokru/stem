<template>
  <div class="flex">
    <!-- Backdrop -->
    <div
      :class="isOpen ? 'block' : 'hidden'"
      @click="isOpen = false"
      class="fixed inset-0 z-20 transition-opacity bg-black opacity-50 lg:hidden"
    ></div>
    <!-- End Backdrop -->

    <div
      :class="isOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'"
      class="fixed inset-y-0 left-0 z-30 w-64 overflow-y-auto transition duration-300 transform bg-gray-900 lg:translate-x-0 lg:static lg:inset-0"
    >
      <div class="flex items-center justify-center mt-8">
        <div class="flex items-center">
          <svg
            class="w-12 h-12"
            viewBox="0 0 512 512"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M364.61 390.213C304.625 450.196 207.37 450.196 147.386 390.213C117.394 360.22 102.398 320.911 102.398 281.6C102.398 242.291 117.394 202.981 147.386 172.989C147.386 230.4 153.6 281.6 230.4 307.2C230.4 256 256 102.4 294.4 76.7999C320 128 334.618 142.997 364.608 172.989C394.601 202.981 409.597 242.291 409.597 281.6C409.597 320.911 394.601 360.22 364.61 390.213Z"
              fill="#4C51BF"
              stroke="#4C51BF"
              stroke-width="2"
              stroke-linecap="round"
              stroke-linejoin="round"
            />
            <path
              d="M201.694 387.105C231.686 417.098 280.312 417.098 310.305 387.105C325.301 372.109 332.8 352.456 332.8 332.8C332.8 313.144 325.301 293.491 310.305 278.495C295.309 263.498 288 256 275.2 230.4C256 243.2 243.201 320 243.201 345.6C201.694 345.6 179.2 332.8 179.2 332.8C179.2 352.456 186.698 372.109 201.694 387.105Z"
              fill="white"
            />
          </svg>

          <span class="mx-2 text-2xl font-semibold text-white">STEM</span>
        </div>
      </div>

      <nav class="mt-10">
        <Link
          class="flex items-center px-6 py-2 mt-4 duration-200 border-l-4"
          :class="[$page.url === '/dashboard' ? activeClass : inactiveClass]"
          :href="route('dashboard')"
        >
          <svg
            class="w-5 h-5"
            viewBox="0 0 20 20"
            fill="none"
            xmlns="http://www.w3.org/2000/svg"
          >
            <path
              d="M2 10C2 5.58172 5.58172 2 10 2V10H18C18 14.4183 14.4183 18 10 18C5.58172 18 2 14.4183 2 10Z"
              fill="currentColor"
            />
            <path
              d="M12 2.25195C14.8113 2.97552 17.0245 5.18877 17.748 8.00004H12V2.25195Z"
              fill="currentColor"
            />
          </svg>

          <span class="mx-4">Dashboard</span>
        </Link>

        <Link
          class="flex items-center px-6 py-2 mt-4 duration-200 border-l-4"
          :class="[
            $page.url === '/admin/management' ? activeClass : inactiveClass,
          ]"
          :href="route('admin.management.index')"
          v-if="$page.props.permission.includes('management list')"
        >
          <img src="/images/school.svg" alt="school" class="w-5 h-5" />

          <span class="mx-4">Management</span>
        </Link>

        <li class="relative m-0 x-[0.2rem]">
          <a
            type="button"
            class="flex h-12 cursor-pointer items-center truncate rounded-[5px] py-4 px-6 text-[0.875rem] text-gray-300 outline-none transition duration-300 ease-linear hover:bg-white/10 hover:outline-none focus:bg-white/10 focus:outline-none active:bg-white/10 active:outline-none data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none"
            @click="toggleSubMenu1"
            v-if="$page.props.permission.includes('academicSession list')"
          >
            <span
              class="mr-4 [&>svg]:h-4 [&>svg]:w-4 [&>svg]:text-gray-400 dark:[&>svg]:text-gray-300"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="currentColor"
                class="h-4 w-4"
              >
                <path
                  fill-rule="evenodd"
                  d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-2.625 6c-.54 0-.828.419-.936.634a1.96 1.96 0 00-.189.866c0 .298.059.605.189.866.108.215.395.634.936.634.54 0 .828-.419.936-.634.13-.26.189-.568.189-.866 0-.298-.059-.605-.189-.866-.108-.215-.395-.634-.936-.634zm4.314.634c.108-.215.395-.634.936-.634.54 0 .828.419.936.634.13.26.189.568.189.866 0 .298-.059.605-.189.866-.108.215-.395.634-.936.634-.54 0-.828-.419-.936-.634a1.96 1.96 0 01-.189-.866c0-.298.059-.605.189-.866zm2.023 6.828a.75.75 0 10-1.06-1.06 3.75 3.75 0 01-5.304 0 .75.75 0 00-1.06 1.06 5.25 5.25 0 007.424 0z"
                  clip-rule="evenodd"
                />
              </svg>
            </span>
            <span>Calender</span>
            <span
              class="absolute right-0 ml-auto mr-[0.8rem] transition-transform duration-300 ease-linear motion-reduce:transition-none [&>svg]:text-gray-600 dark:[&>svg]:text-gray-300"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
                fill="currentColor"
                class="h-5 w-5"
              >
                <path
                  fill-rule="evenodd"
                  d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                  clip-rule="evenodd"
                />
              </svg>
            </span>
          </a>
          <ul class="relative m-0 p-0" v-show="showSubMenu1">
            <li class="relative">
              <Link
                class="flex items-center px-6 py-2 mt-4 duration-200 border-l-4"
                :class="[
                  $page.url.startsWith('/admin/academicSession')
                    ? activeClass
                    : inactiveClass,
                ]"
                :href="route('admin.academicSession.index')"
                v-if="$page.props.permission.includes('academicSession list')"
              >
                <img
                  src="/images/degre.svg"
                  alt="degree"
                  class="w-5 h-5"
                  fill="currentColor"
                />

                <span class="mx-4">Academic Session</span>
              </Link>
            </li>

            <li class="relative">
              <a
                class="flex h-6 cursor-pointer items-center truncate rounded-[5px] py-4 pl-[3.4rem] pr-6 text-[0.78rem] text-gray-300 outline-none transition duration-300 ease-linear hover:bg-white/10 hover:outline-none focus:bg-white/10 focus:outline-none active:bg-white/10 active:outline-none data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none"
                >Link 3</a
              >
            </li>
          </ul>
        </li>

        <li class="relative m-0 x-[0.2rem]">
          <a
            type="button"
            class="flex h-12 cursor-pointer items-center truncate rounded-[5px] py-4 px-6 text-[0.875rem] text-gray-300 outline-none transition duration-300 ease-linear hover:bg-white/10 hover:outline-none focus:bg-white/10 focus:outline-none active:bg-white/10 active:outline-none data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none"
            @click="toggleSubMenu2"
            v-if="$page.props.permission.includes('student list')"
          >
            <span
              class="mr-4 [&>svg]:h-4 [&>svg]:w-4 [&>svg]:text-gray-400 dark:[&>svg]:text-gray-300"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="currentColor"
                class="h-4 w-4"
              >
                <path
                  fill-rule="evenodd"
                  d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-2.625 6c-.54 0-.828.419-.936.634a1.96 1.96 0 00-.189.866c0 .298.059.605.189.866.108.215.395.634.936.634.54 0 .828-.419.936-.634.13-.26.189-.568.189-.866 0-.298-.059-.605-.189-.866-.108-.215-.395-.634-.936-.634zm4.314.634c.108-.215.395-.634.936-.634.54 0 .828.419.936.634.13.26.189.568.189.866 0 .298-.059.605-.189.866-.108.215-.395.634-.936.634-.54 0-.828-.419-.936-.634a1.96 1.96 0 01-.189-.866c0-.298.059-.605.189-.866zm2.023 6.828a.75.75 0 10-1.06-1.06 3.75 3.75 0 01-5.304 0 .75.75 0 00-1.06 1.06 5.25 5.25 0 007.424 0z"
                  clip-rule="evenodd"
                />
              </svg>
            </span>
            <span>Student Related</span>
            <span
              class="absolute right-0 ml-auto mr-[0.8rem] transition-transform duration-300 ease-linear motion-reduce:transition-none [&>svg]:text-gray-600 dark:[&>svg]:text-gray-300"
              data-te-sidenav-rotate-icon-ref
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
                fill="currentColor"
                class="h-5 w-5"
              >
                <path
                  fill-rule="evenodd"
                  d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                  clip-rule="evenodd"
                />
              </svg>
            </span>
          </a>
          <ul class="relative m-0 p-0" v-show="showSubMenu2">
            <li class="relative">
              <Link
                class="flex items-center px-6 py-2 mt-4 duration-200 border-l-4"
                :class="[
                  $page.url.startsWith('/admin/student')
                    ? activeClass
                    : inactiveClass,
                ]"
                :href="route('admin.student.index')"
                v-if="$page.props.permission.includes('student list')"
              >
                <img
                  src="/images/student.svg"
                  alt="lab"
                  class="w-5 h-5"
                  fill="currentColor"
                />

                <span class="mx-4">Student</span>
              </Link>
            </li>
            <li>
              <Link
                class="flex items-center px-6 py-2 mt-4 duration-200 border-l-4"
                :class="[
                  $page.url === '/admin/project' ? activeClass : inactiveClass,
                ]"
                :href="route('admin.project.index')"
                v-if="$page.props.permission.includes('management list')"
              >
                <img src="/images/school.svg" alt="school" class="w-5 h-5" />

                <span class="mx-4">Students Project</span>
              </Link>
            </li>
            <li class="relative">
              <Link
                class="flex items-center px-6 py-2 mt-4 duration-200 border-l-4"
                :class="[
                  $page.url === 'admin/projectProgress'
                    ? activeClass
                    : inactiveClass,
                ]"
                :href="route('admin.projectProgress.index')"
                v-if="$page.props.permission.includes('management list')"
              >
                <img src="/images/school.svg" alt="school" class="w-5 h-5" />

                <span class="mx-4">Project Progress</span>
              </Link>
            </li>
          </ul>
        </li>

        <Link
          class="flex items-center px-6 py-2 mt-4 duration-200 border-l-4"
          :class="[
            $page.url.startsWith('/admin/teacher')
              ? activeClass
              : inactiveClass,
          ]"
          :href="route('admin.teacher.index')"
          v-if="$page.props.permission.includes('teacher list')"
        >
          <img
            src="/images/teacher.svg"
            alt="teacher"
            class="w-5 h-5"
            fill="currentColor"
          />
          <span class="mx-4">Teacher</span>
        </Link>

        <Link
          class="flex items-center px-6 py-2 mt-4 duration-200 border-l-4"
          :class="[
            $page.url.startsWith('/admin/lab') ? activeClass : inactiveClass,
          ]"
          :href="route('admin.lab.index')"
          v-if="$page.props.permission.includes('lab list')"
        >
          <img
            src="/images/lab.svg"
            alt="lab"
            class="w-5 h-5"
            fill="currentColor"
          />

          <span class="mx-4">Lab</span>
        </Link>

        <Link
          class="flex items-center px-6 py-2 mt-4 duration-200 border-l-4"
          :class="[
            $page.url.startsWith('/admin/certificates')
              ? activeClass
              : inactiveClass,
          ]"
          :href="route('admin.certificates.index')"
          v-if="$page.props.permission.includes('certificate list')"
        >
          <img
            src="/images/student.svg"
            alt="lab"
            class="w-5 h-5"
            fill="currentColor"
          />

          <span class="mx-4">Certificate</span>
        </Link>

        <Link
          class="flex items-center px-6 py-2 mt-4 duration-200 border-l-4"
          :class="[$page.url === '/admin/school' ? activeClass : inactiveClass]"
          :href="route('admin.school.index')"
          v-if="$page.props.permission.includes('school list')"
        >
          <img src="/images/school.svg" alt="school" class="w-5 h-5" />

          <span class="mx-4">School</span>
        </Link>

        <Link
          class="flex items-center px-6 py-2 mt-4 duration-200 border-l-4"
          :class="[
            $page.url.startsWith('/admin/gradeStudent')
              ? activeClass
              : inactiveClass,
          ]"
          :href="route('admin.gradeStudent.index')"
          v-if="$page.props.permission.includes('gradeStudent list')"
        >
          <svg
            xmlns="http://www.w3.org/2000/svg"
            class="w-5 h-5"
            viewBox="0 0 20 20"
            fill="currentColor"
          >
            <path d="M4 4a2 2 0 00-2 2v1h16V6a2 2 0 00-2-2H4z" />
            <path
              fill-rule="evenodd"
              d="M18 9H2v5a2 2 0 002 2h12a2 2 0 002-2V9zM4 13a1 1 0 011-1h1a1 1 0 110 2H5a1 1 0 01-1-1zm5-1a1 1 0 100 2h1a1 1 0 100-2H9z"
              clip-rule="evenodd"
            />
          </svg>

          <span class="mx-4">Grade</span>
        </Link>

        <Link
          class="flex items-center px-6 py-2 mt-4 duration-200 border-l-4"
          :class="[
            $page.url.startsWith('/admin/role') ? activeClass : inactiveClass,
          ]"
          :href="route('admin.role.index')"
          v-if="$page.props.permission.includes('role list')"
        >
          <img
            src="/images/student.svg"
            alt="lab"
            class="w-5 h-5"
            fill="currentColor"
          />

          <span class="mx-4">Role</span>
        </Link>
        <Link
          class="flex items-center px-6 py-2 mt-4 duration-200 border-l-4"
          :class="[
            $page.url.startsWith('/admin/permission')
              ? activeClass
              : inactiveClass,
          ]"
          :href="route('admin.permission.index')"
          v-if="$page.props.permission.includes('permission list')"
        >
          <img
            src="/images/student.svg"
            alt="lab"
            class="w-5 h-5"
            fill="currentColor"
          />

          <span class="mx-4">Permission</span>
        </Link>

        <Link
          class="flex items-center px-6 py-2 mt-4 duration-200 border-l-4"
          :class="[
            $page.url.startsWith('/stem/museum') ? activeClass : inactiveClass,
          ]"
          :href="route('stem.museum.index')"
          v-if="$page.props.permission.includes('museum list')"
        >
          <!-- v-if="$page.props.permission.includes('museum list')" -->
          <img
            src="/images/student.svg"
            alt="lab"
            class="w-5 h-5"
            fill="currentColor"
          />

          <span class="mx-4">Museum Management</span>
        </Link>

        <Link
          class="flex items-center px-6 py-2 mt-4 duration-200 border-l-4"
          :class="[
            $page.url.startsWith('/stem/news') ? activeClass : inactiveClass,
          ]"
          :href="route('stem.news.index')"
          v-if="$page.props.permission.includes('news list')"
        >
          <!-- v-if="$page.props.permission.includes('museum list')" -->
          <img
            src="/images/student.svg"
            alt="lab"
            class="w-5 h-5"
            fill="currentColor"
          />

          <span class="mx-4">News</span>
        </Link>

        <Link
          class="flex items-center px-6 py-2 mt-4 duration-200 border-l-4"
          :class="[
            $page.url.startsWith('/admin/users') ? activeClass : inactiveClass,
          ]"
          :href="route('admin.users.index')"
          v-if="$page.props.permission.includes('users list')"
        >
          <!-- v-if="$page.props.permission.includes('museum list')" -->
          <img
            src="/images/student.svg"
            alt="lab"
            class="w-5 h-5"
            fill="currentColor"
          />

          <span class="mx-4">Users</span>
        </Link>

        <li class="relative m-0 x-[0.2rem]">
          <a
            type="button"
            class="flex h-12 cursor-pointer items-center truncate rounded-[5px] py-4 px-6 text-[0.875rem] text-gray-300 outline-none transition duration-300 ease-linear hover:bg-white/10 hover:outline-none focus:bg-white/10 focus:outline-none active:bg-white/10 active:outline-none data-[te-sidenav-state-focus]:outline-none motion-reduce:transition-none"
            @click="toggleSubMenu3"
            v-if="$page.props.permission.includes('project list')"
          >
            <span
              class="mr-4 [&>svg]:h-4 [&>svg]:w-4 [&>svg]:text-gray-400 dark:[&>svg]:text-gray-300"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 24 24"
                fill="currentColor"
                class="h-4 w-4"
              >
                <path
                  fill-rule="evenodd"
                  d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zm-2.625 6c-.54 0-.828.419-.936.634a1.96 1.96 0 00-.189.866c0 .298.059.605.189.866.108.215.395.634.936.634.54 0 .828-.419.936-.634.13-.26.189-.568.189-.866 0-.298-.059-.605-.189-.866-.108-.215-.395-.634-.936-.634zm4.314.634c.108-.215.395-.634.936-.634.54 0 .828.419.936.634.13.26.189.568.189.866 0 .298-.059.605-.189.866-.108.215-.395.634-.936.634-.54 0-.828-.419-.936-.634a1.96 1.96 0 01-.189-.866c0-.298.059-.605.189-.866zm2.023 6.828a.75.75 0 10-1.06-1.06 3.75 3.75 0 01-5.304 0 .75.75 0 00-1.06 1.06 5.25 5.25 0 007.424 0z"
                  clip-rule="evenodd"
                />
              </svg>
            </span>
            <span>Project</span>
            <span
              class="absolute right-0 ml-auto mr-[0.8rem] transition-transform duration-300 ease-linear motion-reduce:transition-none [&>svg]:text-gray-600 dark:[&>svg]:text-gray-300"
            >
              <svg
                xmlns="http://www.w3.org/2000/svg"
                viewBox="0 0 20 20"
                fill="currentColor"
                class="h-5 w-5"
              >
                <path
                  fill-rule="evenodd"
                  d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z"
                  clip-rule="evenodd"
                />
              </svg> </span
            >s
          </a>
          <ul class="relative m-0 p-0" v-show="showSubMenu3">
            <li class="relative">
              <Link
                class="flex items-center px-6 py-2 mt-4 duration-200 border-l-4"
                :class="[
                  $page.url.startsWith('/admin/academicSession')
                    ? activeClass
                    : inactiveClass,
                ]"
                :href="route('admin.calls.index')"
                v-if="$page.props.permission.includes('project list')"
              >
                <img
                  src="/images/degre.svg"
                  alt="degree"
                  class="w-5 h-5"
                  fill="currentColor"
                />

                <span class="mx-4">Calls</span>
              </Link>
            </li>

            <li class="relative">
              <Link
                class="flex items-center px-6 py-2 mt-4 duration-200 border-l-4"
                :class="[
                  $page.url.startsWith('/admin/academicSession')
                    ? activeClass
                    : inactiveClass,
                ]"
                :href="route('admin.academicSession.index')"
                v-if="$page.props.permission.includes('academicSession list')"
              >
                <img
                  src="/images/degre.svg"
                  alt="degree"
                  class="w-5 h-5"
                  fill="currentColor"
                />

                <span class="mx-4">Projects related</span>
              </Link>
            </li>
          </ul>
        </li>
      </nav>
    </div>
  </div>
</template>

<script setup lang="ts">
import { ref } from "vue";
import { useSidebar } from "../hooks/useSidebar";
import { Link } from "@inertiajs/inertia-vue3";

const showSubMenu1 = ref(false);
const showSubMenu2 = ref(false);
const showSubMenu3 = ref(false);

function toggleSubMenu1() {
  showSubMenu1.value = !showSubMenu1.value;
}
function toggleSubMenu2() {
  showSubMenu2.value = !showSubMenu2.value;
}

function toggleSubMenu3() {
  showSubMenu3.value = !showSubMenu3.value;
}

const { isOpen } = useSidebar();
const activeClass = ref(
  "bg-gray-600 bg-opacity-25 text-gray-100 border-gray-100"
);
const inactiveClass = ref(
  "border-gray-900 text-gray-500 hover:bg-white-100 hover:bg-opacity-25 hover:text-gray-100 "
);
</script>
