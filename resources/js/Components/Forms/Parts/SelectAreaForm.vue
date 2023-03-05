<script>
	export default{

		data(){
			return {
				locationsFound: null,
				searchVal: null,

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
	<input @input="searchForDrivingLocations" class="rounded-full p-3 w-full" type="text" placeholder="Enter postcode or suburb" v-model="searchVal" />
    <ul class="bg-[#e1e4e8] overflow-auto max-h-[300px]" >
        <template v-for="location in locationsFound">
            <li class="p-3 hover:bg-gray-700 hover:text-white hover:cursor-pointer" @click="emitLocation(location)">
                {{location.postcode}}, {{location.suburb}}, {{location.state}}
            </li>
        </template>
    </ul>
</template>