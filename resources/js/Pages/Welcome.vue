<script setup>
    import MainTemplate from '@/Layouts/MainTemplate.vue';
    import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Welcome" />
    <MainTemplate>
        <template #super>
            <div class="bg-gray-800 text-white left-0 p-3">
                <h1 class="text-4xl">Find the best local driving instructor now!</h1>
                <input class="m-auto block rounded-full text-black w-full" type="text" name="postcode" placeholder="Enter postcode or suburb" />
                <button class="block m-auto p-3 bg-yellow-500 text-black mt-3">Find Instructor</button>
            </div>
        </template>
        <div class="flex flex-col gap-3">
            <div class="bg-gray-800 text-white p-6">
                <h2 class="text-2xl text-center underline">Fast</h2>
                <p class='text-lg text-center'>Fast access to the best local driving instructors available</p>
            </div>

            <div class="bg-gray-800 text-white p-6">
                <h2 class="text-2xl text-center underline">Safe</h2>
                <p class='text-lg text-center'>All driving instructors are vetted and verified</p>
            </div>

            <div class="bg-gray-800 text-white p-6">
                <h2 class="text-2xl text-center underline">Quality</h2>
                <p class='text-lg text-center'>Upon selecting instructors you can check reviews from prior students allowing you to scope them out for yourself</p>
            </div>            
        </div>
    </MainTemplate>
</template>