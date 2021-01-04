<template>
    <nav class="navbar navbar-expand-sm navbar-light bg-light mb-2">
        <div class="container">
            <div class="d-flex">
                <a class="navbar-brand" href="#">Test Project</a>
                <router-link :to="{name:'dashboard'}" class="navbar-brand">Home</router-link>
<!--                <router-link :to="{name:'About'}" class="navbar-brand">About</router-link>-->
                <router-link :to="{name:'todoList'}" class="navbar-brand">Todo List</router-link>
                <router-link :to="{name:'gallery'}" class="navbar-brand">Gallery</router-link>
            </div>

        </div>
    </nav>
</template>

<script>
export default {
    data() {
        return {}
    },
    mounted() {
    },
    methods: {}
}
</script>

