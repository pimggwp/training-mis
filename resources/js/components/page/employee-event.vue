<template>
    <v-layout class="justify-end mt-3 mr-5 mb-3">
        <v-flex xs9 sm11>
            <v-toolbar flat color="white">
                <v-toolbar-title>
                    <h3>
                        <v-icon large color="blue">description</v-icon
                        >&nbsp;รายงานสรุปผล
                    </h3>
                </v-toolbar-title>
                <v-divider class="mx-2" inset vertical></v-divider>
                <v-spacer></v-spacer>
                <v-flex xs12 sm4 md2>
                    <v-text-field
                        v-model="search"
                        append-icon="search"
                        label="ค้นหา"
                        single-line
                    ></v-text-field>
                </v-flex>
                <v-btn
                    color="success"
                    dark
                    class="mb-2 txt-title"
                    @click="exportData()"
                >
                    Export รายงาน&nbsp;
                    <img
                        width="30"
                        src="http://icons.iconarchive.com/icons/papirus-team/papirus-apps/256/ms-excel-icon.png"
                    />
                </v-btn>
            </v-toolbar>
            <v-data-table
                :headers="headers"
                :items="filterEvent"
                :search="search"
                :pagination.sync="pagination"
                class="elevation-1"
            >
                <template v-slot:items="props">
                    <td>{{ props.index + 1 }}</td>
                    <td>{{ props.item.รหัสพนักงาน }}</td>
                    <td>{{ props.item.ชื่อและนามสกุล }}</td>
                    <td>{{ props.item.ตำแหน่ง }}</td>
                    <td>{{ props.item.แผนก }}</td>
                    <td>{{ props.item.วันที่ }}</td>
                    <td>{{ props.item.หลักสูตร }}</td>
                    <td>{{ props.item.type }}</td>
                    <td>{{ props.item.รุ่นที่ }}</td>
                    <td>{{ props.item.สถานที่ }}</td>
                    <td>{{ props.item.ค่าใช้จ่าย }}</td>
                </template>
                <template v-slot:no-results>
                    <v-alert :value="true" color="error" icon="warning"
                        >Your search for "{{ search }}" found no
                        results.</v-alert
                    >
                </template>
            </v-data-table>
        </v-flex>
    </v-layout>
</template>

<script>
import XLSX from 'xlsx'

export default {
    $_veeValidate: {
        validator: "new"
    },
    data: () => ({
        pagination: {
            rowsPerPage: 10
        },
        search: "",
        headers: [
            {
                text: "ลำดับ",
                align: "left",
                sortable: false,
                value: "index"
            },
            { text: "รหัสพนักงาน", value: "employee_code" },
            { text: "ชื่อ-สกุล", value: "fullname" },
            { text: "ตำแหน่ง", sortable: false, value: "position" },
            { text: "แผนก", sortable: false, value: "department" },
            { text: "วันที่จัดอบรม", sortable: false, value: "date" },
            { text: "หลักสูตร", sortable: false, value: "course_name" },
            { text: "ประเภท", sortable: false, value: "type" },
            { text: "รุ่นที่", sortable: false, value: "number" },
            { text: "สถานที่", sortable: false, value: "location" },
            { text: "ค่าใช้จ่าย", sortable: false, value: "money" }
        ],
        events: []
    }),
    computed: {
        filterEvent() {
            return this.events.filter(event => {
                return event.รหัสพนักงาน.match(this.search);
            });
        }
    },
    created() {
        this.getEventsData();
    },
    methods: {
        getEventsData() {
            axios.get("api/employee-event").then(response => {
                this.events = this.tranFormData(response.data);
            });
        },
        tranFormData(data) {
            const result = data.map(element => ({
                รหัสพนักงาน: element.employee.employee_code,
                ชื่อและนามสกุล:
                    element.employee.name_title +
                    element.employee.firstname +
                    " " +
                    element.employee.lastname,
                ตำแหน่ง: element.employee.position,
                แผนก: element.employee.department.name,
                วันที่: element.event.date,
                หลักสูตร: element.event.course_name,
                type: element.event.type,
                รุ่นที่: element.event.number,
                สถานที่: element.event.location,
                ค่าใช้จ่าย: element.event.money
            }));
            return result;
        },
        exportData() {
            const dataWS = XLSX.utils.json_to_sheet(this.filterEvent);
            const wb = XLSX.utils.book_new();
            XLSX.utils.book_append_sheet(wb, dataWS);
            XLSX.writeFile(wb, "export.xlsx");
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
