<template>
  <v-layout class="justify-end mt-3 mr-5 mb-3">
    <v-flex xs9 sm11>
      <v-toolbar flat color="white">
        <v-toolbar-title>
          <h3>
            <v-icon large color="blue">search</v-icon>&nbsp;ค้นหาข้อมูลหลักสูตรอบรม
          </h3>
        </v-toolbar-title>
        <v-divider class="mx-2" inset vertical></v-divider>
        <v-spacer></v-spacer>
        <v-flex xs12 sm4 md2>
          <v-text-field v-model="search" append-icon="search" label="ค้นหา" single-line></v-text-field>
        </v-flex>
        <v-dialog v-model="dialog" max-width="500px">
          <template v-slot:activator="{ on }">
            <v-btn color="primary" dark class="mb-2" v-on="on">เพิ่มหลักสูตร</v-btn>
          </template>
          <v-card>
            <v-card-title>
              <h2 class="txt-title">{{ formTitle }}</h2>
            </v-card-title>
            <v-card-text>
              <v-container grid-list-md>
                <v-layout wrap>
                  <v-flex xs12 sm12 md12>
                    <v-text-field
                      v-model="editItem.name"
                      item-text="name"
                      label="ชื่อหลักสูตร*"
                      v-validate="'required'"
                      data-vv-name="name"
                      :error-messages="errors.collect('name')"
                      required
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md6>
                    <v-text-field
                      v-validate="'required'"
                      v-model="editItem.code"
                      label="รหัส*"
                      data-vv-name="code"
                      :error-messages="errors.collect('code')"
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md6>
                    <v-select
                      :items="groups"
                      item-text="name"
                      item-value="id"
                      v-model="editItem.course_status"
                      label="กลุ่มหลักสูตร*"
                      v-validate="'required'"
                      data-vv-name="course_status"
                      :error-messages="errors.collect('course_status')"
                      required
                    ></v-select>
                  </v-flex>
                  <v-flex xs12 sm12 md12>
                    <v-text-field
                      v-validate="'required'"
                      v-model="editItem.instructor"
                      label="วิทยากร*"
                      data-vv-name="instructor"
                      :error-messages="errors.collect('instructor')"
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
        </v-dialog>
      </v-toolbar>
      <v-data-table
        :headers="headers"
        :items="filterCourse"
        :search="search"
        :pagination.sync="pagination"
        class="elevation-1"
      >
        <template v-slot:items="props">
          <td>{{ props.item.code }}</td>
          <td>{{ props.item.course_status }}</td>
          <td>{{ props.item.name }}</td>
          <td>{{ props.item.instructor }}</td>
          <td class="justify-center layout px-0">
            <v-icon small class="mr-2" @click="editCourse(props.item.id,props.item)">edit</v-icon>
            <v-icon small @click="deleteCourse(props.item.id,props.item)">delete</v-icon>
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
    headers: [
      { text: "รหัส", value: "code" },
      { text: "กลุ่มหลักสูตร", sortable: false, value: "course_status" },
      { text: "ชื่อหลักสูตร", sortable: false, value: "name" },
      { text: "วิทยากร", sortable: false, value: "instructor" }
    ],
    courses: [],
    groups: ['ภายใน','ภายนอก'],
    editIndex: -1,
    editItem: {
      name: "",
      code: "",
      course_status: "",
      instructor: ""
    },
    defaultItem: {
      name: "",
      code: "",
      course_status: "",
      instructor: ""
    }
  }),
  computed: {
    formTitle() {
      return this.editIndex === -1 ? "เพิ่มหลักสูตร" : "แก้ไขข้อมูลหลักสูตร";
    },
    filterCourse() {
      return this.courses.filter(course => {
        return (
          course.name.match(this.search) ||
          course.code.match(this.search)
        );
      });
    },
    checkInput: function() {
      if (
        this.editItem.name &&
        this.editItem.code &&
        this.editItem.course_status &&
        this.editItem.instructor
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
    this.getCoursesData();
  },
  methods: {
    getCoursesData() {
      axios.get("api/course").then(response => {
        this.courses = response.data;
      });
    },
    editCourse(id, item) {
      this.editIndex = this.courses.indexOf(item);
      this.editItem = Object.assign({}, item);
      this.dialog = true;
      this.editid = id;
    },
    deleteCourse(id, item) {
      const index = this.courses.indexOf(item);
      confirm("ต้องการจะลบใช่หรือไม่?") &&
        this.courses.splice(index, 1) &&
        axios.delete("api/course/" + id).catch(error => {
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
        Object.assign(this.courses[this.editIndex], this.editItem) &&
          axios.put("/api/course/" + this.editid, {
            name: this.editItem.name,
            code: this.editItem.code,
            course_status: this.editItem.course_status,
            instructor: this.editItem.instructor
          });
        this.snackbar = true;
        this.close();
      } else {
        if (this.checkInput) {
          this.courses.push(this.editItem) &&
            axios.post("/api/course", {
              name: this.editItem.name,
              code: this.editItem.code,
              course_status: this.editItem.course_status,
              instructor: this.editItem.instructor
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