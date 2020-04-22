<template>
    <v-layout class="justify-end mt-3 mr-5 mb-3">
        <v-flex xs9 sm11>
            <v-toolbar flat color="white">
                <v-toolbar-title>
                    <h3>
                        <v-icon large color="blue"
                            >supervised_user_circle</v-icon
                        >&nbsp;สมาชิกในระบบ
                        <!-- <v-btn color="primary" dark class="mb-2 txt-title" @click="genBC">GenBC</v-btn> -->
                    </h3>
                </v-toolbar-title>
                <v-divider class="mx-2" inset vertical></v-divider>
                <v-spacer></v-spacer>
                <v-flex xs12 sm4 md2>
                    <v-text-field
                        v-model="search"
                        append-icon="search"
                        label="ค้นหา"
                        single-line
                    ></v-text-field>
                </v-flex>
                <v-dialog v-model="dialog" max-width="500px">
                    <template v-slot:activator="{ on }">
                        <v-btn color="primary" dark class="mb-2" v-on="on"
                            >เพิ่มสมาชิก</v-btn
                        >
                    </template>
                    <v-card>
                        <v-card-title>
                            <h2 class="txt-title">{{ formTitle }}</h2>
                        </v-card-title>
                        <v-card-text>
                            <v-container grid-list-md>
                                <v-layout wrap>
                                    <v-flex xs12 sm6 md4>
                                        <v-select
                                            :items="name_titles"
                                            v-model="editItem.name_title"
                                            item-text="name_title"
                                            label="คำนำหน้าชื่อ*"
                                            v-validate="'required'"
                                            data-vv-name="name_title"
                                            :error-messages="
                                                errors.collect('name_title')
                                            "
                                            required
                                        ></v-select>
                                    </v-flex>
                                    <v-flex xs12 sm6 md4>
                                        <v-text-field
                                            v-validate="'required'"
                                            v-model="editItem.firstname"
                                            label="ชื่อ*"
                                            data-vv-name="firstname"
                                            :error-messages="
                                                errors.collect('firstname')
                                            "
                                        ></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md4>
                                        <v-text-field
                                            v-validate="'required'"
                                            v-model="editItem.lastname"
                                            label="นามสกุล*"
                                            data-vv-name="lastname"
                                            :error-messages="
                                                errors.collect('lastname')
                                            "
                                        ></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md4>
                                        <v-select
                                            :items="statusSex"
                                            v-model="editItem.sex"
                                            item-text="title"
                                            label="เพศ*"
                                            v-validate="'required'"
                                            data-vv-name="sex"
                                            :error-messages="
                                                errors.collect('sex')
                                            "
                                            required
                                        ></v-select>
                                    </v-flex>
                                    <v-flex xs12 sm6 md4>
                                        <v-text-field
                                            v-validate="'required'"
                                            v-model="editItem.code"
                                            label="รหัส*"
                                            data-vv-name="code"
                                            :error-messages="
                                                errors.collect('code')
                                            "
                                        ></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md4>
                                        <v-autocomplete
                                            :items="statusDepartment"
                                            v-model="editItem.department"
                                            item-text="name"
                                            item-value="id"
                                            label="แผนก*"
                                            v-validate="'required'"
                                            data-vv-name="department"
                                            :error-messages="
                                                errors.collect('department')
                                            "
                                            required
                                        ></v-autocomplete>
                                    </v-flex>
                                    <v-flex xs12 sm6 md4>
                                        <v-text-field
                                            v-model="editItem.position"
                                            v-validate="'required'"
                                            label="ตำแหน่ง*"
                                            data-vv-name="position"
                                            :error-messages="
                                                errors.collect('position')
                                            "
                                        ></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md8>
                                        <v-text-field
                                            v-model="editItem.email"
                                            v-validate="'required'"
                                            label="อีเมล*"
                                            data-vv-name="email"
                                            :error-messages="
                                                errors.collect('email')
                                            "
                                        ></v-text-field>
                                    </v-flex>
                                    <v-flex xs12>
                                        <v-text-field
                                            v-if="editIndex == '-1'"
                                            v-model="editItem.password"
                                            v-validate="'required'"
                                            label="รหัสผ่าน*"
                                            type="password"
                                            data-vv-name="password"
                                            :error-messages="
                                                errors.collect('password')
                                            "
                                        ></v-text-field>
                                    </v-flex>
                                </v-layout>
                            </v-container>
                        </v-card-text>
                        <v-card-actions>
                            <v-spacer></v-spacer>
                            <v-btn color="blue darken-1" flat @click="close"
                                >ยกเลิก</v-btn
                            >
                            <v-btn color="blue darken-1" flat @click="save"
                                >บันทึก</v-btn
                            >
                        </v-card-actions>
                    </v-card>
                </v-dialog>
            </v-toolbar>
            <v-data-table
                :headers="headers"
                :items="filterUsers"
                :search="search"
                :pagination.sync="pagination"
                class="elevation-1"
            >
                <template slot="headerCell" slot-scope="props">
                    <v-tooltip bottom>
                        <template v-slot:activator="{ on }">
                            <span v-on="on">{{ props.header.text }}</span>
                        </template>
                        <span>{{ props.header.text }}</span>
                    </v-tooltip>
                </template>
                <template v-slot:items="props">
                    <td>{{ props.item.name_title }}</td>
                    <td>{{ props.item.firstname }}</td>
                    <td>{{ props.item.lastname }}</td>
                    <td>{{ props.item.code }}</td>
                    <td>{{ props.item.department.name }}</td>
                    <td>{{ props.item.position }}</td>
                    <td>{{ props.item.email }}</td>
                    <td class="justify-center layout px-0">
                        <v-icon
                            small
                            class="mr-2"
                            @click="editUser(props.item.id, props.item)"
                            >edit</v-icon
                        >
                        <v-icon
                            small
                            @click="deleteUser(props.item.id, props.item)"
                            >delete</v-icon
                        >
                    </td>
                </template>
                <template v-slot:no-results>
                    <v-alert :value="true" color="error" icon="warning"
                        >Your search for "{{ search }}" found no
                        results.</v-alert
                    >
                </template>
            </v-data-table>
        </v-flex>
        <v-snackbar
            class="txt-title"
            v-model="snackbar"
            :color="color"
            :timeout="3000"
        >
            บันทึกสำเร็จแล้ว
            <v-btn dark flat @click="snackbar = false">
                <v-icon>close</v-icon>
            </v-btn>
        </v-snackbar>
    </v-layout>
</template>

<script>
export default {
    $_veeValidate: {
        validator: "new"
    },
    data: () => ({
        pagination: {
            rowsPerPage: 12
        },
        snackbar: false,
        color: "success",
        editid: null,
        search: "",
        selected: "",
        dialog: false,
        dialog2: false,
        statusTypes: ["General", "Manager", "HR"],
        statusSex: ["ชาย", "หญิง"],
        headers: [
            { text: "คำนำหน้าชื่อ", sortable: false, value: "name_title" },
            { text: "ชื่อ", sortable: false, value: "firstname" },
            { text: "นามสกุล", sortable: false, value: "lastname" },
            { text: "รหัส", value: "code" },
            { text: "แผนก", sortable: false, value: "department" },
            { text: "ตำแหน่ง", value: "position" },
            { text: "อีเมล", value: "email" }
        ],
        users: [],
        name_titles: ["นาย", "นาง", "นางสาว"],
        statusDepartment: [
            "HRD",
            "ช่างเทคนิค",
            "อะไหล่",
            "Call center",
            "CRL",
            "SA",
            "BP"
        ],
        editIndex: -1,
        editItem: {
            name_title: "",
            firstname: "",
            lastname: "",
            sex: "",
            code: "",
            department: "",
            position: "",
            email: "",
            password: ""
        },
        defaultItem: {
            name_title: "",
            firstname: "",
            lastname: "",
            sex: "",
            code: "",
            department: "",
            position: "",
            email: "",
            password: ""
        },
        statusDepartment: []
    }),
    filters: {
        capitalize: function(str) {
            return str.charAt(0).toUpperCase() + str.slice(1);
        }
    },
    computed: {
        formTitle() {
            return this.editIndex === -1
                ? "เพิ่มสมาชิกใหม่"
                : "แก้ไขข้อมูลสมาชิก";
        },
        filterUsers() {
            return this.users.filter(user => {
                return (
                    user.firstname.match(this.search) ||
                    user.lastname.match(this.search) ||
                    user.code.match(this.search)
                );
            });
        },
        checkInput: function() {
            if (
                this.editItem.name_title &&
                this.editItem.firstname &&
                this.editItem.lastname &&
                this.editItem.sex &&
                this.editItem.code &&
                this.editItem.department &&
                this.editItem.position &&
                this.editItem.email &&
                this.editItem.password
            ) {
                return true;
            } else {
                return false;
            }
        }
    },
    watch: {
        dialog(val) {
            val || this.close();
        }
    },
    created() {
        this.getUserData();
        this.getDepartment();
    },
    methods: {
        getUserData() {
            axios.get("api/user").then(response => {
                this.users = response.data;
            });
        },
        getDepartment() {
            axios.get("api/department").then(response => {
                this.statusDepartment = response.data;
            });
        },
        editUser(id, item) {
            this.editIndex = this.users.indexOf(item);
            this.editItem = Object.assign({}, item);
            this.dialog = true;
            this.editid = id;
        },
        deleteUser(id, item) {
            const index = this.users.indexOf(item);
            confirm("ต้องการจะลบใช่หรือไม่?") &&
                this.users.splice(index, 1) &&
                axios.delete("api/user/" + id).catch(error => {
                    console.log(error);
                });
        },
        close() {
            this.$validator.reset();
            this.dialog = false;
            this.editItem = Object.assign({}, this.defaultItem);
            this.editIndex = -1;
        },
        save() {
            this.$validator.validateAll();
            if (this.editIndex > -1) {
                Object.assign(this.users[this.editIndex], this.editItem) &&
                    axios.put("/api/user/" + this.editid, {
                        name_title: this.editItem.name_title,
                        firstname: this.editItem.firstname,
                        lastname: this.editItem.lastname,
                        sex: this.editItem.sex,
                        code: this.editItem.code,
                        department: this.editItem.department.name,
                        position: this.editItem.position,
                        email: this.editItem.email
                    });
                this.snackbar = true;
                this.close();
            } else {
                if (this.checkInput) {
                    this.users.push(this.editItem) &&
                        axios.post("/api/user", {
                            name_title: this.editItem.name_title,
                            firstname: this.editItem.firstname,
                            lastname: this.editItem.lastname,
                            sex: this.editItem.sex,
                            code: this.editItem.code,
                            department: this.editItem.department,
                            position: this.editItem.position,
                            email: this.editItem.email,
                            start_date: new Date().toISOString().substr(0, 10),
                            password: this.editItem.password
                        });
                    this.snackbar = true;
                    this.close();
                }
            }
        }
    }
};
</script>

<style scoped>
table {
    border-collapse: collapse;
    width: 100%;
}

th,
td {
    text-align: left;
    padding: 8px;
    font-size: 20px;
}

tr:nth-child(even) {
    background-color: #f2f2f2;
}
</style>
