<template>
  <v-layout class="justify-end mt-3 mr-5 mb-3">
    <v-flex xs9 sm11>
      <h2 class="txt-title mt-2">
        <h2>
          <v-icon large color="blue">collections_bookmark</v-icon>&nbsp;ประวัติการฝึกอบรมรายบุคคล
        </h2>
      </h2>
      <br />
      <v-card>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap>
              <v-flex xs12 sm6 md6>
                <v-text-field
                  @keyup.enter="searchData()"
                  v-model="employee_code"
                  v-validate="'required'"
                  label="รหัสพนักงานที่ต้องการดูประวัติ (enter)"
                ></v-text-field>
              </v-flex>
            </v-layout>
          </v-container>
          <v-container grid-list-md v-if="is_search">
            <h1>รหัสสมาชิก : {{employee[0].employee_code}}</h1>
            <h2>ชื่อ-นามสกุล : {{employee[0].name_title + employee[0].firstname +' '+ employee[0].lastname}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; ตำแหน่ง : {{employee[0].position}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; วันที่เข้างาน : {{employee[0].start_date}}</h2>
            <h2>เคยผ่านการอบรมมาแล้วรวมเป็นจำนวน &nbsp; {{employeesEvents.length}} &nbsp; ครั้ง &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; งบประมาณ &nbsp; {{total}} &nbsp; บาท</h2>
          </v-container>
          <v-container grid-list-md>
            <template>
              <v-data-table :headers="headers" :items="employeesEvents" class="elevation-1">
                <template slot="headerCell" slot-scope="props">
                  <v-tooltip bottom>
                    <template v-slot:activator="{ on }">
                      <span v-on="on">{{ props.header.text }}</span>
                    </template>
                    <span>{{ props.header.text }}</span>
                  </v-tooltip>
                </template>
                <template v-slot:items="props">
                  <td>{{ props.index + 1 }}</td>
                  <td>{{ props.item.course.name }}</td>
                  <td>{{ props.item.money }}</td>
                </template>
              </v-data-table>
            </template>
          </v-container>
        </v-card-text>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
export default {
  mounted() {
    this.getCourseCode();
    this.getUsers();
  },
  watch: {
    courseCodeSelect: function(newValue) {
      this.course_name = newValue.name;
      this.inst_name = newValue.instructor;
    },
    total: function(newValue) {
      this.employees = [];
      for (let i = 0; i < newValue; i++) {
        this.employees.push({
          index: i + 1,
          code: "กรุณากรอกรหัส",
          Department: null,
          firstname: null,
          lastname: null,
          position: null
        });
      }
    }
  },
  data: () => ({
    snack: false,
    snackColor: "",
    snackText: "",
    total: 0,
    employee_code: null,
    date: null,
    modal: false,
    menu: false,
    events: [],
    typeSelect: null,
    courseCodeSelect: null,
    courses: [],
    total: 0,
    money: 0,
    headers: [
      {
        text: "ลำดับ",
        align: "left",
        sortable: false,
        value: "index"
      },
      { text: "หลักสูตร", value: "course_name" },
      { text: "ค่าใช้จ่าย", value: "money" }
    ],
    employee: [],
    emp_id: null,
    employeesEvents: [],
    is_search: false
  }),
  watch: {
    employeesEvents() {
      let total = 0;
      this.employeesEvents.forEach(element => {
        console.log(element);
        total = total + element.money;
      });
      this.total = total
    }
  },
  methods: {
    getEmployee() {
      axios.get("api/employee/" + this.employee_code).then(response => {
        this.employee = response.data;
        this.emp_id = this.employee[0].id;
        this.getEmployeeEvent(this.emp_id);
        this.is_search = true;
      });
    },
    getEmployeeEvent(emp_id) {
      axios.get("api/employee-event/" + emp_id).then(response => {
        this.employeesEvents = response.data;
      });
    },
    searchData() {
      this.getEmployee();
    }
  }
};
</script>


<style>
.no-upload {
  color: red;
  font-size: 3mm;
}
</style>
