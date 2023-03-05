<script setup>
import MainTemplate from '@/Layouts/MainTemplate.vue';
import { Head } from '@inertiajs/vue3';
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
	    	<div class="dark-gradient">
			    <div class="  p-10 max-w-[1200px] m-auto">
			    	<h1 class="text-white text-[3.3em] font-extrabold md:text-[3em]">Find the best local driving instructor now!</h1>
			        <SelectAreaForm @logLocation="searchForDriversInArea" />
			    </div>
			</div>
		</template>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>
        <h1 class="text-2xl font-bold">Showing driving instructors in {{ $page.props.location.postcode }}, {{ $page.props.location.suburb }}, {{ $page.props.location.state }}... </h1>
        
        <template v-for="instructor in $page.props.driving_instructors">
        	<div class="border-solid border-2 border-gray-300 p-4">
        		<div class="flex items-center gap-4">
        			<img src="#" class="w-[60px] h-[60px] p-3 rounded-full bg-black" />
	        		<p><strong>Name:</strong> {{instructor.name}}</p>
        		</div>
	        	<button class="bg-yellow-500 p-3 m-auto block">Book Now</button>
        	</div>
        </template>

       	
       	
                
        
    </MainTemplate>
</template>
<style>
    .dark-gradient{
         background: rgb(32,32,32);
        background: linear-gradient(120deg, rgba(32,32,32,1) 0%, rgba(71,71,69,1) 100%); 
    }
</style>
