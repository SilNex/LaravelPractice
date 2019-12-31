<template>
    <b-col md="2">
        <b-list-group-item v-for="link in [1,2,3,4]" :key="link">
            Link {{ link }}
        </b-list-group-item>
    </b-col>
</template>

<script>
export default {

}
</script>

<style>

</style>