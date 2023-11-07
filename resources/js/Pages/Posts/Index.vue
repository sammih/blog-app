<script setup>
    import AppLayout from '@/Layouts/AppLayout.vue';
    import moment from "moment";

    defineProps({
        posts: Array,
    });
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Blog Posts
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="max-w-3xl mx-auto p-6">
                        <ul>
                            <li v-for="post in posts">
                                <div class="flex justify-between">
                                    <span class="bg-gray-100 px-2 py-1">{{ post.user.name }}</span>
                                    <!-- <span>{{ moment(post.created_at).format("DD-MM-YYYY").fromNow(true) }}</span> -->
                                    <span>{{ moment(post.created_at).fromNow() }}</span>
                                </div>
                                <h1>{{ post.title }}</h1>
                                <p>{{ post.content }}</p>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
