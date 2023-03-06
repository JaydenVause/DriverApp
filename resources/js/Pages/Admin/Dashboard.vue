<script setup>
    import MainTemplate from '@/Layouts/MainTemplate.vue';
    import { Head } from '@inertiajs/vue3';
    import AdminPanelButton from '@/Components/Links/AdminPanelButton.vue';
</script>

<template>
    <Head title="Admin Dashboard" />
    <MainTemplate>
        <template #super>
            <div class="bg-gray-800 text-white left-0 p-3">
                <h1>Welcome {{$page.props.auth.user.name}}!</h1>
            </div>
        </template>
        
        <div class="bg-white p-4">
            <h2 class="text-center">Admin Dashboard</h2>
            <AdminPanelButton href="/admin/approve-instructors" name="Approve Instructors" type='button' />
        </div>
    </MainTemplate>
</template>