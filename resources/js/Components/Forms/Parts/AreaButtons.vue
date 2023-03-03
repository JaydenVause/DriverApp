<script>
     export default{
          props: {
               areasDriving: Object
          },

          methods: {
               emitDeleteEvent(id){
                    this.$emit('deleteAreaDriving', id);
               }
          }
     }
</script>

<template>
     <ul>
         <template v-for="location in areasDriving">
              <div class="flex justify-between p-3 shadow">
                      <p class="flex-1">{{location.postcode}}, {{location.suburb}}, {{location.state}}</p>                            
                      <button class="flex-2 font-extrabold text-2xl" @click.prevent="emitDeleteEvent(location.id)">x</button>
              </div>
         </template> 
      </ul>
</template>