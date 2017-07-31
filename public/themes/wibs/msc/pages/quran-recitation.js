
function crud_report__tahfidz() {
    var token = Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");

    var controller = new Vue({
    	el: '#app__dashboard',
        data: {

            models: {
                id:'',
                disiplin: '',
                total_hafalan: '',
                nilai_hafalan: '',
                nilai_tajwid: '',
                nilai_mahraj: '',
                description: '',
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
            avatar : '',
            form_title: "QUR'AN RECITATION REPORT",
            form_sub_title: "Laporan Hafalan Qur'an",
            edit: false,
        },

        methods: {

            fetchData: function() {

                var domain  = laroute.route('msc_quran_recitation_get_data', []);
                
                this.$http.get(domain).then(function (response) {
                    response = response.data
                    if(response.status == true) {
                        this.models = response.data
                        this.models_siswa = response.data.siswa
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