<script setup>
    import MainTemplate from '@/Layouts/MainTemplate.vue';
    import { Head } from '@inertiajs/vue3';
    import { useForm } from '@inertiajs/vue3'
    import { router } from '@inertiajs/vue3';

    const form = useForm({
        date_of_birth: null,
        drivers_license_number: null,
        country: null,
        wwcc: null,
        medical: null,
        tandc: null
    });

    function submit(){
        console.log(form);
        form.post('/register/driving-instructor');
    }

</script>

<template>
    <Head title="Welcome" />
    <MainTemplate>
        <h1 class="text-2xl font-extrabold">Register as driving instructor</h1>
        <form class="flex flex-col gap-1" @submit.prevent="submit">
            <label for="date_of_birth">Date of birth</label><br/>
            <span>
                <input type="date" class="max-w-[100px]"  name="date_of_birth" v-model="form.date_of_birth" /><br/>
            </span>
            <p v-if="form.errors.date_of_birth">{{form.errors.date_of_birth}}</p>

            <label for="drivers_license_number">Drivers license number</label><br/>
            <input type="text"  name="drivers_license_number" placeholder="e.g. AWX023242"  v-model="form.drivers_license_number"/><br/>
            <p v-if="form.errors.drivers_license_number">{{form.errors.drivers_license_number}}</p>

            <label for="country">Country</label><br />
            <select name="country"  v-model="form.country">
                <option value="1">Australia</option>
            </select><br/>
            <p v-if="form.errors.country">{{form.errors.country}}</p>

            <label for="wwcc">WWCC number</label><br/>
            <input type="text" name="wwcc" placeholder="e.g. 23123"  v-model="form.wwcc" /><br/>
            <p v-if="form.errors.wwcc">{{form.errors.wwcc}}</p>


            <label for="medical">Medical check</label><br />
            <input type="file" name="medical" @input="form.medical = $event.target.files[0]" /><br />
            <p v-if="form.errors.medical">{{form.errors.medical}}</p>

            <span class="flex"><input type='checkbox' name="tandc"   v-model="form.tandc"/><label for="tandc">Agree to our terms and conditions</label></span>
            <div class=" border-solid border-black border-8 border">
                Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
                tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
                consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
                cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
                proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
            </div>
            <p v-if="form.errors.tandc">{{form.errors.tandc}}</p>


            <button class="bg-yellow-400 px-6 py-4 block m-auto">Apply</button> 
        </form>
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