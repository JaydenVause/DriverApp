<script setup>
    import MainTemplate from '@/Layouts/MainTemplate.vue';
    import { Head , useForm, router} from '@inertiajs/vue3';
    import SelectAreaForm from '@/Components/Forms/Parts/SelectAreaForm.vue';
    import { Link } from '@inertiajs/vue3'


    function padStart(str){
      str = new String(str);
      return str.padStart(2, '0')
    }

    

    function getLessonDateFormatted(dateStr){
      console.log(dateStr);
      let date = new Date(dateStr);
      console.log(date)
      return new Intl.DateTimeFormat('en-gb').format(date)
    }

    function formatTime(hours, minutes){
      let pm = false;

      if(hours > 12){
        hours = hours - 12
        pm = true
      }

      hours = hours == 0 ? 12 : hours;
      let endStr = pm ? 'pm' : 'am'  
      return new String(hours).padStart(2, '0') + ':' +  new String(minutes).padStart(2, '0') + endStr 
      
    }

    function getLessonStartTimeFormatted(dateStr){
          const date1 = new Date(dateStr);

          let hours = date1.getHours();

          let minutes = date1.getMinutes();
          
          return formatTime(hours, minutes)
    }

    function getLessonStatus(dateStr){
      let lessonDateTime = new Date(dateStr);
      let nowDateTime = Date.now()

      if(lessonDateTime < nowDateTime){
        return 'Finished';
      }else{
        return 'Pending';
      }
    }

</script>

<template>
    <Head title="Welcome" />
    <MainTemplate>
      <div class="max-w-[1200px] m-auto pt-3">
        <main class="flex flex-wrap justify-center overflow-x-hidden">
          <div class="w-full md:w-3/4 lg:w-2/3 xl:w-1/2 px-4 py-8">
            <h1 class="text-3xl font-bold mb-4">Driving Lessons</h1>
            <div class="grid grid-cols-1 gap-4">
              <template v-for="lesson in $page.props.driving_lessons">
                <div class="p-4 bg-gray-100 rounded-lg shadow">
                  <p class="text-sm font-medium">Date: {{getLessonDateFormatted(lesson.lesson_datetime)}}</p>
                  <p class="text-sm font-medium">Time lesson start : {{getLessonStartTimeFormatted(lesson.lesson_datetime)}}</p>
                  <p class="text-sm font-medium">Status: {{getLessonStatus(lesson.finish_datetime)}}</p>
                </div>
              </template>
            </div>
          </div>
          {{ $page.props.timezone ?? "none"}}
      </main>
    </div>
    </MainTemplate>

</template>
