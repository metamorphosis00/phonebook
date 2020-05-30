<template>
    <v-app id="inspire">
        <v-navigation-drawer
            app
            v-model="drawer"
        >
            <!-- -->
            <v-list-item>
                <v-list-item-content>
                    <v-list-item-title class="title">
                        Contacts Notebook
                    </v-list-item-title>
                </v-list-item-content>
            </v-list-item>

            <v-divider></v-divider>

            <v-list
                dense
            >
                <v-list-item
                    v-for="item in items"
                    :key="item.title"
                    :to="{ name: item.name }"
                    exact
                >
                    <v-list-item-icon>
                        <v-icon>{{ item.icon }}</v-icon>
                    </v-list-item-icon>

                    <v-list-item-content>
                        <v-list-item-title>
                            {{ item.title }}
                        </v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar app>
            <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
        </v-app-bar>

        <!-- Sizes your content based upon application components -->
        <v-content>

            <!-- Provides the application the proper gutter -->
            <v-container
                fluid
                class="fill-height">

                <!-- If using vue-router -->
                <router-view></router-view>
            </v-container>
        </v-content>

        <v-footer app>
            <span>Vuetify</span>
            <v-spacer />
            <span>&copy; 2019</span>
        </v-footer>
    </v-app>
</template>
<script>
    export default {
        data () {
            return {
                items: [
                    { title: 'Dashboard',       icon: 'mdi-view-dashboard', name: 'home'},
                    { title: 'Manage Contacts', icon: 'mdi-account-edit',   name: 'manage'},
                ],
                right: null,
                drawer: null,
            }
        },
    }
</script>
