<template>
  <v-layout class="justify-end mt-3 mr-5 mb-3">
    <v-flex xs9 sm11>
      <h2 class="txt-title mt-2">
        <h2>
          <v-icon large color="blue">assignment_turned_in</v-icon>&nbsp;บันทึกข้อมูลการฝึกอบรม
        </h2>
      </h2>
      <br />
      <v-card>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap>
              <v-flex xs12 sm6 md6>
                <v-menu
                  ref="menu"
                  v-model="menu"
                  :close-on-content-click="false"
                  :nudge-right="40"
                  :return-value.sync="date"
                  lazy
                  transition="scale-transition"
                  offset-y
                  full-width
                  min-width="290px"
                >
                  <template v-slot:activator="{ on }">
                    <v-text-field
                      label="วันที่จัดอบรม*"
                      prepend-icon="event"
                      v-validate="'required'"
                      :error-messages="errors.collect('date')"
                      data-vv-name="date"
                      readonly
                      v-on="on"
                      v-model="date"
                      required
                    ></v-text-field>
                  </template>
                  <v-date-picker v-model="date" no-title scrollable locale="th">
                    <v-spacer></v-spacer>
                    <v-btn flat color="primary" @click="menu = false">ยกเลิก</v-btn>
                    <v-btn flat color="primary" @click="$refs.menu.save(date)">ตกลง</v-btn>
                  </v-date-picker>
                </v-menu>
              </v-flex>
              <v-flex xs12 sm6 md6>
                <v-select
                  :items="types"
                  v-model="typeSelect"
                  item-text="types"
                  label="ประเภท*"
                  v-validate="'required'"
                  data-vv-name="types"
                  :error-messages="errors.collect('types')"
                  required
                ></v-select>
              </v-flex>
              <v-flex xs12 sm6 md6>
                <v-autocomplete
                  item-text="code"
                  v-model="courseCodeSelect"
                  :items="courses"
                  label="รหัสหลักสูตร*"
                  v-validate="'required'"
                  data-vv-name="course_code"
                  :error-messages="errors.collect('course_code')"
                  required
                  return-object
                ></v-autocomplete>
              </v-flex>
              <v-flex xs12 sm6 md6>
                <v-text-field
                  v-model="number"
                  v-validate="'required'"
                  label="รุ่นที่*"
                  data-vv-name="number"
                  :error-messages="errors.collect('number')"
                ></v-text-field>
              </v-flex>
              <v-flex xs12 sm12 md12>
                <v-text-field v-model="course_name" label="ชื่อหลักสูตร*" disabled></v-text-field>
              </v-flex>
              <v-flex xs12 sm12 md12>
                <v-text-field v-model="inst_name" label="วิทยากรผู้บรรยาย*" disabled></v-text-field>
              </v-flex>
              <v-flex xs12 sm12 md12>
                <v-text-field
                  v-model="location"
                  v-validate="'required'"
                  label="สถานที่จัดอบรม*"
                  data-vv-name="location"
                  :error-messages="errors.collect('location')"
                ></v-text-field>
              </v-flex>
              <v-flex xs12 sm6 md6>
                <v-text-field
                  v-model="total"
                  v-validate="'required'"
                  label="จำนวนผู้เข้าอบรม*"
                  data-vv-name="total"
                  type="total"
                  :error-messages="errors.collect('total')"
                ></v-text-field>
              </v-flex>
              <v-flex xs12 sm6 md6>
                <v-text-field
                  v-model="money"
                  v-validate="'required'"
                  label="ค่าใช้จ่ายรวม*"
                  data-vv-name="money"
                  :error-messages="errors.collect('money')"
                ></v-text-field>
              </v-flex>
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
                <template v-slot:items="props">
                  <td>{{ props.item.index }}</td>
                  <td>
                    <v-edit-dialog
                      :return-value.sync="props.item.employee_code"
                      lazy
                      @save="searchData(props.item.index, props.item.employee_code)"
                      @cancel="cancel"
                    >
                      {{ props.item.employee_code }}
                      <template v-slot:input>
                        <v-text-field
                          v-model="props.item.employee_code"
                          label="Edit"
                          single-line
                          counter
                        ></v-text-field>
                      </template>
                    </v-edit-dialog>
                  </td>
                  <td>{{ props.item.name_title }}</td>
                  <td>{{ props.item.firstname }}</td>
                  <td>{{ props.item.lastname }}</td>
                  <!-- <td>{{ props.item.department }}</td> -->
                  <td>{{ props.item.position }}</td>
                </template>
              </v-data-table>
              <v-snackbar v-model="snack" :timeout="3000" :color="snackColor">
                {{ snackText }}
                <v-btn flat @click="snack = false">Close</v-btn>
              </v-snackbar>
            </template>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" flat @click="save" href="/">บันทึก</v-btn>
        </v-card-actions>
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
      this.course_id = newValue.id
      this.course_name = newValue.name;
      this.inst_name = newValue.instructor;
    },
    total: function(newValue) {
      this.employees = [];
      for (let i = 0; i < newValue; i++) {
        this.employees.push({
          index: i + 1,
          id: null,
          employee_code: "กรุณากรอกรหัส",
          name_title: null,
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
    course_id: null,
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
      { text: "รหัสพนักงาน", sortable: false, value: "employee_code" },
      // { text: "แผนก", sortable: false, value: "Department" },
      { text: "คำนำหน้านาม", sortable: false, value: "name_title" },
      { text: "ชื่อ", sortable: false, value: "firstname" },
      { text: "นามสกุล", sortable: false, value: "lastname" },
      { text: "ตำแหน่ง", sortable: false, value: "position" }
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
      axios.get("api/employee").then(response => {
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
            this.snack = true;
            console.log(response);
          },
          error => {
            console.log(error);
          }
        );

      //วนลูปแอดคนเข้า
      this.employees.forEach(emp => {
        axios
          .post("/api/employee-event", {
            employee_id: emp.id,
            course_id: this.course_id,
            money: this.money 
          })
          .then(
            response => {
              this.snack = true;
              console.log(response);
            },
            error => {
              console.log(error);
            }
          );
      });

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
        return user.employee_code == code;
      });
      if (userSel) {
        this.employees[index - 1].id = userSel[0].id;
        this.employees[index - 1].name_title = userSel[0].name_title;
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
