<template>
    <div class="pt-16">
        <h1 class="text-3xl font-semibold mb-4">Driver and car details</h1>
        <form action="#" @submit.prevent="handleSaveDriver">
            <div
                class="overflow-hidden shadow sm:rounded-md max-w-sm mx-auto text-left"
            >
                <div class="bg-white px-4 py-5 sm:p-6">
                    <div>
                        <input
                            v-model="driverDetails.name"
                            type="text"
                            name="name"
                            id="name"
                            placeholder="Full Name"
                            class="mt-1 block w-full px-3 py-2 rounded-md border border-gray-300 shadow-sm focus:border-black focus:outline-none"
                        />
                    </div>
                    <div class="mt-2">
                        <input
                            v-model="driverDetails.year"
                            type="number"
                            name="year"
                            id="year"
                            placeholder="Car Year"
                            class="mt-1 block w-full px-3 py-2 rounded-md border border-gray-300 shadow-sm focus:border-black focus:outline-none"
                        />
                    </div>
                    <div class="mt-2">
                        <input
                            v-model="driverDetails.make"
                            type="text"
                            name="make"
                            id="make"
                            placeholder="Make"
                            class="mt-1 block w-full px-3 py-2 rounded-md border border-gray-300 shadow-sm focus:border-black focus:outline-none"
                        />
                    </div>
                    <div class="mt-2">
                        <input
                            v-model="driverDetails.model"
                            type="text"
                            name="model"
                            id="model"
                            placeholder="Model"
                            class="mt-1 block w-full px-3 py-2 rounded-md border border-gray-300 shadow-sm focus:border-black focus:outline-none"
                        />
                    </div>
                    <div class="mt-2">
                        <input
                            v-model="driverDetails.color"
                            type="text"
                            name="color"
                            id="color"
                            placeholder="Color"
                            class="mt-1 block w-full px-3 py-2 rounded-md border border-gray-300 shadow-sm focus:border-black focus:outline-none"
                        />
                    </div>
                    <div class="mt-2">
                        <input
                            v-model="driverDetails.license_plate"
                            type="text"
                            name="license_plate"
                            id="license_plate"
                            placeholder="License Plate #"
                            class="mt-1 block w-full px-3 py-2 rounded-md border border-gray-300 shadow-sm focus:border-black focus:outline-none"
                        />
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                    <button
                        type="submit"
                        class="inline-flex justify-center rounded-md border border-transparent bg-black py-2 px-4 text-sm font-medium text-white shadow-sm hover:bg-gray-600 focus:outline-none"
                        @click.prevent="handleSaveDriver"
                    >
                        Continue
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>

<script setup>
import { reactive } from "vue";
import http from "../helpers/http";
import router from "../router";

const driverDetails = reactive({
    name: "",
    year: null,
    make: "",
    model: "",
    color: "",
    license_plate: "",
});

const handleSaveDriver = () => {
    http().post('/api/driver', driverDetails)
        .then((res) => {
            router.push({
                name: "standby",
            });
        }).catch((err) => {
            console.error(err);
        }); 
}
</script>

<style>
</style>