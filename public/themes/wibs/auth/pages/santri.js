
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 *
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

function crud_cms_santri() {
    var token = Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");

    var controller = new Vue({
    	el: '#app',
        data: {

            models: {
                id:'',
                nis: '',
                nama_lengkap: '',
                nama_panggilan: '',
                jenis_kelamin: '',
                tempat_lahir: '',
                tanggal_lahir: '',
                anak_ke: '',
                jumlah_saudara_kandung: '',
                status_orang_tua: '',
                alamat: '',
                no_telpon: '',
                status_tinggal: '',
                jarak_rumah: '',
                golongan_darah: '',
                tinggi_badan: '',
                berat_badan: '',
                alamat_sekolah: '',
                tanggal_nomer_sttb: '',
                kelas_id: '',
                tingkatan_id    : '',
                status_siswa: '',
                description: '',
                email: '',
                asal_sekolah: '',
                alamat_sekolah_lama: '',
                alasan_pindah: '',
            },
            foto: '',
            image: '',
            form_add_title: "Santri Management System",
            id: '',
            edit: false,
            responseData: {},
        },

        methods: {

            onImageChange: function(element, e) {
                var files = e.target.files || e.dataTransfer.files

                if (!files.length)
                    return;

                this.models[element] = files[0]
                this.createImage(files[0], element);
            },

            createImage: function(file, setterTo) {
                var image = new Image();
                var reader = new FileReader();
                var vm = this;

                reader.onload = function (e) {
                    vm[setterTo] = e.target.result;
                };
                reader.readAsDataURL(file);
            },

            removeImage: function (variable) {
                this[variable] = ''
            },

            fetchData: function() {

                var domain  = laroute.url(wibs.systemLocation +'/santri/data', []);
                
                this.$http.get(domain).then(function (response) {
                    response = response.data
                    if(response.status == true) {
                        this.responseData = response.data
                    } else {
                        pushNotif(response.status, response.message)
                    }
                })
            },

            storeData: function(event) {

                var vm = this;
                var optForm      = {

                    dataType: "json",

                    beforeSend: function(){
                        showLoading(true)
                        vm.clearErrorMessage()
                    },
                    success: function(response){
                        if (response.status == false) {
                            if(response.is_error_form_validation) {
                                
                                var message_validation = ''
                                $.each(response.message, function(key, value){
                                    $('input[name="' + key.replace(".", "_") + '"]').focus();
                                    $("#form--error--message--" + key.replace(".", "_")).text(value)
                                    message_validation += '<li class="notif__content__li"><span class="text" >' + value + '</span></li>'
                                });
                                pushNotifValidation(response.status, 'default', message_validation, false);

                            } else {
                                pushNotif(response.status, response.message);
                            }
                        } else {
                            vm.fetchData()
                            pushNotif(response.status, response.message);
                            $('.btn__add__cancel').click();
                            vm.resetForm(true)
                        }
                    },
                    complete: function(response){
                        hideLoading()
                    }

                };

                $("#form__cms__santri").ajaxForm(optForm);
                $("#form__cms__santri").submit();
            },

            editData: function(id) {

                this.edit = true      
                var payload = []
                payload['id'] = id
                payload['_token'] = token

                var form = new FormData();

                for (var key in payload) {
                    form.append(key, payload[key])
                }

                var domain  = laroute.route('cms_edit_data_santri', []);
                this.$http.post(domain, form).then(function(response) {

                    response = response.data
                    if (response.status) {
                        this.models = response.data;
                        this.foto = response.data.foto_url
                        this.form_add_title = "Edit Data Santri"
                        $('#toggle-form-content').slideDown('swing')

                    } else {
                        pushNotif(response.status,response.message)
                    }
                })
            },

            changeStatus: function(id) {
                var payload = []
                payload['id'] = id
                payload['_token'] = token

                var form = new FormData();

                for (var key in payload) {
                    form.append(key, payload[key])
                }

                var domain  = laroute.route('cms_change_status_data_santri', []);

                this.$http.post(domain, form).then(function(response) {
                    response = response.data
                    if (response.status == false) {
                        this.fetchData()
                        pushNotif(response.status,response.message);
                    }
                    else{

                        this.fetchData()
                        pushNotif(response.status,response.message);
                    }
                })
            },

            resetForm: function() {

                this.models.id = ''
                this.models.nis = ''
                this.models.nama_lengkap = ''
                this.models.nama_panggilan = ''
                this.models.jenis_kelamin = ''
                this.models.tempat_lahir = ''
                this.models.tanggal_lahir = ''
                this.models.anak_ke = ''
                this.models.jumlah_saudara_kandung = ''
                this.models.status_orang_tua = ''
                this.models.alamat = ''
                this.models.no_telpon = ''
                this.models.status_tinggal = ''
                this.models.golongan_darah = ''
                this.models.kelainan_jasmani = ''
                this.models.tinggi_badan = ''
                this.models.berat_badan = ''
                this.models.alamat_sekolah = ''
                this.models.tanggal_nomer_sttb = ''
                this.models.lama_belajar = ''
                this.models.kelas_id = ''
                this.models.tingkatan_id = ''
                this.models.status_siswa = ''
                this.models.description = ''
                this.models.email = ''
                
                this.models.asal_sekolah = ''
                this.models.alamat_sekolah_lama = ''
                this.models.alasan_pindah = ''

                this.foto = '',

                this.form_add_title = "Santri Management System"
                document.getElementById("form__cms__santri");

                this.clearErrorMessage()
                this.edit = false
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
