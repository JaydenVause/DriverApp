<template>
	<label>Days providing lessons</label>
        <table>
            <template v-for="day in ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']">
                <tr>
                    <td><p>{{day}}</p></td>
                    <!--checkbox-->
                    <td><input type="checkbox" @change="toggleDay(day)" :checked="form.days_times_driving[day] ? true: false "></td>
                    <!-- from time label -->
                    <td class="[&>*]:m-[10px]">
                        <label>From</label>
                        <select  :disabled="form.days_times_driving[day] == false ? true: false" v-model="form.days_times_driving[day].from">
                            <template v-for="hour in 24">
                                <template v-for="minute in ['00', '30']">
                                    <option  :value="formatTime(hour, minute)">{{formatTime(hour, minute)}}</option>
                                </template>
                            </template>
                        </select>
                    </td>
                    <!-- to time label -->
                    <td>
                        <label>To</label>
                        <select  :disabled="form.days_times_driving[day] == false ? true: false" v-model="form.days_times_driving[day].to">
                            <template v-for="hour in 24">
                                <template v-for="minute in ['00', '30']">
                                    <option  :value="formatTime(hour, minute)">{{formatTime(hour, minute)}}</option>
                                </template>
                            </template>
                        </select>
                    </td>
                </tr>
                <!-- errors -->
                <tr>
                    <p class="error" v-if="form.errors[getErrorString(day, 'from')]">
                        {{form.errors['days_times_driving.' + day + '.' + 'from']}}
                    </p>
                    <p class="error" v-else-if="form.errors[getErrorString(day, 'to')]">
                        {{form.errors['days_times_driving.' + day + '.' + 'to']}}
                    </p>
                    <p class="error" v-else-if="form.errors['days_times_driving.'+day]">
                        {{form.errors['days_times_driving.'+day]}}
                    </p>
                </tr>
            </template>
        </table>

        <p class="error" v-if="form.errors.days_times_driving">
            {{form.errors.days_times_driving}}
        </p>
</template>