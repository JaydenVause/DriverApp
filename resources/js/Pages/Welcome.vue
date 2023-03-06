<script setup>
    import MainTemplate from '@/Layouts/MainTemplate.vue';
    import { Head , useForm, router} from '@inertiajs/vue3';
    import SelectAreaForm from '@/Components/Forms/Parts/SelectAreaForm.vue';
    import { Link } from '@inertiajs/vue3'

    function searchForDriversInArea(location){
        console.log(location.id);

        router.get('/driving-instructors?query='+location.id);
    }
</script>

<template>
    <Head title="Welcome" />
    <MainTemplate>
      <template #super>
        <div class="dark-gradient">
          <div class="max-w-[1200px] mx-auto ">
            <SelectAreaForm @logLocation="searchForDriversInArea" />
          </div>
        </div>
      </template>
      <main class="flex flex-wrap justify-center">
          <section class="py-16 bg-yellow-400 text-black p-3">
            <div class="container mx-auto">
              <h2 class="text-3xl font-bold mb-8">Why DrivingKing?</h2>
              <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-white p-8 shadow-lg text-black">
                  <h3 class="text-xl font-bold mb-4">Expert Instructors</h3>
                  <p class="text-lg">Our driving instructors are highly experienced and fully licensed, ensuring you receive the best possible instruction and guidance.</p>
                </div>
                <div class="bg-white p-8 shadow-lg text-black">
                  <h3 class="text-xl font-bold mb-4">Flexible Scheduling</h3>
                  <p class="text-lg">We understand that everyone has busy schedules, which is why we offer flexible scheduling options to fit your needs and availability.</p>
                </div>
                <div class="bg-white p-8 shadow-lg text-black">
                  <h3 class="text-xl font-bold mb-4">Affordable Pricing</h3>
                  <p class="text-lg">Learning to drive shouldn't break the bank. Our driving lessons are competitively priced, making it easy for you to get the instruction you need.</p>
                </div>
              </div>
            </div>
          </section>

          <section class="py-16 bg-[rgb(32,32,32)] text-white p-3">
            <div class="container mx-auto">
              <h2 class="text-3xl font-bold mb-8">About DrivingKing Platform</h2>
              <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <div class="bg-yellow-400 p-8 shadow-lg text-black">
                  <h3 class="text-xl font-bold mb-4">Find Driving Instructors</h3>
                  <p class="text-lg">Looking for a driving instructor? DrivingKing is here to help! Our platform allows you to find highly experienced and fully licensed driving instructors in your local area.</p>
                </div>
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
</style>