<script setup>
import MainTemplate from '@/Layouts/MainTemplate.vue';
import { Head , Link, useForm } from '@inertiajs/vue3';
import {reactive} from 'vue';

import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import { usePage } from '@inertiajs/vue3';


let availableBookingTimes = reactive({});

// handles when date clicked
function logDate(date){
	 


	let dayOfWeek = date.date.getDay();
	

	

	let form = {
		day: dayOfWeek,
		datetime : date.dateStr,	
	};

	axios({
		method: 'post',
		url: '/create-booking/'+ usePage().props.instructor_id + '/get-available-booking-times',
		data: form
	}).then((response)=>{
		
		availableBookingTimes.value = response.data.available_booking_times;
	})
}

let calendarOptions = {
	plugins: [ dayGridPlugin, interactionPlugin ],
	initialView: 'dayGridMonth',
	aspectRatio: .75,
	dateClick: logDate
}


 
</script>

<template>
    <Head title="Search For Instructors" />
    <MainTemplate>
    	<div class="p-4">
    		<div class="bg-white p-4 flex flex-col gap-10 max-w-[1200px] m-auto rounded">

	    		<div>
	    		  <label class="text-2xl">Select a day</label>
	    		  <FullCalendar :style="{ 'max-height': '600px'}" :options="calendarOptions" />
	    	 	</div>
	    	 	<label class="text-2xl">Available booking times</label>
	    	 	<div class="flex flex-col items-center max-h-[400px] overflow-auto ">

	    	 		<template v-for="booking in availableBookingTimes.value" v-if="availableBookingTimes.value">
	    	 			<button class="bg-yellow-400 w-full p-3 hover:text-white hover:bg-black my-1 max-w-[300px]">{{booking}}</button>
	    	 		</template>
	    	 		<template v-else>
	    	 			<p class="p-3">No times available...</p>
	    	 		</template>
	    	 	</div>
	    	 </div>
    	</div>
    </MainTemplate>
</template>
<style>
	.fc-day-mon:hover, .fc-day-tue:hover, .fc-day-wed:hover, .fc-day-thu:hover , .fc-day-fri:hover, .fc-day-sat:hover, .fc-day-sun:hover {
		cursor: pointer;
		background: gray !important;
	}

	.fc-col-header-cell:hover{
		background: none !important;
		cursor: default !important;
	}

</style>