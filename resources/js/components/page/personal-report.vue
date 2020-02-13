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
              
            </v-layout>
          </v-container>
          <v-container grid-list-md>
            <template>
              <v-data-table :headers="headers" :items="employees" class="elevation-1">
                <template slot="headerCell" slot-scope="props">
                  <v-tooltip bottom>
                    <template v-slot:activator="{ on }">
                      <span v-on="on">{{ props.header.text }}</span>
                    </template>
                    <span>{{ props.header.text }}</span>
                  </v-tooltip>
                </template>
              </v-data-table>
              <v-snackbar v-model="snack" :timeout="3000" :color="snackColor">
                {{ snackText }}
                <v-btn flat @click="snack = false">Close</v-btn>
              </v-snackbar>
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
    date: null,
    modal: false,
    menu: false,
    events: [],
    types: ["InHouse", "Public", "Other"],
    typeSelect: null,
    courseCodeSelect: null,
    courses: [],
    course_name: null,
    inst_name: null,
    total: 0,
    location: null,
    number: 0,
    money: 0,
    headers: [
      {
        text: "ลำดับ",
        align: "left",
        sortable: false,
        value: "index"
      },
      { text: "หลักสูตร",  value: "course_name" },
      { text: "ค่าใช้จ่าย", value: "money" },
    ],
    employees: [],
    users: []
  }),
  methods: {
    getCourseCode() {
      axios.get("api/course").then(response => {
        this.courses = response.data;
        this.courseCode = this.courses.map(a => a.code);
      });
    },
    getUsers() {
      axios.get("api/user").then(response => {
        this.users = response.data;
      });
    },
    save() {
      axios
        .post("/api/event", {
          date: this.date,
          course_name: this.course_name,
          type: this.typeSelect,
          number: this.number,
          location: this.location,
          total: this.total,
          money: this.money
        })
        .then(
          response => {
            this.snack = true
            console.log(response);
          },
          error => {
            console.log(error);
          }
        );
      this.snack = true;
      this.snackColor = "success";
      this.snackText = "บันทึกแล้ว";
    },
    cancel() {
      this.snack = true;
      this.snackColor = "error";
      this.snackText = "ยกเลิก";
    },
    searchData(index, code) {
      let userSel = this.users.filter(user => {
        return user.code == code;
      });
      console.log(userSel[0].firstname);
      if (userSel) {
        this.employees[index - 1].Department = userSel[0].Department;
        this.employees[index - 1].firstname = userSel[0].firstname;
        this.employees[index - 1].lastname = userSel[0].lastname;
        this.employees[index - 1].position = userSel[0].position;
      }
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
