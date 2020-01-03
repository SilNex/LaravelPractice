<template>
    <b-col md="2">
        <b-list-group-item v-for="link in links" :key="link.href" :href="link.href">
            {{link.name}}
        </b-list-group-item>
    </b-col>
</template>

<script>
export default {
    data() {
        return {
            links: [
                {
                    'href': '/login',
                    'name': 'Login'
                },
                {
                    'href': '/boards',
                    'name': 'Board list'
                }
            ]
        }
    }
};
</script>

<style>
</style>
