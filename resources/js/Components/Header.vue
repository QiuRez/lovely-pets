<template>
    <header>
        <Link href="/">Home</Link>
        <Link v-if="isLogged" href="/pets/list">Pets</Link>
        <Link v-if="isLogged" href="/users/logout" method="post">Logout</Link>
        <Link v-if="!isLogged" href="/users/register">Register</Link>
        <Link v-if="!isLogged" href="/users/login">LogIn</Link>
    </header>
</template>

<style scoped>
    header {
        width: 100%;
        height: 24px;
        background-color: bisque;
        position: relative;
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0 10px;
        z-index: 1;
        a {
            text-decoration: none;
            color: black;
        }
    }
</style>

<script setup>
import { usePage, Link } from "@inertiajs/vue3";

const page = usePage()

const isLogged = !!page.props.auth.user

</script>
