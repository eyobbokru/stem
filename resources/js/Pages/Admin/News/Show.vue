<script setup>
import { Inertia } from "@inertiajs/inertia";

import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import { ref, watch, defineProps } from "vue";

const props = defineProps({
  news: Object,
});
function formatDateDay(date) {
  const options = {
    year: "numeric",
    month: "long",
    day: "numeric",
  };
  return new Date(date).toLocaleDateString("en-us", options);
}
</script>

<template>
  <DashboardLayout title="create lab">
    <div class="py-2">
      <div
        class="max-w-7xl mx-auto mb-8 p-6 overflow-hidden bg-white rounded-lg shadow-lg"
      >
        <section class="container mx-auto p-6 font-mono">
          <div>
            <!-- Page Title -->

            <!--End Page Title-->

            <!--Sidebar Page Container-->
            <div class="sidebar-page-container">
              <div
                class="patern-layer-one paroller"
                data-paroller-factor="0.40"
                data-paroller-factor-lg="0.20"
                data-paroller-type="foreground"
                data-paroller-direction="vertical"
                style="background-image: url(images/icons/icon-1.png)"
              ></div>
              <div
                class="patern-layer-two paroller"
                data-paroller-factor="0.40"
                data-paroller-factor-lg="-0.20"
                data-paroller-type="foreground"
                data-paroller-direction="vertical"
                style="background-image: url(images/icons/icon-2.png)"
              ></div>
              <div class="circle-one"></div>
              <div class="circle-two"></div>
              <div class="auto-container">
                <div class="row clearfix">
                  <!-- Sidebar Side -->
                  <div
                    class="sidebar-side style-two blog-sidebar col-lg-3 col-md-12 col-sm-12"
                  ></div>

                  <!-- Content Side -->
                  <div
                    class="content-side blog-detail-column col-lg-9 col-md-12 col-sm-12"
                  >
                    <div class="blog-detail">
                      <div class="inner-box">
                        <h2 class="text-4xl">
                          {{ news.title }}
                        </h2>
                        <ul class="author-info">
                          <!-- <li>By {{ news.user.name }}</li> -->
                          <li>
                            <span class="theme_color">
                              {{ formatDateDay(news.created_at) }}</span
                            >
                          </li>
                        </ul>
                        <div class="image">
                          <!-- <img src="https://via.placeholder.com/790x350" alt="" /> -->
                          <img
                            v-if="news.imagePath"
                            :src="'storage/' + news.imagePath"
                            alt=""
                            style="width: 790px; height: 350px"
                          />
                        </div>
                        <h4 class="text-2xl">
                          {{ news.title }}
                        </h4>
                        <div v-html="news.description"></div>

                        <div class="social-box">
                          <span>Share this article on </span>
                          <a href="#" class="fa fa-facebook-square"></a>
                          <a href="#" class="fa fa-twitter-square"></a>
                          <a href="#" class="fa fa-linkedin-square"></a>
                          <a href="#" class="fa fa-github"></a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- End Call To Action Section Two -->
          </div>
        </section>
      </div>
    </div>
  </DashboardLayout>
</template>