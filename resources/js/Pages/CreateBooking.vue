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

let bookingTimesSelected= useForm({
	dates: {}
});

let availableBookingTimes = reactive({});
let chosenMonth = ref(false);
// handles when date clicked
function logDate(date){
	if(date.dayEl.classList.contains('fc-enabled')){		
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
	aspectRatio: .5,
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
				element.classList.add('fc-enabled')
			}
		})
	})
}

function addBooking(bookingtime){
	bookingTimesSelected.dates = bookingtime;
}

function processBookings(){
	bookingTimesSelected.post('/create-booking/' + usePage().props.instructor_id + '/process');
}

function clearBookingTime(bookingTime){

	bookingTimesSelected.dates = [];
}

function formattedDate(dateStr) {

  let date = new Date(dateStr);
  let startHour = date.getHours();
  let startMinute = date.getMinutes();
  let endHour = startHour;
  let endMinute = startMinute 
  
 
    endHour += 1;
    


  return `${startHour.toString().padStart(2, '0')}:${startMinute.toString().padStart(2, '0')} - ${endHour.toString().padStart(2, '0')}:${endMinute.toString().padStart(2, '0')}`;
}



</script>

<template>
    <Head title="Search For Instructors" />
    <MainTemplate>
    	{{ bookingTimesSelected.errors }}
    	<div class="p-4">
    		<div class="bg-white p-4 flex flex-col gap-10 max-w-[1200px] m-auto rounded">
	    		<div>
	    		  <label class="text-2xl">Select a day</label>
	    		  <FullCalendar :style="{ 'max-height': '600px'}" :options="calendarOptions" />
	    	 	</div>

	    	 	<template v-if="bookingTimesSelected.dates.length >= 1">
	    	 		<label class="text-2xl">Selected booking</label>
	    	 		<span class="relative w-full max-w-[400px] m-auto">
					    <button class='bg-yellow-400 p-3 w-full hover:cursor-pointer rounded  m-auto'>
					        {{bookingTimesSelected.dates}}
					    </button>
					    <button @click="clearBookingTime(Object.keys(bookingTimesSelected.dates)[0])" class="absolute top-1/2 right-[10px] transform -translate-y-1/2 bg-black rounded-full text-white w-[20px] h-[20px] flex items-center justify-center">
					        X
					    </button>
						</span>
	    	 	</template>


	    	 	<label class="text-2xl">Available booking times</label>
	    	 	<div class="flex flex-col items-center max-h-[400px] overflow-auto gap-3 ">
	    	 		<template v-for="booking in availableBookingTimes.value" v-if="availableBookingTimes.value">
	    	 			<button 
	    	 				:disabled="Object.keys(bookingTimesSelected.dates).length < 1 || bookingTimesSelected.dates[booking] ? false : true" @click="addBooking(booking)"
	    	 				:class="Object.keys(bookingTimesSelected.dates).length < 1  || bookingTimesSelected.dates[booking]  ?
	    	 				'bg-yellow-400 p-3 w-full hover:cursor-pointer rounded max-w-[400px]' : 'bg-gray-400 p-3 w-full  rounded max-w-[400px]'"
	    	 			>{{formattedDate(booking)}}</button>
	    	 		</template>
	    	 		<template v-else>
	    	 			<p class="p-3">No times available...</p>
	    	 		</template>
	    	 	</div>

	    	 	
	    	 	<button @click="processBookings" :class="Object.keys(bookingTimesSelected.dates).length > 0 ? 'bg-yellow-400 p-3 hover:cursor-pointer' : 'bg-gray-400 p-3'" :disabled="Object.keys(bookingTimesSelected.dates).length > 0 ? false : true">Create booking</button>
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
		background: rgb(250 204 21 / var(--tw-bg-opacity));
	}

	.fc-chosen-month{
		background-color: red !important;
	}

</style>