<script setup>
import MainTemplate from '@/Layouts/MainTemplate.vue';
import { Head , Link, useForm } from '@inertiajs/vue3';
import {reactive, ref} from 'vue';

import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import { usePage } from '@inertiajs/vue3';


let selectedDate = ref(false);

let days_current = reactive({
	dates : []
});

let availableBookingTimes = reactive({});

// handles when date clicked
function logDate(date){
	if(date.dayEl.classList.contains('fc-enabled')){
		//console.log(date.dayEl)
		
		if(selectedDate.classList){
			selectedDate.classList.remove('fc-selected');
		}

		selectedDate = date.dayEl;

		if(selectedDate.classList){
			selectedDate.classList.add('fc-selected');
		}


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
}


let calendarOptions = {
	plugins: [ dayGridPlugin, interactionPlugin ],
	initialView: 'dayGridMonth',
	aspectRatio: .75,
	dateClick: logDate,
	datesSet: clearDates
}

function clearDates(){
	let collection = [];
	let date_elements = document.querySelectorAll('.fc-daygrid-day');

	date_elements.forEach((element)=>{
		collection.push(element.dataset.date)
	})

	days_current.dates = collection;

	axios({
		method: 'post',
		url: '/create-booking/'+ usePage().props.instructor_id + '/get-days-with-timeslot',
		data: days_current
	}).then((response)=>{
		

		date_elements.forEach((element)=>{
			if(!response.data.days_available.includes(element.dataset.date)){
				
				element.classList.add('fc-disabled')

			}else{
				element.addEventListener('click', function(event){

				})
				element.classList.add('fc-enabled')
			}
		})
	})

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
	

	.fc-disabled{
		background-color: rgba(155,155,155,0.3);
		color: gray;
	}

	.fc-enabled:hover{
		cursor:pointer
	}

	.fc-selected{
		background: yellow;
	}

</style>