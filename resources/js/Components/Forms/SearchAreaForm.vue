<script setup>
	import { useForm } from '@inertiajs/vue3'
	import {reactive} from 'vue';
    import { usePage } from '@inertiajs/vue3'
    import AreaButtons from '@/Components/Forms/Parts/AreaButtons.vue';
    import SelectAreaForm from '@/Components/Forms/Parts/SelectAreaForm.vue';

    //format times propperly
	function format_loaded_time(time){
	    time = time.split(':');
	    return time[0].padStart(2, '0') + ':' + time[1].padEnd(2, '0');
	}

	// get previous driving day times data from props
	function load_previous_driving_data(){
	    let days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday'];
	    let data = {

	    };
	    let page = usePage();

	    days.forEach((day)=>{
	        if(page.props.current_driving_schedule && page.props.current_driving_schedule[day+'_from']){
	            data[day] = {
	                from:  format_loaded_time(page.props.current_driving_schedule[day+'_from']),
	                to:  format_loaded_time(page.props.current_driving_schedule[day+'_to'])
	            };
	        }else{
	            data[day] = false
	        }
	    });

	    return data;
	}

	// load previous driving location data from props
	function load_previous_driving_locations(){
	    let page = usePage();
	    let loaded_data = {};
	    page.props.current_areas_driving.forEach((driving_area)=>{
	        loaded_data[driving_area.id] = driving_area;
	    })
	    return loaded_data;
	}


	//form data
	const form = useForm({
	    days_times_driving: load_previous_driving_data(),
	    areas_driving: load_previous_driving_locations(),
	});

	// turn day on and off
	let toggleDay = function ( day ){
	    if(form.days_times_driving[day]){
	        form.days_times_driving[day] = false
	        
	    }else{
	        form.days_times_driving[day] = {
	            from: null,
	            to: null
	        }

	    }

	}

	//form submission

	function submit(){
	    form.patch('/instructor/update-profile');
	}

	// format times correctly

	function formatTime(hour, minute){
	    hour = hour - 1;
	    hour = hour.toString();
	    hour  = hour.padStart(2, '0');
	    return hour + ':' + minute;
	}

	// format error string correctly
	function getErrorString(day, action){
	    return 'days_times_driving.' + day + '.'+action;
	}



	// handling adding locations to form
	function addLocation(location){

	    form.areas_driving[location.id] = location;

	}

	// delete driving location from data
	function deleteLocation(location_id){
	    delete form.areas_driving[location_id];
	}

	
</script>
<template>
	<form class="flex flex-col gap-1 bg-white p-3 rounded" @submit.prevent="submit">
				<slot />
                <label>Days providing lessons</label>
                <table>
                    <template v-for="day in ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']">
                        <tr>
                            <td><p>{{day}}</p></td>
                            <!--checkbox-->
                            <td><input type="checkbox" @change="toggleDay(day)" :checked="form.days_times_driving[day] ? true: false "></td>
                            <!-- from time label -->
                            <td class="[&>*]:m-[10px]">
                                <label>From</label>
                                <select  :disabled="form.days_times_driving[day] == false ? true: false" v-model="form.days_times_driving[day].from">
                                    <template v-for="hour in 24">
                                        <template v-for="minute in ['00', '30']">
                                            <option  :value="formatTime(hour, minute)">{{formatTime(hour, minute)}}</option>
                                        </template>
                                    </template>
                                </select>
                            </td>
                            <!-- to time label -->
                            <td>
                                <label>To</label>
                                <select  :disabled="form.days_times_driving[day] == false ? true: false" v-model="form.days_times_driving[day].to">
                                    <template v-for="hour in 24">
                                        <template v-for="minute in ['00', '30']">
                                            <option  :value="formatTime(hour, minute)">{{formatTime(hour, minute)}}</option>
                                        </template>
                                    </template>
                                </select>
                            </td>
                        </tr>
                        <!-- errors -->
                        <tr>
                            <p class="error" v-if="form.errors[getErrorString(day, 'from')]">
                                {{form.errors['days_times_driving.' + day + '.' + 'from']}}
                            </p>
                            <p class="error" v-else-if="form.errors[getErrorString(day, 'to')]">
                                {{form.errors['days_times_driving.' + day + '.' + 'to']}}
                            </p>
                            <p class="error" v-else-if="form.errors['days_times_driving.'+day]">
                                {{form.errors['days_times_driving.'+day]}}
                            </p>
                        </tr>
                    </template>
                </table>

                <p class="error" v-if="form.errors.days_times_driving">
                    {{form.errors.days_times_driving}}
                </p>
                <!-- areas -->
                <SelectAreaForm @logLocation="addLocation">
                	<label>Select areas you are available to drive</label>
                </SelectAreaForm>

                <AreaButtons :areasDriving="form.areas_driving" @deleteAreaDriving="deleteLocation" />
                

                <p class="error" v-if="form.errors.areas_driving">
                    {{form.errors.areas_driving}}
                </p>
                <button class="bg-yellow-400 px-6 py-4 block m-auto">Update</button> 
            </form>
</template>