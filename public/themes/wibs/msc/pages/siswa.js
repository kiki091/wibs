
var token = Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");

var controller = new Vue({
	el: '#app__dashboard',
    data: {

        models: {
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
        form_title: "BIODATA",
        form_sub_title: "Santri information",
        edit: false,
    },

    methods: {

        fetchData: function() {

            var domain  = laroute.route('msc_get_data_siswa', []);
            
            this.$http.get(domain).then(function (response) {
                response = response.data
                if(response.status == true) {
                    this.models = response.data.siswa
                    this.avatar = response.data.siswa.avatar_url
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