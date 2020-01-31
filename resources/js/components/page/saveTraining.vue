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
                <v-select
                  :items="courseCode"
                  v-model="courseCodeSelect"
                  item-text="course_code"
                  label="รหัสหลักสูตร*"
                  v-validate="'required'"
                  data-vv-name="course_code"
                  :error-messages="errors.collect('course_code')"
                  required
                ></v-select>
              </v-flex>
              <v-flex xs12 sm6 md6>
                <v-text-field
                  v-validate="'required'"
                  label="รุ่นที่*"
                  data-vv-name="lastname"
                  :error-messages="errors.collect('lastname')"
                ></v-text-field>
              </v-flex>
              <v-flex xs12 sm12 md12>
                <v-text-field
                  v-validate="'required'"
                  label="ชื่อหลักสูตร*"
                  data-vv-name="firstname"
                  :error-messages="errors.collect('firstname')"
                ></v-text-field>
              </v-flex>
              <v-flex xs12 sm12 md12>
                <v-text-field
                  v-validate="'required'"
                  label="วิทยากรผู้บรรยาย*"
                  data-vv-name="code"
                  :error-messages="errors.collect('code')"
                ></v-text-field>
              </v-flex>
              <v-flex xs12 sm12 md12>
                <v-text-field
                  v-validate="'required'"
                  label="สถานที่จัดอบรม*"
                  data-vv-name="education"
                  :error-messages="errors.collect('education')"
                ></v-text-field>
              </v-flex>
              <v-flex xs12 sm6 md6>
                <v-text-field
                  v-validate="'required'"
                  label="จำนวนผู้เข้าอบรม*"
                  data-vv-name="education"
                  :error-messages="errors.collect('education')"
                ></v-text-field>
              </v-flex>
              <v-flex xs12 sm6 md6>
                <v-text-field
                  v-validate="'required'"
                  label="ค่าใช้จ่ายรวม*"
                  data-vv-name="education"
                  :error-messages="errors.collect('education')"
                ></v-text-field>
              </v-flex>
            </v-layout>
          </v-container>
        </v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="blue darken-1" flat @click="save">บันทึก</v-btn>
        </v-card-actions>
      </v-card>
    </v-flex>
  </v-layout>
</template>

<script>
export default {
  mounted() {
    this.getCourseCode();
  },
  data: () => ({
    date: null,
    modal: false,
    menu: false,
    events: [],
    types: ["InHouse", "Public", "Other"],
    typeSelect: null,
    courseCodeSelect: null,
    courseCode: []
  }),
  methods: {
    getCourseCode() {
      axios.get("api/").then(response => {
        this.users = response.data;
      });
    },
    save() {}
  }
};
</script>


<style>
.no-upload {
  color: red;
  font-size: 3mm;
}
</style>
