<template>
  <v-layout class="justify-end mt-3 mr-5 mb-3">
    <v-flex xs9 sm11>
      <v-toolbar flat color="white">
        <v-toolbar-title>
          <h3>
            <v-icon large color="blue">group</v-icon>&nbsp;รายชื่อพนักงาน
            <!-- <v-btn color="primary" dark class="mb-2 txt-title" @click="genBC">GenBC</v-btn> -->
          </h3>
        </v-toolbar-title>
        <v-divider class="mx-2" inset vertical></v-divider>
        <v-spacer></v-spacer>
        <v-flex xs12 sm4 md2>
          <v-text-field v-model="search" append-icon="search" label="ค้นหา" single-line></v-text-field>
        </v-flex>
        <v-dialog v-model="dialog" max-width="500px">
          <template v-slot:activator="{ on }">
            <v-btn color="primary" dark class="mb-2" v-on="on">เพิ่มสมาชิก</v-btn>
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
                      :error-messages="errors.collect('name_title')"
                      required
                    ></v-select>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field
                      v-validate="'required'"
                      v-model="editItem.firstname"
                      label="ชื่อ*"
                      data-vv-name="firstname"
                      :error-messages="errors.collect('firstname')"
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field
                      v-validate="'required'"
                      v-model="editItem.lastname"
                      label="นามสกุล*"
                      data-vv-name="lastname"
                      :error-messages="errors.collect('lastname')"
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field
                      v-validate="'required'"
                      v-model="editItem.employee_code"
                      label="รหัสพนักงาน*"
                      data-vv-name="employee_code"
                      :error-messages="errors.collect('employee_code')"
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-autocomplete
                      :items="statusDepartment"
                      v-model="editItem.department"
                      item-text="department"
                      label="แผนก*"
                      v-validate="'required'"
                      data-vv-name="department"
                      :error-messages="errors.collect('department')"
                      required
                    ></v-autocomplete>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-select
                      :items="statusTypes"
                      v-model="editItem.position"
                      item-text="position"
                      label="ตำแหน่ง*"
                      v-validate="'required'"
                      data-vv-name="position"
                      :error-messages="errors.collect('position')"
                      required
                    ></v-select>
                  </v-flex>
                </v-layout>
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" flat @click="close">ยกเลิก</v-btn>
              <v-btn color="blue darken-1" flat @click="save">บันทึก</v-btn>
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
          <td>{{ props.item.branch? props.item.branch.name : '-' }}</td>
          <td>{{ props.item.name_title }}</td>
          <td>{{ props.item.firstname }}</td>
          <td>{{ props.item.lastname }}</td>
          <td>{{ props.item.employee_code }}</td>
          <td>{{ props.item.department? props.item.department.name : '-' }}</td>
          <td>{{ props.item.position }}</td>
          <td>{{ props.item.start_date }}</td>
          <td class="justify-center layout px-0">
            <v-icon small class="mr-2" @click="editUser(props.item.id,props.item)">edit</v-icon>
            <v-icon small @click="deleteUser(props.item.id,props.item)">delete</v-icon>
          </td>
        </template>
        <template v-slot:no-results>
          <v-alert
            :value="true"
            color="error"
            icon="warning"
          >Your search for "{{ search }}" found no results.</v-alert>
        </template>
      </v-data-table>
    </v-flex>
    <v-snackbar class="txt-title" v-model="snackbar" :color="color" :timeout="3000">
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
    statusTypes: ["General", "Manager", "HR"],
    statusSex: ["ชาย", "หญิง"],
    headers: [
      { text: "สาขา", sortable: false, value: "branch" },
      { text: "คำนำหน้าชื่อ", sortable: false, value: "name_title" },
      { text: "ชื่อ", sortable: false, value: "firstname" },
      { text: "นามสกุล", sortable: false, value: "lastname" },
      { text: "รหัสพนักงาน", sortable: false,value: "employee_code" },
      { text: "แผนก", sortable: false, value: "department" },
      { text: "ตำแหน่ง", sortable: false,value: "position" },
      { text: "วันที่เริ่มทำงาน", sortable: false,value: "start_date" }
    ],
    employees: [],
    name_titles: ["นาย", "นาง", "น.ส."],
    statusDepartment: ["FIN", "PDD", "PCD", "HRD"],
    editIndex: -1,
    editItem: {
      name_title: "",
      firstname: "",
      lastname: "",
      sex: "",
      employee_code: "",
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
      employee_code: "",
      department: "",
      position: "",
      email: "",
      password: ""
    }
  }),
  filters: {
    capitalize: function(str) {
      return str.charAt(0).toUpperCase() + str.slice(1);
    }
  },
  computed: {
    formTitle() {
      return this.editIndex === -1 ? "เพิ่มสมาชิกใหม่" : "แก้ไขข้อมูลสมาชิก";
    },
    filterEmployees() {
      return this.employees.filter(employee => {
        return (
          employee.firstname.match(this.search) ||
          employee.lastname.match(this.search)
        );
      });
    },
    checkInput: function() {
      if (
        this.editItem.name_title &&
        this.editItem.firstname &&
        this.editItem.lastname &&
        this.editItem.sex &&
        this.editItem.employee_code &&
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
  },
  methods: {
    getUserData() {
      axios.get("api/employee").then(response => {
        this.employees = response.data;
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
            sex: this.editItem.sex,
            employee_code: this.editItem.employee_code,
            department: this.editItem.department,
            position: this.editItem.position,
            email: this.editItem.email
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
              sex: this.editItem.sex,
              employee_code: this.editItem.employee_code,
              department: this.editItem.department_id,
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