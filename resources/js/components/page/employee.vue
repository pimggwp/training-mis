<template>
    <v-layout class="justify-end mt-3 mr-5 mb-3">
        <v-flex xs9 sm11>
            <v-toolbar flat color="white">
                <v-toolbar-title>
                    <h3>
                        <v-icon large color="blue">group</v-icon
                        >&nbsp;รายชื่อพนักงาน
                        <!-- <v-btn color="primary" dark class="mb-2 txt-title" @click="genBC">GenBC</v-btn> -->
                    </h3>
                </v-toolbar-title>
                <v-divider class="mx-2" inset vertical></v-divider>
                <v-spacer></v-spacer>
                <v-flex xs12 sm4 md2>
                    <v-select
                        :items="typeSelect"
                        v-model="typeSelected"
                    ></v-select>
                </v-flex>
                <v-flex xs12 sm4 md2 class="ml-2">
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
                            >เพิ่มพนักงาน</v-btn
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
                                        <v-text-field
                                            v-validate="'required'"
                                            v-model="editItem.employee_code"
                                            label="รหัสพนักงาน*"
                                            data-vv-name="employee_code"
                                            :error-messages="
                                                errors.collect('employee_code')
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
                                            v-validate="'required'"
                                            v-model="editItem.position"
                                            label="ตำแหน่ง*"
                                            data-vv-name="position"
                                            :error-messages="
                                                errors.collect('position')
                                            "
                                        ></v-text-field>
                                    </v-flex>
                                    <v-flex xs12 sm6 md4>
                                        <v-autocomplete
                                            :items="statusBranches"
                                            v-model="editItem.branch"
                                            item-text="name"
                                            item-value="id"
                                            label="สาขา*"
                                            v-validate="'required'"
                                            data-vv-name="branch"
                                            :error-messages="
                                                errors.collect('branch')
                                            "
                                            required
                                        ></v-autocomplete>
                                    </v-flex>
                                    <v-flex xs12 sm6 md4>
                                        <v-dialog
                                            ref="dialog2"
                                            v-model="modal1"
                                            :return-value.sync="
                                                editItem.start_date
                                            "
                                            persistent
                                            width="290px"
                                        >
                                            <template v-slot:activator="{ on }">
                                                <v-text-field
                                                    v-model="
                                                        editItem.start_date
                                                    "
                                                    label="เริ่มงาน"
                                                    prepend-icon="event"
                                                    readonly
                                                    v-on="on"
                                                    v-validate="'required'"
                                                    data-vv-name="start_date"
                                                    :error-messages="
                                                        errors.collect(
                                                            'start_date'
                                                        )
                                                    "
                                                    required
                                                ></v-text-field>
                                            </template>
                                            <v-date-picker
                                                v-model="editItem.start_date"
                                                scrollable
                                            >
                                                <v-spacer></v-spacer>
                                                <v-btn
                                                    text
                                                    color="primary"
                                                    @click="modal1 = false"
                                                    >Cancel</v-btn
                                                >
                                                <v-btn
                                                    text
                                                    color="primary"
                                                    @click="
                                                        (modal1 = false),
                                                            $refs.dialog2.save(
                                                                editItem.start_date
                                                            )
                                                    "
                                                    >OK</v-btn
                                                >
                                            </v-date-picker>
                                        </v-dialog>
                                    </v-flex>
                                    <v-flex xs12 sm6 md4>
                                        <v-dialog
                                            ref="dialog"
                                            v-model="modal2"
                                            :return-value.sync="
                                                editItem.end_date
                                            "
                                            persistent
                                            width="290px"
                                        >
                                            <template v-slot:activator="{ on }">
                                                <v-text-field
                                                    v-model="editItem.end_date"
                                                    label="ออกจากงาน"
                                                    prepend-icon="event"
                                                    readonly
                                                    v-on="on"
                                                ></v-text-field>
                                            </template>
                                            <v-date-picker
                                                v-model="editItem.end_date"
                                                scrollable
                                            >
                                                <v-spacer></v-spacer>
                                                <v-btn
                                                    text
                                                    color="primary"
                                                    @click="modal2 = false"
                                                    >Cancel</v-btn
                                                >
                                                <v-btn
                                                    text
                                                    color="primary"
                                                    @click="
                                                        (modal2 = false),
                                                            $refs.dialog.save(
                                                                editItem.end_date
                                                            )
                                                    "
                                                    >OK</v-btn
                                                >
                                            </v-date-picker>
                                        </v-dialog>
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
                :items="filterEmployees"
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
                    <td>
                        {{ props.item.branch ? props.item.branch.name : "-" }}
                    </td>
                    <td>{{ props.item.name_title }}</td>
                    <td>{{ props.item.firstname }}</td>
                    <td>{{ props.item.lastname }}</td>
                    <td>{{ props.item.employee_code }}</td>
                    <td>
                        {{
                            props.item.department
                                ? props.item.department.name
                                : "-"
                        }}
                    </td>
                    <td>{{ props.item.position }}</td>
                    <td>{{ props.item.start_date }}</td>
                    <td>
                        {{ props.item.end_date ? props.item.end_date : "-" }}
                    </td>
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
            rowsPerPage: 10
        },
        snackbar: false,
        color: "success",
        editid: null,
        search: "",
        selected: "",
        dialog: false,
        dialog2: false,
        modal1: false,
        modal2: false,
        typeSelected: "พนักงานปัจจุบัน",
        typeSelect: ["พนักงานปัจจุบัน", "พนักงานที่ลาออกไปแล้ว"],
        statusTypes: ["General", "Manager", "HR"],
        statusSex: ["ชาย", "หญิง"],
        headers: [
            { text: "สาขา", sortable: false, value: "branch" },
            { text: "คำนำหน้าชื่อ", sortable: false, value: "name_title" },
            { text: "ชื่อ", sortable: false, value: "firstname" },
            { text: "นามสกุล", sortable: false, value: "lastname" },
            { text: "รหัสพนักงาน", sortable: false, value: "employee_code" },
            { text: "แผนก", sortable: false, value: "department" },
            { text: "ตำแหน่ง", sortable: false, value: "position" },
            { text: "วันที่เริ่มทำงาน", sortable: false, value: "start_date" },
            { text: "วันที่ออกจากงาน", sortable: false, value: "end_date" }
        ],
        employees: [],
        name_titles: ["นาย", "นาง", "น.ส."],
        statusDepartment: [],
        statusBranches: [],
        editIndex: -1,
        editItem: {
            name_title: "",
            firstname: "",
            lastname: "",
            employee_code: "",
            department: "",
            position: "",
            branch: "",
            start_date: "",
            end_date: ""
        },
        defaultItem: {
            name_title: "",
            firstname: "",
            lastname: "",
            employee_code: "",
            department: "",
            position: "",
            branch: "",
            start_date: "",
            end_date: ""
        }
    }),
    filters: {
        capitalize: function(str) {
            return str.charAt(0).toUpperCase() + str.slice(1);
        }
    },
    computed: {
        formTitle() {
            return this.editIndex === -1
                ? "เพิ่มพนักงานใหม่"
                : "แก้ไขข้อมูลพนักงาน";
        },
        filterEmployees() {
            if (this.typeSelected === this.typeSelect[0]) {
                return this.employees.filter(employee => {
                    return (
                        (employee.firstname.match(this.search) ||
                            employee.lastname.match(this.search) ||
                            employee.employee_code.match(this.search)) &&
                        employee.end_date === null
                    );
                });
            } else {
                return this.employees.filter(employee => {
                    return (
                        (employee.firstname.match(this.search) ||
                            employee.lastname.match(this.search) ||
                            employee.employee_code.match(this.search)) &&
                        employee.end_date !== null
                    );
                });
            }
        },
        checkInput: function() {
            if (
                this.editItem.name_title &&
                this.editItem.firstname &&
                this.editItem.lastname &&
                this.editItem.employee_code &&
                this.editItem.department &&
                this.editItem.position &&
                this.editItem.branch &&
                this.editItem.start_date
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
        this.getBranch();
    },
    methods: {
        getUserData() {
            axios.get("api/employee").then(response => {
                this.employees = response.data;
            });
        },
        getDepartment() {
            axios.get("api/department").then(response => {
                this.statusDepartment = response.data;
            });
        },
        getBranch() {
            axios.get("api/branch").then(response => {
                this.statusBranches = response.data;
            });
        },
        editUser(id, item) {
            this.editIndex = this.employees.indexOf(item);
            this.editItem = Object.assign({}, item);
            this.dialog = true;
            this.editid = id;
        },
        deleteUser(id, item) {
            const index = this.employees.indexOf(item);
            confirm("ต้องการจะลบใช่หรือไม่?") &&
                this.employees.splice(index, 1) &&
                axios.delete("api/employee/" + id).catch(error => {
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
                Object.assign(this.employees[this.editIndex], this.editItem) &&
                    axios.put("/api/employee/" + this.editid, {
                        name_title: this.editItem.name_title,
                        firstname: this.editItem.firstname,
                        lastname: this.editItem.lastname,
                        employee_code: this.editItem.employee_code,
                        department_id: this.editItem.department.id,
                        position: this.editItem.position,
                        branch_id: this.editItem.branch.id,
                        start_date: this.editItem.start_date,
                        end_date: this.editItem.end_date
                    });
                this.snackbar = true;
                this.close();
            } else {
                if (this.checkInput) {
                    this.employees.push(this.editItem) &&
                        axios.post("/api/employee", {
                            name_title: this.editItem.name_title,
                            firstname: this.editItem.firstname,
                            lastname: this.editItem.lastname,
                            employee_code: this.editItem.employee_code,
                            department_id: this.editItem.department,
                            position: this.editItem.position,
                            branch_id: this.editItem.branch,
                            start_date: this.editItem.start_date,
                            end_date: this.editItem.end_date
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
