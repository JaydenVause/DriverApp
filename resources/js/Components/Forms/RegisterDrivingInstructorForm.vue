<script setup>
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
        form.post('/register/driving-instructor');
    }
</script>
<template>
    <form class="flex flex-col gap-1 bg-white p-4 m-3 rounded mb-0" @submit.prevent="submit">
        <slot/>
        <label for="date_of_birth">Date of birth</label><br/>
        <span>
            <input type="date" class="max-w-[300px]"  name="date_of_birth" v-model="form.date_of_birth" /><br/>
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
        <div class=" border-solid border-black border-8 border bg-white">
        <article>
            <h1 class="text-4xl font-bold mb-4">Terms and Conditions</h1>
            <p class="mb-4">
            <strong>DrivingKing</strong> is an application designed to connect students looking for driving lessons with driving instructors in Australia. By using this application, you agree to the following terms and conditions:
            </p>
            <h2 class="text-2xl font-bold mb-2">Use of the Application</h2>
            <p class="mb-4">
            You must be at least 18 years of age to use this application. The information provided on this application is for general information purposes only and should not be relied upon as a substitute for legal or professional advice.
            </p>
            <h2 class="text-2xl font-bold mb-2">Liability</h2>
            <p class="mb-4">
            DrivingKing does not accept any liability for any loss, damage or injury arising from the use of this application. You are responsible for your own safety when using the application and when participating in driving lessons arranged through the application.
            </p>
            <p class="mb-4">
            DrivingKing is not liable for any accidents or incidents that may occur during or after driving lessons arranged through the application. Driving instructors and students are solely responsible for their own actions and DrivingKing will not be held liable for any damages resulting from those actions.
            </p>
            <h2 class="text-2xl font-bold mb-2">Governing Law</h2>
            <p class="mb-4">
            These terms and conditions are governed by the laws of Australia and any disputes arising from the use of this application shall be subject to the exclusive jurisdiction of the courts of Australia.
            </p>
            <h2 class="text-2xl font-bold mb-2">Changes to the Terms and Conditions</h2>
            <p class="mb-4">
            DrivingKing reserves the right to modify these terms and conditions at any time without notice. By continuing to use the application after any such changes, you agree to be bound by the modified terms and conditions.
            </p>
        </article>
        </div>
        <p v-if="form.errors.tandc">{{form.errors.tandc}}</p>


        <button class="bg-black text-white px-6 py-4 block m-auto">Apply</button> 
    </form>
</template>