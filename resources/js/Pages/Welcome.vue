<script setup>
import { Head, Link } from "@inertiajs/inertia-vue3";

defineProps({
  canLogin: Boolean,
  canRegister: Boolean,
  laravelVersion: String,
  phpVersion: String,
});
</script>



<template>
  <link rel="shortcut icon" href="assets/images/favicon.png" type="image/png" />

  <!--====== Animate CSS ======-->
  <link rel="stylesheet" href="css/animate.css" />

  <!--====== Slick CSS ======-->
  <link rel="stylesheet" href="css/tiny-slider.css" />

  <!--====== Line Icons CSS ======-->
  <link rel="stylesheet" href="assets/fonts/lineicons/font-css/LineIcons.css" />

  <!--====== Tailwind CSS ======-->
  <link rel="stylesheet" href="css/tailwindcss.css" />

  <section class="header_area">
    <div class="navbar-area bg-white">
      <div class="container relative">
        <div class="row items-center">
          <div class="w-full">
            <nav
              class="
                flex
                items-center
                justify-between
                py-4
                navbar navbar-expand-lg
              "
            >
              <a class="navbar-brand mr-5" href="index.html">
                <!-- <img src="assets/images/logo.svg" alt="Logo" /> -->
                <h3>STEM</h3>
              </a>
              <button
                class="block navbar-toggler focus:outline-none lg:hidden"
                type="button"
                data-toggle="collapse"
                data-target="#navbarOne"
                aria-controls="navbarOne"
                aria-expanded="false"
                aria-label="Toggle navigation"
              >
                <span class="toggler-icon"></span>
                <span class="toggler-icon"></span>
                <span class="toggler-icon"></span>
              </button>

              <div
                class="
                  absolute
                  left-0
                  z-20
                  hidden
                  w-full
                  px-5
                  py-3
                  duration-300
                  bg-white
                  lg:w-auto
                  collapse
                  navbar-collapse
                  lg:block
                  top-full
                  mt-full
                  lg:static lg:bg-transparent
                  shadow
                  lg:shadow-none
                "
                id="navbarOne"
              >
                <ul
                  id="nav"
                  class="
                    items-center
                    content-start
                    mr-auto
                    lg:justify-end
                    navbar-nav
                    lg:flex
                  "
                >
                  <li class="nav-item ml-5 lg:ml-11">
                    <a class="page-scroll active" href="#home">Home</a>
                  </li>
                  <li class="nav-item ml-5 lg:ml-11">
                    <a class="page-scroll" :href="route('museum')"
                      >AASTU Museum</a
                    >
                  </li>
                  <li class="nav-item ml-5 lg:ml-11">
                    <a class="page-scroll" href="#blog">New and Announcement</a>
                  </li>
                  <li class="nav-item ml-5 lg:ml-11">
                    <Link
                      :href="route('login')"
                      class="text-sm text-gray-700 dark:text-gray-500"
                      >Log in</Link
                    >
                  </li>
                  <li class="nav-item ml-5 lg:ml-11">
                    <Link
                      v-if="canRegister"
                      :href="route('register')"
                      class="ml-4 text-sm text-gray-700 dark:text-gray-500"
                      >Register</Link
                    >
                  </li>
                </ul>
              </div>
              <!-- navbar collapse -->
            </nav>
            <!-- navbar -->
          </div>
        </div>
        <!-- row -->
      </div>
      <!-- container -->
    </div>
    <!-- header navbar -->

    <div
      id="home"
      class="
        header_hero
        bg-gray
        relative
        z-10
        overflow-hidden
        lg:flex
        items-center
      "
    >
      <div class="hero_shape shape_1">
        <img src="assets/images/shape/shape-1.svg" alt="shape" />
      </div>
      <!-- hero shape -->
      <div class="hero_shape shape_2">
        <img src="assets/images/shape/shape-2.svg" alt="shape" />
      </div>
      <!-- hero shape -->
      <div class="hero_shape shape_3">
        <img src="assets/images/shape/shape-3.svg" alt="shape" />
      </div>
      <!-- hero shape -->
      <div class="hero_shape shape_4">
        <img src="assets/images/shape/shape-4.svg" alt="shape" />
      </div>
      <!-- hero shape -->
      <div class="hero_shape shape_6">
        <img src="assets/images/shape/shape-1.svg" alt="shape" />
      </div>
      <!-- hero shape -->
      <div class="hero_shape shape_7">
        <img src="assets/images/shape/shape-4.svg" alt="shape" />
      </div>
      <!-- hero shape -->
      <div class="hero_shape shape_8">
        <img src="assets/images/shape/shape-3.svg" alt="shape" />
      </div>
      <!-- hero shape -->
      <div class="hero_shape shape_9">
        <img src="assets/images/shape/shape-2.svg" alt="shape" />
      </div>
      <!-- hero shape -->
      <div class="hero_shape shape_10">
        <img src="assets/images/shape/shape-4.svg" alt="shape" />
      </div>
      <!-- hero shape -->
      <div class="hero_shape shape_11">
        <img src="assets/images/shape/shape-1.svg" alt="shape" />
      </div>
      <!-- hero shape -->
      <div class="hero_shape shape_12">
        <img src="assets/images/shape/shape-2.svg" alt="shape" />
      </div>
      <!-- hero shape -->

      <div class="container">
        <div class="row">
          <div class="w-full lg:w-1/2">
            <div class="header_hero_content pt-150 lg:pt-0">
              <h2
                class="
                  hero_title
                  text-2xl
                  sm:text-4xl
                  md:text-5xl
                  lg:text-4xl
                  xl:text-5xl
                  font-extrabold
                "
              >
                AASTU STEM Management
                <span class="text-theme-color">System</span>
              </h2>
              <p class="mt-8 lg:mr-8">
                Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed
                diam nonumy eirmod tempor invidunt ut labore et dolore magna.
              </p>
              <div class="hero_btn mt-10">
                <a class="main-btn" :href="route('login')">Get Started</a>
              </div>
            </div>
            <!-- header hero content -->
          </div>
        </div>
        <!-- row -->
      </div>
      <!-- container -->
      <div class="header_shape hidden lg:block"></div>

      <div class="header_image flex items-center">
        <div class="image 2xl:pl-25">
          <img src="assets/images/header-image.svg" alt="Header Image" />
        </div>
      </div>
      <!-- header image -->
    </div>
    <!-- header hero -->
  </section>

  <section id="blog" class="blog_area pt-120 pb-120">
    <div class="container">
      <div class="row justify-center">
        <div class="w-full lg:w-1/2">
          <div class="section_title text-center pb-6">
            <h5 class="sub_title">New and Announcement</h5>
            <h4 class="main_title">From The News</h4>
          </div>
          <!-- section title -->
        </div>
      </div>
      <!-- row -->
      <div class="row justify-center lg:justify-start">
        <div class="w-full md:w-8/12 lg:w-6/12 xl:w-4/12">
          <div
            class="
              single_blog
              mx-3
              mt-8
              rounded-xl
              bg-white
              transition-all
              duration-300
              overflow-hidden
              hover:shadow-lg
            "
          >
            <div class="blog_image">
              <img src="assets/images/blog-1.jpg" alt="blog" class="w-full" />
            </div>
            <div class="blog_content p-4 md:p-5">
              <ul class="blog_meta flex justify-between">
                <li class="text-body-color text-sm md:text-base">
                  By:
                  <a href="#" class="text-body-color hover:text-theme-color"
                    >Musharof Chowdury</a
                  >
                </li>
                <li class="text-body-color text-sm md:text-base">
                  15 June 2024
                </li>
              </ul>
              <h3 class="blog_title">
                <a href="#">How to track your business revenue</a>
              </h3>
              <a href="#" class="more_btn">Read More</a>
            </div>
          </div>
          <!-- row -->
        </div>
        <div class="w-full md:w-8/12 lg:w-6/12 xl:w-4/12">
          <div
            class="
              single_blog
              mx-3
              mt-8
              rounded-xl
              bg-white
              transition-all
              duration-300
              overflow-hidden
              hover:shadow-lg
            "
          >
            <div class="blog_image">
              <img src="assets/images/blog-2.jpg" alt="blog" class="w-full" />
            </div>
            <div class="blog_content p-4 md:p-5">
              <ul class="blog_meta flex justify-between">
                <li class="text-body-color text-sm md:text-base">
                  By:
                  <a href="#" class="text-body-color hover:text-theme-color"
                    >Musharof Chowdury</a
                  >
                </li>
                <li class="text-body-color text-sm md:text-base">
                  15 June 2024
                </li>
              </ul>
              <h3 class="blog_title">
                <a href="#">Improving products depending on feedback</a>
              </h3>
              <a href="#" class="more_btn">Read More</a>
            </div>
          </div>
          <!-- row -->
        </div>
        <div class="w-full md:w-8/12 lg:w-6/12 xl:w-4/12">
          <div
            class="
              single_blog
              mx-3
              mt-8
              rounded-xl
              bg-white
              transition-all
              duration-300
              overflow-hidden
              hover:shadow-lg
            "
          >
            <div class="blog_image">
              <img src="assets/images/blog-3.jpg" alt="blog" class="w-full" />
            </div>
            <div class="blog_content p-4 md:p-5">
              <ul class="blog_meta flex justify-between">
                <li class="text-body-color text-sm md:text-base">
                  By:
                  <a href="#" class="text-body-color hover:text-theme-color"
                    >Musharof Chowdury</a
                  >
                </li>
                <li class="text-body-color text-sm md:text-base">
                  15 June 2024
                </li>
              </ul>
              <h3 class="blog_title">
                <a href="#">How to diversify your audience</a>
              </h3>
              <a href="#" class="more_btn">Read More</a>
            </div>
          </div>
          <!-- row -->
        </div>
      </div>
      <!-- row -->
    </div>
    <!-- container -->
  </section>

  <footer id="footer" class="footer_area bg-black relative z-10">
    <div
      class="shape absolute left-0 top-0 opacity-5 h-full overflow-hidden w-1/3"
    >
      <img src="assets/images/footer-shape-left.png" alt="" />
    </div>
    <div
      class="
        shape
        absolute
        right-0
        top-0
        opacity-5
        h-full
        overflow-hidden
        w-1/3
      "
    >
      <img src="assets/images/footer-shape-right.png" alt="" />
    </div>
    <div class="container">
      <div class="footer_widget pt-18 pb-120">
        <div class="row justify-center">
          <div class="w-full md:w-1/2 lg:w-3/12">
            <div class="footer_about mt-13 mx-3">
              <div class="footer_logo">
                <a href="#"
                  ><img src="assets/images/logo-footer.svg" alt=""
                /></a>
              </div>
              <div class="footer_content mt-8">
                <p class="text-white">
                  Lorem ipsum dolor sitco nsetetu nonumy eirmod tempor invidunt
                  ut labore et dolore magna uyam erat, sed diam.
                </p>
              </div>
            </div>
            <!-- footer about -->
          </div>
          <div class="w-full md:w-1/2 lg:w-5/12">
            <div class="footer_link_wrapper flex flex-wrap mx-3">
              <div class="footer_link w-1/2 md:pl-13 mt-13">
                <h2 class="footer_title text-xl font-semibold text-white">
                  Quick Links
                </h2>
                <ul class="link pt-4">
                  <li>
                    <a href="#" class="text-white mt-4 hover:text-theme-color"
                      >Company</a
                    >
                  </li>
                  <li>
                    <a href="#" class="text-white mt-4 hover:text-theme-color"
                      >Privacy Policy</a
                    >
                  </li>
                  <li>
                    <a href="#" class="text-white mt-4 hover:text-theme-color"
                      >About</a
                    >
                  </li>
                </ul>
              </div>
              <!-- footer link -->
              <div class="footer_link w-1/2 md:pl-13 mt-13">
                <h2 class="footer_title text-xl font-semibold text-white">
                  Resources
                </h2>
                <ul class="link pt-4">
                  <li>
                    <a href="#" class="text-white mt-4 hover:text-theme-color"
                      >Support</a
                    >
                  </li>
                  <li>
                    <a href="#" class="text-white mt-4 hover:text-theme-color"
                      >Contact</a
                    >
                  </li>
                  <li>
                    <a href="#" class="text-white mt-4 hover:text-theme-color"
                      >Terms</a
                    >
                  </li>
                </ul>
              </div>
              <!-- footer link -->
            </div>
            <!-- footer link wrapper -->
          </div>
        </div>
        <!-- row -->
      </div>
      <!-- footer widget -->
      <div
        class="
          footer_copyright
          pt-3
          pb-6
          border-t-2 border-solid border-white border-opacity-10
          sm:flex
          justify-between
        "
      >
        <div class="footer_social pt-4 mx-3 text-center">
          <ul class="social flex justify-center sm:justify-start">
            <li class="mr-3">
              <a href="https://facebook.com/uideckHQ"
                ><i class="lni lni-facebook-filled"></i
              ></a>
            </li>
            <li class="mr-3">
              <a href="https://twitter.com/uideckHQ"
                ><i class="lni lni-twitter-filled"></i
              ></a>
            </li>
            <li class="mr-3">
              <a href="https://instagram.com/uideckHQ"
                ><i class="lni lni-instagram-original"></i
              ></a>
            </li>
            <li class="mr-3">
              <a href="#"><i class="lni lni-linkedin-original"></i></a>
            </li>
          </ul>
        </div>
        <!-- footer social -->
        <!-- <div class="footer_copyright_content pt-4 text-center">
          <p class="text-white">
            Designed and Developed by
            <a
              href="https://uideck.com"
              rel="nofollow"
              class="text-white hover:text-theme-color"
              >UIdeck</a
            >
            and
            <a
              href="https://tailwindtemplates.co"
              rel="nofollow"
              class="text-white hover:text-theme-color"
              >Tailwind Templates</a
            >
          </p>
        </div> -->
        <!-- footer copyright content -->
      </div>
      <!-- footer copyright -->
    </div>
    <!-- container -->
  </footer>
</template>


