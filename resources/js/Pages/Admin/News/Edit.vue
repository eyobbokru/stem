<template>
  <DashboardLayout title="create lab">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Create News
      </h2>
    </template>

    <div class="py-2">
      <div class="max-w-7xl mx-auto">
        <section class="container mx-auto p-6 font-mono">
          <div class="w-full flex mb-4 p-2">
            <Link
              :href="route('stem.news.index')"
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
                <jet-label for="title" value="Institution Name" />
                <jet-input
                  id="title"
                  type="text"
                  class="mt-1 block w-full"
                  v-model="form.title"
                  autofocus
                  autocomplete="title"
                  required
                />
                <div class="text-sm text-red-400" v-if="form.errors.title">
                  {{ form.errors.title }}
                </div>

                <jet-label for="title" value="Content" />
                <ckeditor
                  :editor="editor"
                  v-model="form.description"
                  :config="editorConfig"
                  id="body"
                  required
                  class="mt-1 block w-full"
                ></ckeditor>

                <div
                  class="text-sm text-red-400"
                  v-if="form.errors.description"
                >
                  {{ form.errors.description }}
                </div>

                <jet-label for="image" value="Upload image" />
                <input
                  type="file"
                  @input="form.imagePath = $event.target.files[0]"
                />
                <a :href="'/public/Image/' + form.imagePath">{{
                  form.imagePath
                }}</a>
                <progress
                  v-if="form.progress"
                  :value="form.progress.percentage"
                  max="100"
                >
                  {{ form.progress.percentage }}%
                </progress>
                <div class="text-sm text-red-400" v-if="form.errors.imagePath">
                  {{ form.errors.imagePath }}
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
import { Inertia } from "@inertiajs/inertia";

import CKEditor from "@ckeditor/ckeditor5-vue";
import ClassicEditor from "@ckeditor/ckeditor5-build-classic";
const editor = ClassicEditor;
const ckeditor = CKEditor.component;
const editorConfig = {
  toolbar: {
    items: [
      "heading",
      "|",
      "bold",
      "italic",
      "|",
      "numberedList",
      "bulletedList",
      "|",
      "indent",
      "outdent",
      "|",
      "link",
      "blockQuote",
      "insertTable",
      "|",
      "undo",
      "redo",
    ],
  },
};

const props = defineProps({
  news: Object,
});

const form = useForm({
  title: props.news.title,
  description: props.news.description,
  imagePath: props.news.imagePath,
});

function storeParam() {
  //   form.put("/stem/news/" + props.news.id);

  Inertia.post(`/stem/news/${props.news.id}`, {
    _method: "put",
    title: form.title,
    description: form.description,
    imagePath: form.imagePath,
  });
}
</script>
        