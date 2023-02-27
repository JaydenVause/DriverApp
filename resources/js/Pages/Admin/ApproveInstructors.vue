<script setup>
    import MainTemplate from '@/Layouts/MainTemplate.vue';
    import { Head } from '@inertiajs/vue3';
    import AdminPanelButton from '@/Components/Links/AdminPanelButton.vue';
    import {router} from '@inertiajs/vue3';

    let approveApplication = function(registrationId){
        console.log(registrationId);
        router.post('/admin/approve-instructors/'+registrationId);
    }
    
</script>

<template>
    <Head title="Approve Instructors" />
    <MainTemplate>

        <div class="shadow-2xl border-solid border-gray-100 border-2 p-3" v-for="registration in $page.props.registrations">
            <p>Application ID: {{ registration.id }}</p>
            <p>User ID: {{registration.user_id}}</p>
            <p>Created At: {{ registration.created_at }}</p>
            <p>Last Modified: {{ registration.updated_at}}</p>
            <p>User Name: {{ registration.name }}</p>
            <p>User Email: {{ registration.email }}</p>
            <p>View medical: <a class="underline text-blue-700" :href="'/secure-store/' + registration.medical">Download</a></p>
            <p>Application status: {{registration.approved ? "Approved" : "Pending..."}}</p>
            <button class="bg-yellow-500 p-3 m-auto block" @click="approveApplication(registration.id)" v-if="!registration.approved">Approve</button>
        </div>
    </MainTemplate>
</template>