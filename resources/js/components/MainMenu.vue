<template>
    <b-col md="2">
        <b-list-group-item v-for="link in links" :key="link">
            Link {{ link }}
        </b-list-group-item>
    </b-col>
</template>

<script>
export default {
    data() {
        return {
            links: []
        }
    },
    created() {
        axios.get("/api/links")
            .then((response) => {
                this.links = response.data
            });
    }
};
</script>

<style>
</style>
