<template>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">

            <button type="button" id="sidebarCollapse" class="btn btn-info">
                <i class="fas fa-align-left"></i>
                <span>Toggle Sidebar</span>
            </button>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fas fa-align-justify"></i>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav navbar-nav ml-auto">
                    <!--UNLOGGED-->
                    <li class="nav-item" v-if="!$auth.check()">
                        <router-link :to="{ name : 'login' }" class="nav-link">Login</router-link>
                    </li>
                    <li class="nav-item" v-if="!$auth.check()">
                        <router-link :to="{ name : 'register' }" class="nav-link">Register</router-link>
                    </li>

                    <!--LOGOUT-->
                    <li v-if="$auth.check()">
                        <a href="#" @click.prevent="$auth.logout()">Logout</a>
                    </li>

                </ul>
            </div>
        </div>
    </nav>
</template>