
function crud_report_health() {
    var token = Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");

    var controller = new Vue({
    	el: '#app__dashboard',
        data: {

            models: {
                id:'',
                berat_badan: '',
                tinggi_badan: '',
                tensi_darah: '',
                golongan_darah: '',
                riwayat_sakit: '',
                keadaan_siswa: '',
                keadaan_siswa_other: '',
                siswa_id: '',
                report_from: '',
            },
            models_siswa: {
                siswa_id:'',
                nis: '',
                nama_lengkap: '',
                nama_panggilan: '',
                jenis_kelamin: '',
                tempat_lahir: '',
                agama: '',
                kewarganegaraan: '',
                alamat: '',
                no_telpon: '',
                description: '',
                email: '',
                kelas: '',
                tingkatan: '',
            },
            data_tahfidz : {
                nama_siswa : '',
                nilai_hafalan : '',
            },
            data_hadis : {
                nama_siswa : '',
                nilai_hafalan : '',
            },
            avatar : '',
            form_title: "STUDENT MONITORING",
            form_sub_title: "Report Kesehatan",
            edit: false,
        },

        methods: {

            fetchData: function() {

                var domain  = laroute.route('msc_report_health_get_data', []);
                
                this.$http.get(domain).then(function (response) {
                    response = response.data
                    if(response.status == true) {
                        this.models = response.data
                        this.models_siswa = response.data.siswa
                        this.data_hadis = response.data.data_hadis
                        this.data_tahfidz = response.data.data_tahfidz
                    } else {
                        pushNotif(response.status, response.message)
                    }
                })
            },

            clearErrorMessage: function() {
                $(".form--error--message--left").text('')
            },

        },
        mounted: function () {
            this.fetchData();
        }

    });
}