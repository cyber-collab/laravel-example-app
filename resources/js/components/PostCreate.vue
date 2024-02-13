<template>
    <div v-if="errors">
        <div v-for="(v, k) in errors" :key="k" class="bg-red-400 text-white rounded font-bold mb-4 shadow-lg py-2 px-4 pr-0">
            <p v-for="error in v" :key="error" class="text-sm">
                {{ error }}
            </p>
        </div>
    </div>

    <form class="space-y-6" @submit.prevent="savePost">
        <div class="space-y-4 rounded-md shadow-sm">
            <div>
                <label for="ad_id" class="block text-sm font-medium text-gray-700">Ad Id</label>
                <div class="mt-1">
                    <input type="text" name="ad_id" id="ad_id"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="form.ad_id">
                </div>
            </div>

            <div>
                <label for="impressions" class="block text-sm font-medium text-gray-700">Impressions</label>
                <div class="mt-1">
                    <input type="text" name="impressions" id="impressions"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="form.impressions">
                </div>
            </div>

            <div>
                <label for="clicks" class="block text-sm font-medium text-gray-700">Clicks</label>
                <div class="mt-1">
                    <input type="text" name="clicks" id="clicks"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="form.clicks">
                </div>
            </div>

            <div>
                <label for="unique_clicks" class="block text-sm font-medium text-gray-700">Unique Clicks</label>
                <div class="mt-1">
                    <input type="text" name="unique_clicks" id="unique_clicks"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="form.unique_clicks">
                </div>
            </div>

            <div>
                <label for="leads" class="block text-sm font-medium text-gray-700">Leads</label>
                <div class="mt-1">
                    <input type="text" name="leads" id="leads"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="form.leads">
                </div>
            </div>

            <div>
                <label for="conversion" class="block text-sm font-medium text-gray-700">Conversion</label>
                <div class="mt-1">
                    <input type="text" name="conversion" id="conversion"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="form.conversion">
                </div>
            </div>

            <div>
                <label for="roi" class="block text-sm font-medium text-gray-700">Roi</label>
                <div class="mt-1">
                    <input type="text" name="roi" id="roi"
                           class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                           v-model="form.roi">
                </div>
            </div>
        </div>

        <button type="submit"
                class="inline-flex items-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase bg-gray-800 rounded-md border border-transparent ring-gray-300 transition duration-150 ease-in-out hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring disabled:opacity-25">
            Create
        </button>
    </form>
</template>

<script setup>
import { reactive } from "vue";
import useDates from "@/composables/posts";

const form = reactive({
    'ad_id': '',
    'roi': '',
    'impressions': '',
    'clicks': '',
    'unique_clicks': '',
    'conversion': '',
    'leads': '',
})
const { errors, storePost } = useDates()
const savePost = async () => {
    await storePost({ ...form });
}
</script>
