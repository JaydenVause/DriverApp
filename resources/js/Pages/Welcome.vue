<script setup>
    import MainTemplate from '@/Layouts/MainTemplate.vue';
    import { Head , useForm, router} from '@inertiajs/vue3';
    import SelectAreaForm from '@/Components/Forms/Parts/SelectAreaForm.vue';
    import { Link } from '@inertiajs/vue3'
    import AOS from 'aos';
    import 'aos/dist/aos.css';

    AOS.init();

    function searchForDriversInArea(location){
        router.get('/driving-instructors?query='+location.id);
    }
</script>

<template>
    <Head title="Welcome" />
    <MainTemplate>
      <template #super>
        <div class="bg-[rgb(32,32,32)] " id="locationAnchor">
          <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
            <div class="lg:flex lg:items-center lg:justify-between">
              <div>
                <h2 class="text-3xl font-extrabold text-white sm:text-4xl">
                  Find Your Perfect Driving Instructor
                </h2>
                <p class="mt-3 max-w-2xl text-lg text-white sm:mt-4">
                  Connecting learner drivers with experienced instructors
                </p>
              </div>
              <div class="mt-8 lg:mt-0">
                <SelectAreaForm @logLocation="searchForDriversInArea" >
                  <h2 class="font-bold text-black text-lg">Find Driving Instructors Near You</h2>
                </SelectAreaForm>
              </div>
            </div>
          </div>
        </div>
      </template>

      <main class="flex flex-wrap justify-center">
          <section class=" bg-yellow-400 text-black  max-w-[1200px]">
            <div class="container mx-auto">
              <div class="grid grid-cols-1 md:grid-cols-3 gap-8 p-4">
                <span class="flex flex-col gap-3 bg-white p-10 rounded">
                    <p class="text-center text-2xl underline">Expert Instructors</p>
                    <p class="text-center">We offer flexible scheduling options to fit your needs and availability</p>
                    <img class="w-20 m-auto" alt="flexible scheduling icon" src="/imgs/icons/instructor-lecture-with-sceen-projection-tool-svgrepo-com.svg" />
                </span>
                <span class="flex flex-col gap-3 bg-white p-10 rounded">
                    <p class="text-center text-2xl underline">Flexible Schedule</p>
                    <p class="text-center">We offer flexible scheduling options to fit your needs and availability</p>
                    <img class="w-20 m-auto" alt="flexible scheduling icon" src="/imgs/icons/calendar-symbol-svgrepo-com.svg" />
                </span>
                <span class="flex flex-col gap-3 bg-white p-10 rounded">
                    <p class="text-center text-2xl underline">Competetive Prices</p>
                    <p class="text-center">We offer flexible scheduling options to fit your needs and availability</p>
                    <img class="w-20 m-auto" alt="flexible scheduling icon" src="/imgs/icons/money-svgrepo-com.svg" />
                </span>
              </div>
            </div>
             <hr class="hr" />
          </section>
          <section class="w-full " >
              <div class="driving-king bg-gray-100 py-10 py-[100px] " data-aos="zoom-in" data-aos-duration="700">
                <h2 class="text-3xl font-bold mb-8 text-center text-black">Learn to Drive with DrivingKing</h2>
                <div class="max-w-3xl mx-auto px-4">
                  <p class="text-xl mb-6 text-center text-gray-700">
                    DrivingKing is the premier platform for learner drivers to connect with experienced driving instructors. Our platform offers the following benefits:
                  </p>
                  <ul class="list-disc pl-6 mb-8">
                    <li class="mb-4">
                      <strong class="text-lg font-extrabold text-black">Expert Instructors:</strong> Our instructors are highly qualified and experienced, ensuring that you receive the best driving lessons possible.
                    </li>
                    <li class="mb-4">
                      <strong class="text-lg font-extrabold text-black">Flexible Bookings:</strong> Book your driving lessons at a time and place that suits you. We offer flexible scheduling options to fit your busy lifestyle.
                    </li>
                    <li class="mb-4">
                      <strong class="text-lg font-extrabold text-black">Affordable Prices:</strong> Our prices are competitive and affordable, so you can learn to drive without breaking the bank.
                    </li>
                    <li class="mb-4">
                      <strong class="text-lg font-extrabold text-black">Online Payments:</strong> Pay for your driving lessons securely online, so you don't have to worry about carrying cash to your lessons.
                    </li>
                    <li>
                      <strong class="text-lg font-extrabold text-black">Reviews and Ratings:</strong> Read reviews and ratings from other learners to find the best instructor for you.
                    </li>
                  </ul>
                  <p class="text-lg mb-6 text-center text-gray-700">
                    Ready to get started? Search for instructors in your area now and take the first step towards becoming a confident and safe driver!
                  </p>
                  <div class="text-center">
                    <a href="#locationAnchor" class="bg-black text-white py-2 px-6 rounded hover:bg-yellow-500 transition-colors duration-300">Find an Instructor</a>
                  </div>
                </div>
              </div>
          </section>
          <section class="lg:w-full flex flex-col gap-[40px]  max-w-[1200px] py-[100px] md:items-center lg:items-start">
            <h2 class="text-5xl" data-aos="fade-down"  data-aos-duration="1000">What our previous students have to say...</h2>

            <div class="flex items-center gap-4 bg-white p-3 max-w-[600px]  shadow-2xl m-3 lg:self-end rounded" data-aos="fade-left" data-aos-duration="1500">
               <img alt="profile picture" src="#" class=" bg-black min-h-[100px] min-w-[100px] rounded-full"/>
               <div>
                 <p class="font-extrabold">Michael Brown</p>
                 <p>"I've tried other driving instructor apps before, but DrivingKing is by far the best one out there! The instructors are knowledgeable and professional, and the app is easy to use. I've recommended it to all my friends and family."</p>
               </div>
            </div>

            <div class="flex items-center gap-4 bg-white p-3 max-w-[600px]  shadow-2xl m-3 rounded" data-aos="fade-right" data-aos-duration="1500">
               <img alt="profile picture" src="#" class=" bg-black min-h-[100px] min-w-[100px] rounded-full"/>
               <div>
                 <p class="font-extrabold">Amy Lee</p>
                 <p>"DrivingKing made learning to drive an enjoyable experience! The instructors are patient and knowledgeable, and the app makes scheduling lessons and tracking progress a breeze. I highly recommend this app to anyone learning to drive."</p>
               </div>
            </div>

            <div class="flex items-center gap-4 bg-white p-3 max-w-[600px]  shadow-2xl m-3 lg:self-end rounded" data-aos="fade-left" data-aos-duration="1500">
               <img alt="profile picture" src="#" class=" bg-black min-h-[100px] min-w-[100px] rounded-full"/>
               <div>
                 <p class="font-extrabold">David Johnson</p>
                 <p>"I was hesitant to try DrivingKing, but I'm so glad I did! The app has exceeded my expectations, and I've learned so much from my instructor. The lessons are well-structured and informative, and I feel confident behind the wheel now."</p>
               </div>
            </div>
          </section>

          <section class="py-16 bg-[rgb(32,32,32)] text-white p-3 w-full">
            <div class="container mx-auto">
              <h2 class="text-3xl font-bold mb-8">About DrivingKing Platform</h2>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-yellow-400 p-8 shadow-lg text-black">
                  <h3 class="text-xl font-bold mb-4">Register as a Driving Instructor</h3>
                  <p class="text-lg">Are you a driving instructor looking to expand your business? Register with DrivingKing and connect with students who are searching for your services. Showcase your expertise and build your reputation with our platform.</p>
                  <Link href="/register/driving-instructor" class="inline-block mt-4 py-2 px-4 font-bold rounded-full bg-black text-white hover:bg-gray-700 transition duration-300 ease-in-out">Register as a driving instructor</Link>
                </div>

              </div>
            </div>
          </section>
      </main>


    </MainTemplate>

</template>

<style>
    .dark-gradient{
         background: rgb(32,32,32);
        background: linear-gradient(120deg, rgba(32,32,32,1) 0%, rgba(71,71,69,1) 100%); 
    }

    .hr{
        display: block;
      height: 1px;
      border: 0;
      border-top: 1px solid black;
      margin: 1em 0;
      padding: 0;
    }
</style>