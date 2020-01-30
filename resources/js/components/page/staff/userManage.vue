<template>
  <v-layout class="justify-end mt-3 mr-5 mb-3">
    <v-flex xs9 sm11>
      <v-toolbar flat color="white">
        <v-toolbar-title>
          <h3>
            <v-icon large color="blue">supervised_user_circle</v-icon>
            &nbsp;สมาชิกในระบบ
            <!-- <v-btn color="primary" dark class="mb-2 txt-title" @click="genBC">GenBC</v-btn> -->
          </h3>
        </v-toolbar-title>
        <v-divider class="mx-2" inset vertical></v-divider>
        <v-spacer></v-spacer>
        <v-flex xs12 sm4 md2>
          <v-select :items="select" v-model="selected" item-text="title" label="เลือกดูระดับชั้น"></v-select>
        </v-flex>&nbsp;&nbsp;
        <v-flex xs12 sm4 md2>
          <v-text-field v-model="search" append-icon="search" label="ค้นหา" single-line></v-text-field>
        </v-flex>
        <v-dialog v-model="dialog" max-width="500px">
          <template v-slot:activator="{ on }">
            <v-btn color="primary" dark class="mb-2 txt-title" v-on="on">เพิ่มสมาชิก</v-btn>
          </template>
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
                    <v-select
                      :items="statusSex"
                      v-model="editItem.sex"
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
                      v-model="editItem.code"
                      label="รหัส*"
                      data-vv-name="code"
                      :error-messages="errors.collect('code')"
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-select
                      :items="statusTypes"
                      v-model="editItem.type"
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
                      v-model="editItem.education"
                      v-validate="'required'"
                      label="ระดับชั้น*"
                      data-vv-name="education"
                      :error-messages="errors.collect('education')"
                    ></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field v-model="editItem.point" label="คะแนน"></v-text-field>
                  </v-flex>
                  <v-flex xs12 sm6 md4>
                    <v-text-field v-model="editItem.unit" label="จำนวนหุ้น"></v-text-field>
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
        </v-dialog>
        <v-dialog v-model="dialog2" max-width="900px">
          <template v-slot:activator="{ on }">
            <v-btn color="success" dark class="mb-2 txt-title" v-on="on">
              Upload&nbsp;
              <img
                width="30"
                src="http://icons.iconarchive.com/icons/papirus-team/papirus-apps/256/ms-excel-icon.png"
              />
            </v-btn>
          </template>
        </v-dialog>
        <!-- <v-btn
          color="orange accent-3"
          dark
          class="mb-2 txt-title"
          @click="reportPdf()"
        >พิมพ์บัตรสมาชิก</v-btn> -->
      </v-toolbar>
      <v-data-table
        :headers="headers"
        :items="filterUsers"
        :search="search"
        :pagination.sync="pagination"
        class="elevation-1 txt-title"
      >
        <template v-slot:items="props">
          <td>{{ props.item.firstname }}</td>
          <td>{{ props.item.lastname }}</td>
          <td>{{ props.item.code }}</td>
          <td>{{ props.item.email }}</td>
          <td>{{ props.item.type }}</td>
          <td>{{ props.item.point }}</td>
          <td>{{ props.item.education }}</td>
          <td>{{ props.item.unit }}</td>
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
    parse_header: [],
    parse_csv: [],
    sortOrders: {},
    sortKey: "",
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
    statusTypes: ["staff", "student"],
    statusSex: ["ชาย", "หญิง"],
    headers: [
      { text: "ชื่อ", sortable: false, value: "firstname" },
      { text: "นามสกุล", sortable: false, value: "lastname" },
      { text: "รหัส", value: "code" },
      { text: "Email", sortable: false, value: "email" },
      { text: "สถานะ", value: "type" },
      { text: "คะแนน", value: "point" },
      { text: "ระดับชั้น", value: "education" },
      { text: "จำนวนหุ้น", value: "unit" }
    ],
    users: [],
    editIndex: -1,
    editItem: {
      firstname: "",
      lastname: "",
      code: "",
      barcode: "",
      type: "",
      sex: "",
      point: 0,
      education: null,
      bdate: null,
      unit: 0
    },
    defaultItem: {
      firstname: "",
      lastname: "",
      code: "",
      type: "",
      sex: "",
      point: 0,
      education: null,
      bdate: null,
      unit: 0
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
    checkInput: function() {
      if (
        this.editItem.firstname &&
        this.editItem.lastname &&
        this.editItem.code &&
        this.editItem.type &&
        this.editItem.sex &&
        this.editItem.education &&
        this.editItem.bdate
      ) {
        return true;
      } else {
        return false;
      }
    },
    pageShow() {
      return "A5";
    },
    filterUsers() {
      return this.users.filter(user => {
        return (
          user.education.match(this.selected) &&
          (user.firstname.match(this.search) ||
            user.lastname.match(this.search))
        );
      });
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
      axios.get("api/user").then(response => {
        this.users = response.data;
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
    close2() {
      this.parse_csv = [];
      this.parse_header = [];
      this.sortOrders = {};
      this.sortKey = "";
      let file = document.getElementById("csv_file");
      if (file.value) {
        file.value = "";
      }
      this.dialog2 = false;
    },
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