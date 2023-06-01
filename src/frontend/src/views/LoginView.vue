<template>
    <div class="pt-16">
        <h1 class="text-3xl font-semibold mb-4">Enter your phone number</h1>
        <form
            action="#"
            @submit.prevent="handleLogin"
            v-if="!waitingForVerification"
        >
            <div
                class="overflow-hidden shadow sm:rounded-md max-w-sm mx-auto text-left"
            >
                <div class="bg-white px-4 py-5 sm:p-6">
                    <div>
                        <input
                            v-maska
                            v-model="credentials.phone"
                            data-maska="## (###) ###-####"
                            type="text"
                            name="phone"
                            id="phone"
                            placeholder="31 (234) 567-8910"
                            class="mt-1 block w-full px-3 py-2 rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
                        />
                    </div>
                    <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                        <button
                            @submit.prevent="handleLogin"
                            type="submit"
                            class="inline-flex justify-center rounded-md border border-transparent px-4 py-2 bg-black text-base font-medium text-white hover:bg-gray-700 focus:outline-none focus:border-gray-900 focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                        >
                            Continue
                        </button>
                    </div>
                </div>
            </div>
        </form>

        <form action="#" @submit.prevent="hanleVerification" v-else>
            <div
                class="overflow-hidden shadow sm:rounded-md max-w-sm mx-auto text-left"
            >
                <div class="bg-white px-4 py-5 sm:p-6">
                    <div>
                        <input
                            v-maska
                            v-model="credentials.login_code"
                            data-maska="######"
                            type="text"
                            name="phone"
                            id="phone"
                            placeholder="123456"
                            class="mt-1 block w-full px-3 py-2 rounded-md border border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-1 focus:ring-indigo-500"
                        />
                    </div>
                    <div class="bg-gray-50 px-4 py-3 text-right sm:px-6">
                        <button
                            @submit.prevent="hanleVerification"
                            type="submit"
                            class="inline-flex justify-center rounded-md border border-transparent px-4 py-2 bg-black text-base font-medium text-white hover:bg-gray-700 focus:outline-none focus:border-gray-900 focus:ring-2 focus:ring-offset-2 focus:ring-gray-500"
                        >
                            Verify
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
  

<script setup>
import { vMaska } from "maska";
import { computed, onMounted, reactive, ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
import http from "../helpers/http";

const router = useRouter();

const credentials = reactive({
    phone: null,
    login_code: null,
});

const waitingForVerification = ref(false);

onMounted(() => {
    if (localStorage.getItem("token")) {
        router.push({ 
            name: "landing" 
        });
    }
});

const getFormattedCredentials = () => {
    return {
        phone: credentials.phone.replaceAll(' ', '').replace('(', '').replace(')', '').replace('-', ''),
        login_code: credentials.login_code
    }
}

const hanleVerification = () => {
    http().post("api/login/verify", getFormattedCredentials())
        .then((res) => {
            console.log(res.data);
            localStorage.setItem("token", res.data);
            router.push({ 
                name: "landing" 
            });
        })
        .catch((err) => {
            console.error(err);
            alert(err.response.data.message);
        });
};

const handleLogin = () => {
    http().post("/api/login", getFormattedCredentials())
        .then((res) => {
            console.log(res.data);
            waitingForVerification.value = true;
        })
        .catch((err) => {
            console.error(err);
            console.error(err.response.data.message);
            alert(err.response.data.message);
        });
};
</script>

<style>
</style>