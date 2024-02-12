<template>
    <div class="overflow-hidden overflow-x-auto min-w-full align-middle sm:rounded-md">
        <div class="flex place-content-end mb-4">
            <div class="px-4 py-2 text-white bg-indigo-600 hover:bg-indigo-700 rounded-md cursor-pointer">
                <router-link :to="{ name: 'posts.create' }" class="text-sm font-medium">Add new post</router-link>
            </div>
        </div>
<!--
        <div v-if="successMessage" class="bg-green-200 p-4 mb-4 rounded-md">
            {{ successMessage }}
        </div>

        <div v-if="successUpdateMessage" class="bg-green-200 p-4 mb-4 rounded-md">
            {{ successUpdateMessage }}
        </div>

        <div v-if="successRemoveMessage" class="bg-green-200 p-4 mb-4 rounded-md">
            {{ successRemoveMessage }}
        </div> -->

        <table class="min-w-full border divide-y divide-gray-200">
            <thead>
                <tr>
                    <th class="px-6 py-3 bg-gray-50">
                    <span
                        class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Ad-id</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50">
                    <span
                        class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Impressions</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50">
                    <span
                        class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Clicks</span>
                    </th>

                    <th class="px-6 py-3 bg-gray-50">
                    <span
                        class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Unique Clicks</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50">
                    <span
                        class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Leads</span>
                    </th>
                    <th class="px-6 py-3 bg-gray-50">
                    <span
                        class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Conversion</span>
                    </th>
                    <th>
                    <span
                        class="text-xs font-medium tracking-wider leading-4 text-left text-gray-500 uppercase">Roi</span>
                    </th>
                </tr>
            </thead>

            <tbody class="bg-white divide-y divide-gray-200 divide-solid">
                <template v-for="item in posts" :key="item.id">
                    <tr class="bg-white">
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            {{ item.ad_id }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            {{ item.impressions }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            {{ item.clicks }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            {{ item.unique_clicks }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            {{ item.leads }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            {{ item.conversion }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            {{ item.roi }}
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-900 whitespace-no-wrap">
                            <router-link :to="{ name: 'posts.edit', params: { id: item.id } }"
                                class="mr-2 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Edit
                            </router-link>
                            <button @click="deleteAccount(item.id)"
                                    class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:ring ring-gray-300 disabled:opacity-25 transition ease-in-out duration-150">
                                Delete
                            </button>
                        </td>
                    </tr>
                </template>
            </tbody>
        </table>
    </div>
</template>

<script setup>
import usePosts from "@/composables/posts";
import { ref, onMounted } from "vue";
import { useRoute, useRouter } from "vue-router";

const { posts, getPosts, destroyPost } = usePosts()

onMounted(getPosts)

const successRemoveMessage = ref('');

const deleteAccount = async (id) => {
    if (!window.confirm('Are you sure?')) {
        return
    }
    await destroyPost(id);
    successRemoveMessage.value = 'Account successfully removed!';
    await getPosts();
}

const router = useRouter();
const route = useRoute();

let successMessage = route.query.successMessage || '';
let successUpdateMessage = route.query.successUpdateMessage || '';

if (successMessage || successUpdateMessage) {
    router.replace({ query: {} });
}
</script>
