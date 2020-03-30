<template>
  <v-app>
    <v-navigation-drawer
      v-model="drawer"
      :mini-variant.sync="mini"
      hide-overlay
      stateless
      fixed
      persistent
      style="z-index: 1"
      class="mt-5 pt-3"
    >
      <v-toolbar flat class="transparent">
        <v-list class="pa-0">
          <v-list-tile avatar>
            <v-list-tile-avatar>
              <img
                v-if="usernow.sex=='ชาย'"
                src="https://www.pngitem.com/pimgs/m/41-415019_profile-man-male-free-picture-male-avatar-clipart.png"
              />
              <img
                v-if="usernow.sex=='หญิง'"
                src="https://i.pinimg.com/originals/a6/58/32/a65832155622ac173337874f02b218fb.png"
              />
            </v-list-tile-avatar>
            <v-list-tile-content>
              <v-list-tile-title class="txt-title">
                <h3>{{usernow.firstname}} {{usernow.lastname}}</h3>
              </v-list-tile-title>
            </v-list-tile-content>
            <v-list-tile-action>
              <v-btn icon @click.stop="mini = !mini">
                <v-icon>chevron_left</v-icon>
              </v-btn>
            </v-list-tile-action>
          </v-list-tile>
        </v-list>
      </v-toolbar>

      <v-list class="pt-0" dense>
        <v-divider></v-divider>
        <v-list-tile v-for="item in itemsAdmin" :key="item.title" :href="item.link">
          <v-list-tile-action>
            <v-icon :color="item.link==3? 'red':''">{{ item.icon }}</v-icon>
          </v-list-tile-action>
          <v-list-tile-content>
            <v-list-tile-title v-text="item.title"></v-list-tile-title>
          </v-list-tile-content>
        </v-list-tile>
      </v-list>
    </v-navigation-drawer>
  </v-app>
</template>


<script>
export default {
  props: ["usernow"],
  mounted() {
    console.log(this.usernow);
  },
  data() {
    return {
      drawer: true,
      itemsAdmin: [
        { title: "หน้าแรก", icon: "dashboard", link: "/" },
        {
          title: "บันทึกข้อมูลการฝึกอบรม",
          icon: "assignment_turned_in",
          link: "/training-save"
        },
        {
          title: "ประวัติการฝึกอบรมรายบุคคล",
          icon: "collections_bookmark",
          link: "/personal-report"
        },
        {
          title: "ค้นหาข้อมูลหลักสูตรอบรม",
          icon: "search",
          link: "/course"
        },
        {
          title: "รายงานสรุปผล",
          icon: "description",
          link: "/summary-report"
        },
        {
          title: "จัดการสมาชิก",
          icon: "supervised_user_circle",
          link: "/user"
        },
        {
          title: "ค้นหาข้อมูลพนักงาน",
          icon: "group",
          link: "/employee"
        }
      ],
      // itemsStaff: [
      //   // { title: "หน้าแรก", icon: "dashboard", link: "/" },
      //   {
      //     title: "รายการสินค้า",
      //     icon: "shopping_cart",
      //     link: "/product"
      //   },
      //   {
      //     title: "ทำรายการ",
      //     icon: "assignment_turned_in",
      //     link: "/transaction-staff"
      //   },
      //   {
      //     title: "ปฏิทินกำหนดการ",
      //     icon: "date_range",
      //     link: "/event"
      //   }
      // ],
      // itemsUser: [
      //   // { title: "หน้าแรก", icon: "dashboard", link: "/" },
      //   {
      //     title: "รายการสินค้า",
      //     icon: "shopping_cart",
      //     link: "/product"
      //   },
      //   {
      //     title: "ดูรายงานการซื้อ",
      //     icon: "description",
      //     link: "/reportuser"
      //   },
      //   {
      //     title: "ดูยอดปันผล/เฉลี่ยคืน",
      //     icon: "monetization_on",
      //     link: "/dividend-for-user"
      //   },
      //   {
      //     title: "ปฏิทินกำหนดการ",
      //     icon: "date_range",
      //     link: "/event"
      //   }
      // ],
      mini: true,
      right: null
    };
  }
};
</script>
