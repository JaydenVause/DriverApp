    <script setup>
        import MainTemplate from '@/Layouts/MainTemplate.vue';
        import { Head } from '@inertiajs/vue3';
        import SearchAreaForm from '@/Components/Forms/SearchAreaForm.vue'
        import { router } from '@inertiajs/vue3';
        
        //timetable 

        

    </script>

    <template>
        <Head title="Register Driving Instructor" />
        <MainTemplate>
            <h1 class="text-2xl font-extrabold">Update instructor profile</h1>
            <SearchAreaForm />
            
        </MainTemplate>
    </template>
    <style>
        .border{
            border-style:solid;
            border-color: black;
            border-width: 1px;
            overflow: auto;
            max-height: 200px
        }

        .error{
            color: red;
        }

        .light-gray{
            background-color: #a5a8ad;
        }

        .dark-gray{
            background-color: gray;
        }
    </style>