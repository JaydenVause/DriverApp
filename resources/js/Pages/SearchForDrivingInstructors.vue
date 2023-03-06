<script setup>
import MainTemplate from '@/Layouts/MainTemplate.vue';
import { Head , router, Link} from '@inertiajs/vue3';
import SelectAreaForm from '@/Components/Forms/Parts/SelectAreaForm.vue';
function searchForDriversInArea(location){
        console.log(location.id);

        router.get('/driving-instructors?query='+location.id);
    }
</script>

<template>
    <Head title="Search For Instructors" />

	
    <MainTemplate>
    	<template #super>
            <div class="bg-black">
                <SelectAreaForm @logLocation="searchForDriversInArea">
                    <h2 class="font-bold text-black">Find Driving Instructors Near You</h2>
                </SelectAreaForm>
            </div>
        </template>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>
       <div>
          <div class="container mx-auto py-8 p-3 flex flex-col gap-4">
            <h1 v-if="$page.props.location" class="text-2xl font-bold">Showing driving instructors in {{ $page.props.location.postcode }}, {{ $page.props.location.suburb }}, {{ $page.props.location.state }}...</h1>
            <template v-if="$page.props.driving_instructors.length > 0">
              <template v-for="instructor in $page.props.driving_instructors">
                <div class=" rounded p-4 bg-white shadow-xl">
                  <div class="flex items-center gap-4">
                    <img src="#" class="w-[60px] h-[60px] p-3 rounded-full bg-black" />
                    <p><strong>Name:</strong> {{instructor.name}}</p>
                  </div>
                  <Link type="button" :href="'/create-booking/' + instructor.id" class="bg-yellow-500 p-3 m-auto block max-w-[100px] rounded hover:bg-black hover:text-white">Book Now</Link>
                </div>
              </template>
            </template>
            <template v-else>
              <p class="text-lg">No driving instructors found in this location.</p>
            </template>
          </div>
        </div>


       	
       	
                
        
    </MainTemplate>
</template>
<style>
    .dark-gradient{
         background: rgb(32,32,32);
        background: linear-gradient(120deg, rgba(32,32,32,1) 0%, rgba(71,71,69,1) 100%); 
    }
</style>
