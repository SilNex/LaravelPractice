<template>
    <b-col md="2">
        <b-list-group-item v-for="link in links" :key="link.href" @click="setSubMenu(link.href)">
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
    },
    methods: {
        setSubMenu: function (href) {
            var subMenu = axios.get(href)
                .then(function (response) {
                    if (response.status === 200 && typeof(response.data) === "object") {
                        return response.data
                    } else {
                        return false;
                    }
                })
            if(subMenu) {
                // console.log(subMenu)
                // need event bus
            }
        },

    }
};
</script>

<style>
</style>
