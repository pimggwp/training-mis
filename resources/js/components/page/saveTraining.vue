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
        <v-card-title>
          <h2 class="txt-title">{{ formTitle }}</h2>
        </v-card-title>
        <v-card-text>
          <v-container grid-list-md>
            <v-layout wrap>
              <v-flex xs12 sm6 md4>
                <v-text-field
                  v-validate="'required'"
                  label="ชื่อ*"
                  data-vv-name="firstname"
                  :error-messages="errors.collect('firstname')"
                ></v-text-field>
              </v-flex>
              <v-flex xs12 sm6 md4>
                <v-text-field
                  v-validate="'required'"
                  label="นามสกุล*"
                  data-vv-name="lastname"
                  :error-messages="errors.collect('lastname')"
                ></v-text-field>
              </v-flex>
              <v-flex xs12 sm6 md4>
                <v-select
                  item-text="title"
                  label="เพศ*"
                  v-validate="'required'"
                  data-vv-name="sex"
                  :error-messages="errors.collect('sex')"
                  required
                ></v-select>
              </v-flex>
              <v-flex xs12 sm6 md4>
                <v-text-field
                  v-validate="'required'"
                  label="รหัส*"
                  data-vv-name="code"
                  :error-messages="errors.collect('code')"
                ></v-text-field>
              </v-flex>
              <v-flex xs12 sm6 md4>
                <v-select
                  :items="statusTypes"
                  item-text="title"
                  label="สถานะ*"
                  v-validate="'required'"
                  data-vv-name="type"
                  :error-messages="errors.collect('type')"
                  required
                ></v-select>
              </v-flex>
              <v-flex xs12 sm6 md4>
                <v-text-field
                  v-validate="'required'"
                  label="ระดับชั้น*"
                  data-vv-name="education"
                  :error-messages="errors.collect('education')"
                ></v-text-field>
              </v-flex>
              <v-flex xs12 sm6 md4>
                <v-text-field label="คะแนน"></v-text-field>
              </v-flex>
              <v-flex xs12 sm6 md4>
                <v-text-field label="จำนวนหุ้น"></v-text-field>
              </v-flex>
              <v-flex xs12 sm12 md12>
                <v-menu
                  ref="menu"
                  v-model="menu"
                  :close-on-content-click="false"
                  :nudge-right="40"
                  :return-value.sync="editItem.date"
                  lazy
                  transition="scale-transition"
                  offset-y
                  full-width
                  min-width="290px"
                >
                  <template v-slot:activator="{ on }">
                    <v-text-field
                      label="เลือกวันเดือนปี*"
                      prepend-icon="event"
                      v-validate="'required'"
                      :error-messages="errors.collect('date')"
                      data-vv-name="date"
                      readonly
                      v-on="on"
                      required
                    ></v-text-field>
                  </template>
                  <v-date-picker v-model="editItem.date" no-title scrollable locale="th">
                    <v-spacer></v-spacer>
                    <v-btn flat color="primary" @click="menu = false">ยกเลิก</v-btn>
                    <v-btn flat color="primary" @click="$refs.menu.save(editItem.date)">ตกลง</v-btn>
                  </v-date-picker>
                </v-menu>
              </v-flex>
              <v-flex xs12>
                <v-text-field
                  v-if="editIndex=='-1'"
                  v-model="editItem.bdate"
                  v-validate="'required'"
                  label="วันเดือนปีเกิด*"
                  data-vv-name="bdate"
                  :error-messages="errors.collect('bdate')"
                ></v-text-field>
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
    </v-flex>
    <!-- <v-snackbar class="txt-title" v-model="snackbar" :color="color" :timeout="3000">
      บันทึกสำเร็จแล้ว
      <v-btn dark flat @click="snackbar = false">
        <v-icon>close</v-icon>
      </v-btn>
    </v-snackbar>-->
  </v-layout>
</template>

<script>
</script>


<style>
.no-upload {
  color: red;
  font-size: 3mm;
}
</style>
