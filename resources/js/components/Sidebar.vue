<template>
    <nav id="sidebar">
        <div class="sidebar-header">
            <h3>Bootstrap Sidebar</h3>
        </div>

        <ul class="list-unstyled components">

            <li v-bind:class="{ active: $route.name == 'home'}">
                <router-link :to="{ name: 'home' }">Home</router-link>
            </li>

            <li v-bind:class="{ active: $route.name == 'view'}">
                <router-link :to="{ name: 'view' }">View Contacts</router-link>
            </li>

            <li v-bind:class="{ active: $route.name == 'manage'}">
                <router-link :to="{ name: 'manage' }">Manage Contacts</router-link>
            </li>

            <li v-bind:class="{ active: $route.name == 'history'}">
                <router-link :to="{ name: 'history' }">Changes History</router-link>
            </li>
        </ul>

    </nav>
</template>