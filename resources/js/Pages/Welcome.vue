<script setup>
    import MainTemplate from '@/Layouts/MainTemplate.vue';
    import { Head } from '@inertiajs/vue3';
</script>

<template>
    <Head title="Welcome" />
    <MainTemplate>
        <template #super>
            <div class=" dark-gradient">
                <div class="p-3 flex justify-center ">
                    <div class="items-end flex flex-col p-3">
                        <h1 class="text-white text-[3.3em] font-extrabold md:text-[3em]">Find the best local driving instructor now!</h1>
                        <img alt="L, P & P2 icon" src="/imgs/gip2.png" class="w-[250px] self-end"/>
                    </div>
                    
                </div>
                <div class="bg-white p-3 flex justify-center">
                    <div class="flex flex-col max-w-[900px] w-full gap-3 h-full md:justify-center">
                        <label class=" underline text-lg">Search for a driving instructor</label>
                        <input type="text" name="postcode" placeholder="Enter postcode or suburb" class="p-4 rounded " />
                    </div>
                </div>
            </div>
        </template>
        <div class="flex gap-3 flex-wrap justify-center">
            <div class="bg-white text-black shadow-xl p-6 max-w-[300px]">
                <h2 class="text-2xl text-center underline">Fast</h2>
                <p class='text-lg text-center'>Fast access to the best local driving instructors available</p>
            </div>

            <div class="bg-white text-black shadow-xl p-6 max-w-[300px]">
                <h2 class="text-2xl text-center underline">Safe</h2>
                <p class='text-lg text-center'>All driving instructors are vetted and verified</p>
            </div>

            <div class="bg-white text-black shadow-xl p-6 max-w-[300px]">
                <h2 class="text-2xl text-center underline">Quality</h2>
                <p class='text-lg text-center'>Checkout instructors before you drive!</p>
            </div>            
        </div>
    </MainTemplate>
</template>

<style>
    .dark-gradient{
         background: rgb(32,32,32);
        background: linear-gradient(120deg, rgba(32,32,32,1) 0%, rgba(71,71,69,1) 100%); 
    }
</style>