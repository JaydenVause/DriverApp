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
				
			    if(searchVal){
			        axios.get('/search/location-data?query='+searchVal)
			        .then((response) =>{
			            this.locationsFound = response.data

			            if(!response.data.length > 0){
			            	this.isDirty = true;
			            	console.log(this.isDirty)
			            }else{
			            	this.isDirty = false;
			            }
			        });
			    }else{
			    	this.isDirty = false;
			        this.locationsFound = null;
			    }
			},

			// let parent component know location is being transmitted for processing
			emitLocation(location){
				this.isDirty = false;
				this.$emit('logLocation', location);
					// driving locations input

				this.locationsFound = null;
				this.searchVal = null;
			}
		}
	}
</script>
<template>
	<div class="rounded-lg p-8">
	  <h2 class="text-3xl font-bold text-white mb-4">Find Driving Instructors Near You</h2>
	  <div class="relative">
	    <input @keyup="searchForDrivingLocations" class="rounded-full p-3 w-full text-black focus:outline-none focus:ring-2 focus:ring-yellow-400" type="text" placeholder="Enter postcode or suburb" v-model="searchVal" />
	    <ul class="bg-white mt-4 max-h-[300px] overflow-auto rounded-lg shadow-lg absolute z-10 top-full left-0 right-0" v-if="locationsFound">
	      <template v-for="location in locationsFound">
	        <li class="p-3 hover:bg-gray-700 hover:text-white hover:cursor-pointer" @click="emitLocation(location)">
	          {{location.postcode}}, {{location.suburb}}, {{location.state}}
	        </li>
	      </template>
	      <li class="p-3" v-if="isDirty">No results found</li>
	    </ul>
	  </div>
	</div>

</template>