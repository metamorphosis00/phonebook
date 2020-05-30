<template>
    <v-data-table
        :headers="headers"
        :items="contacts"
        :items-per-page="5"
        class="elevation-1"
    >
        <template v-slot:top>
            <v-toolbar flat color="white">
                <v-toolbar-title>Manage Contacts</v-toolbar-title>
                <v-divider
                    class="mx-4"
                    inset
                    vertical
                ></v-divider>
                <v-spacer></v-spacer>
                <v-dialog v-model="dialog" max-width="500px">
                    <template v-slot:activator="{ on }">
                        <v-btn color="primary" dark class="mb-2" v-on="on">New Contact</v-btn>
                    </template>
                    <v-card>
                        <v-card-title>
                            <span class="headline">{{ formTitle }}</span>
                        </v-card-title>

                        <v-card-text>
                            <v-container>
                                <v-row>
                                    <v-col cols="12" sm="6" md="8">
                                        <v-text-field v-model="editedItem.name" label="Name"></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="6" md="6">
                                        <v-text-field v-model="editedItem.phone" label="Phone"></v-text-field>
                                    </v-col>
                                    <v-col cols="12" sm="6" md="6">
                                        <v-text-field v-model="editedItem.address" label="Address"></v-text-field>
                                    </v-col>
                                </v-row>
                            </v-container>
                        </v-card-text>

                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" text @click="close">Cancel</v-btn>
                            <v-btn color="blue darken-1" text @click="save">Save</v-btn>
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-toolbar>
        </template>
        <template v-slot:item.action="{ item }">
            <v-icon
                small
                class="mr-2"
                @click="editContact(item)"
            >
                mdi-pencil
            </v-icon>
            <v-icon
                small
                @click="deleteContact(item)"
            >
                mdi-delete
            </v-icon>
        </template>
        <template v-slot:no-data>
            <v-btn color="primary" @click="getContacts">Reset</v-btn>
        </template>
    </v-data-table>
</template>

<script>
    export default {
        data() {
            return {
                dialog: false,
                headers: [
                    {
                        text: 'Name',
                        value: 'name'
                    },
                    {
                        text: 'Phone',
                        value: 'phone'
                    },
                    {
                        text: 'Address',
                        value: 'address'
                    },
                    {
                        text: 'Actions',
                        value: 'action',
                        sortable: false
                    }
                ],
                contacts: [],
                editedIndex: -1,
                editedItem: {
                    name: '',
                    phone: '',
                    address: '',
                },
                defaultItem: {
                    name: '',
                    phone: '',
                    address: '',
                },
            }
        },
        created() {
            this.getContacts();
        },
        computed: {
            formTitle() {
                return this.editedIndex === -1 ? 'New Contact' : 'Edit Contact'
            },
        },
        methods: {
            getContacts(page = 1) {
                let uri = `${process.env.MIX_APP_URL}/api/contacts`;
                axios.get(uri).then(response => {
                    this.contacts = response.data.data;
                });
            },
            deleteContact(item) {
                let uri = `${process.env.MIX_APP_URL}/api/contact/delete/${item.id}`;
                axios.delete(uri).then(response => {
                    this.contacts.splice(this.contacts.indexOf(item), 1);
                });
            },
            editContact(item) {
                this.editedIndex = this.contacts.indexOf(item)
                this.editedItem = Object.assign({}, item)
                this.dialog = true
            },
            close() {
                this.dialog = false
                setTimeout(() => {
                    this.editedItem = Object.assign({}, this.defaultItem)
                    this.editedIndex = -1
                }, 300)
            },
            save() {
                if (this.editedIndex > -1) {
                    Object.assign(this.contacts[this.editedIndex], this.editedItem)
                    let uri = `${process.env.MIX_APP_URL}/api/contact/update/${this.editedItem.id}`;
                    axios.post(uri, this.editedItem).then((response) => {
                        this.close()
                    });
                } else {
                    this.contacts.push(this.editedItem)
                    let uri = `${process.env.MIX_APP_URL}/api/contact/create`;
                    axios.post(uri, this.editedItem).then((response) => {
                        this.close()
                    });
                }
            },
        }
    }
</script>
