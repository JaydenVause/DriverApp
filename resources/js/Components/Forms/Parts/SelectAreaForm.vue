<script>
	export default{

		data(){
			return {
				locationsFound: null,
				searchVal: null,
				isDirty: false

			};
		},

		emits: ['logLocation'],

		methods: {
			// query database for locations of location provided
			searchForDrivingLocations(searchVal){
				searchVal = searchVal.target.value
				this.isDirty = true;
			    if(searchVal){
			        axios.get('/search/location-data?query='+searchVal)
			        .then((response) =>{
			            this.locationsFound = response.data
			        });
			    }else{
			        this.locationsFound = null;
			    }
			},

			// let parent component know location is being transmitted for processing
			emitLocation(location){
				this.$emit('logLocation', location);
					// driving locations input

				this.locationsFound = null;
				this.searchVal = null;
			}
		}
	}
</script>
<template>
	<div class="p-8 rounded-lg">
	  <h2 class="text-3xl font-bold text-white mb-4">Find Driving Instructors Near You</h2>
	  <div class="flex items-center">
	    <input @keyup="searchForDrivingLocations" class="rounded-full p-3 w-full text-black focus:outline-none focus:ring-2 focus:ring-yellow-400" type="text" placeholder="Enter postcode or suburb" v-model="searchVal" />
	    
	  </div>
	  <ul class="bg-white mt-4 overflow-auto max-h-[300px] rounded-lg shadow-lg">
	    <template v-if="locationsFound">
	      <template v-for="location in locationsFound">
	        <li class="p-3 hover:bg-gray-700 hover:text-white hover:cursor-pointer" @click="emitLocation(location)">
	          {{location.postcode}}, {{location.suburb}}, {{location.state}}
	        </li>
	      </template>
	    </template>
	    <template v-if="isDirty && !locationsFound">
	      <li class="p-3">No results found</li>
	    </template>
	  </ul>
	</div>
</template>