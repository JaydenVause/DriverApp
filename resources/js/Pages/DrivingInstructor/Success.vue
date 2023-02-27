<script setup>
    import MainTemplate from '@/Layouts/MainTemplate.vue';
    import { Head } from '@inertiajs/vue3';
    import { reactive } from 'vue';
    import { router } from '@inertiajs/vue3';

    const form = reactive({
        date_of_birth: null,
        drivers_license_number: null,
        country: null,
        wwcc: null,
        medical: null,
        tandc: null
    });

    function submit(){
        router.post('/register/driving-instructor', form);
    }

</script>

<template>
    <Head title="Success" />
    <MainTemplate>
        <h1 class="text-2xl font-extrabold">Thankyou!</h1>
        <p>Successfully recieved your registration to be a driving instructor</p>
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
</style>