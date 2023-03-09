<script setup>
import MainTemplate from '@/Layouts/MainTemplate.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { reactive, ref } from 'vue';

import FullCalendar from '@fullcalendar/vue3'
import dayGridPlugin from '@fullcalendar/daygrid'
import interactionPlugin from '@fullcalendar/interaction'
import { usePage } from '@inertiajs/vue3';

// State
const selectedDate = ref(false);
const availableBookingTimes = reactive({});
const chosenMonth = ref(false);
const daysCurrent = reactive({
  dates: [],
});
const bookingTimesSelected = useForm({
  dates: {},
});

// Event handlers
function onDateClick(date) {
  if (date.dayEl.classList.contains('fc-enabled')) {
    if (selectedDate.classList) {
      selectedDate.classList.remove('fc-selected');
    }
    selectedDate.value = date.dayEl;
    if (selectedDate.classList) {
      selectedDate.classList.add('fc-selected');
    }
    const dayOfWeek = date.date.getDay();
    const form = {
      day: dayOfWeek,
      datetime: date.dateStr,
    };
    axios({
      method: 'post',
      url: `/create-booking/${usePage().props.instructor_id}/get-available-booking-times`,
      data: form
    }).then((response) => {
      availableBookingTimes.value = response.data.available_booking_times;
    })
  }
}

function onDatesSet() {
  const collection = [];
  const dateElements = document.querySelectorAll('.fc-daygrid-day');
  dateElements.forEach((element) => {
    collection.push(element.dataset.date)
  });
  daysCurrent.dates = collection;
  axios({
    method: 'post',
    url: `/create-booking/${usePage().props.instructor_id}/get-days-with-timeslot`,
    data: daysCurrent
  }).then((response) => {
    dateElements.forEach((element) => {
      if (!response.data.days_available.includes(element.dataset.date)) {
        element.classList.add('fc-disabled');
        element.classList.remove('fc-enabled');
      } else {
        element.classList.add('fc-enabled');
        element.classList.remove('fc-disabled');
      }
    })
  })
}

function onAddBooking(bookingtime) {
  bookingTimesSelected.dates = bookingtime;
}

function onProcessBookings() {
  bookingTimesSelected.post(`/create-booking/${usePage().props.instructor_id}/process`);
}

function onClearBookingTime(bookingTime) {
  bookingTimesSelected.dates = [];
}
function formattedDate(dateStr) {
	console.log(dateStr);
  let date = new Date(dateStr);
  let startHour = date.getHours();
  let startMinute = date.getMinutes();
  let endHour = startHour + 1;
  let endMinute = startMinute;
  let ampmStart = startHour < 12 ? "AM" : "PM";
  let ampmEnd = endHour < 12 ? "AM" : "PM";
  if (startHour > 12) {
    startHour -= 12;
  }
  if (endHour > 12) {
    endHour -= 12;
  }
  return `${startHour.toString().padStart(2, "0")}:${startMinute.toString().padStart(2, "0")} ${ampmStart} - ${endHour.toString().padStart(2, "0")}:${endMinute.toString().padStart(2, "0")} ${ampmEnd}`;
}

function formatEventDateTime(dateStr) {
  const date = new Date(dateStr);
  const startHour = date.getHours();
  const startMinute = date.getMinutes();
  const end = new Date(date.getTime() + 60 * 60 * 1000);
  const endHour = end.getHours();
  const endMinute = end.getMinutes();
  const amPm = startHour < 12 ? "AM" : "PM";
  const formattedStartHour = ((startHour + 11) % 12 + 1).toString().padStart(2, "0");
  const formattedEndHour = ((endHour + 11) % 12 + 1).toString().padStart(2, "0");
  const formattedStartMinute = startMinute.toString().padStart(2, "0");
  const formattedEndMinute = endMinute.toString().padStart(2, "0");
  const formattedDate = new Intl.DateTimeFormat("en-US", { month: "long", day: "numeric", year: "numeric" }).format(date);
  return `${formattedDate} at ${formattedStartHour}:${formattedStartMinute} ${amPm} - ${formattedEndHour}:${formattedEndMinute} ${amPm}`;
}



// Calendar options
const calendarOptions = {
  plugins: [dayGridPlugin, interactionPlugin],
  initialView: 'dayGridMonth',
  aspectRatio: .5,
  dateClick: onDateClick,
  datesSet: onDatesSet,
};

</script>

<template>
    <Head title="Create Booking" />
   <MainTemplate>
		  <div class="p-4">
		    <div class="bg-white p-4 flex flex-col gap-10 max-w-[1200px] m-auto rounded shadow-lg">
		      
		      <div class="">
		        <label class="text-2xl font-bold mb-2">Select a day</label>
		        <FullCalendar :style="{ 'max-height': '600px', 'max-width' : '800px', 'margin': 'auto'}" :options="calendarOptions" />
		      </div>

		      <div v-if="bookingTimesSelected.dates.length >= 1" class="relative w-full max-w-[400px] m-auto">
		        <label class="text-2xl font-bold mb-2">Selected booking</label>
		        <button class="bg-yellow-400 p-3 w-full rounded-lg font-bold hover:cursor-pointer mb-2">{{formatEventDateTime(bookingTimesSelected.dates)}}</button>
		        <button @click="onClearBookingTime(Object.keys(bookingTimesSelected.dates)[0])" class="absolute top-1/2 right-[10px] transform bg-black rounded-full text-white w-[20px] h-[20px] flex items-center justify-center hover:cursor-pointer">
		          <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
		            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
		          </svg>
		        </button>
		      </div>

		      <div class="flex flex-col items-center max-w-[400px] m-auto">
		        <label class="text-2xl font-bold mb-2">Available booking times</label>
		        <div class="max-h-[400px] overflow-auto">
		          <template v-if="availableBookingTimes.value && availableBookingTimes.value.length > 0">
		            <template v-for="booking in availableBookingTimes.value">
		              <button :disabled="Object.keys(bookingTimesSelected.dates).length < 1 || bookingTimesSelected.dates[booking] ? false : true" @click="onAddBooking(booking)" :class="Object.keys(bookingTimesSelected.dates).length < 1 || bookingTimesSelected.dates[booking] ? 'bg-yellow-400 hover:bg-yellow-300 p-3 w-full rounded-lg mb-2' :'bg-gray-100 hover:bg-gray-200 p-3 w-full rounded-lg mb-2'">
		                <div class="flex justify-between items-center">
		                  <div>{{formattedDate(booking)}}</div>
		                  <div v-if="bookingTimesSelected.dates[booking]" class="text-yellow-400 font-bold">Selected</div>
		                </div>
		              </button>
		            </template>
		          </template>
		          <p class="p-3" v-else>No times available...</p>
		        </div>
		      </div>
		      <div class="max-w-[300px] m-auto">
			      <button @click="onProcessBookings" :class="Object.keys(bookingTimesSelected.dates).length > 0 ? 'bg-yellow-400 p-3 hover:cursor-pointer rounded-lg font-bold' : 'bg-gray-400 p-3 rounded-lg font-bold'" :disabled="Object.keys(bookingTimesSelected.dates).length > 0 ? false : true">Create booking</button>
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
		background: rgb(250 204 21 / var(--tw-bg-opacity));
	}

	.fc-chosen-month{
		background-color: red !important;
	}

</style>