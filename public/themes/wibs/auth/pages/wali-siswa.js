
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 *
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

function crud_cms_wali_sswa() {
    var token = Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");

    var controller = new Vue({
    	el: '#app',
        data: {

            models: {
                id:'',
                siswa_id: '',
                nama_lengkap_ayah: '',
                nama_lengkap_ibu: '',
                tempat_lahir: '',
                tanggal_lahir: '',
                agama: '',
                kewarganegaraan: '',
                pendidikan: '',
                pekerjaan: '',
                penghasilan_bulanan: '',
                alamat_kantor: '',
                telpon_kantor: '',
                alamat_rumah: '',
                no_telepon: '',
                email: '',
                status: '',
            },
            form_add_title: "Wali Santri Management",
            id: '',
            edit: false,
            responseData: {},
        },

        methods: {

            fetchData: function() {

                var domain  = laroute.url(wibs.systemLocation +'/wali-santri/data', []);
                
                this.$http.get(domain).then(function (response) {
                    response = response.data
                    if(response.status == true) {
                        this.responseData = response.data
                    } else {
                        pushNotif(response.status, response.message)
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

                var domain  = laroute.url(wibs.systemLocation +'/wali-santri/chenge-status', []);

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
                        setTimeout(function(){
                            hideLoading()
                        }, 3000);
                        
                    }

                };

                $("#form__cms__wali__santri").ajaxForm(optForm);
                $("#form__cms__wali__santri").submit();
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

                var domain  = laroute.url(wibs.systemLocation +'/wali-santri/edit', []);
                this.$http.post(domain, form).then(function(response) {

                    response = response.data
                    if (response.status) {
                        this.models = response.data.santri;

                        this.form_add_title = "Edit Data Santri"
                        $('.btn__add').click()

                    } else {
                        pushNotif(response.status,response.message)
                    }
                })
            },

            resetForm: function() {

                this.models.id = ''
                this.models.siswa_id = ''
                this.models.nama_lengkap_ayah = ''
                this.models.nama_lengkap_ibu = ''
                this.models.tempat_lahir = ''
                this.models.tanggal_lahir = ''
                this.models.agama = ''
                this.models.kewarganegaraan = ''
                this.models.pendidikan = ''
                this.models.pekerjaan = ''
                this.models.penghasilan_bulanan = ''
                this.models.alamat_kantor = ''
                this.models.telpon_kantor = ''
                this.models.alamat_rumah = ''
                this.models.no_telepon = ''
                this.models.email = ''
                this.models.status = ''

                this.form_add_title = "Wali Santri Management"
                document.getElementById("form__cms__wali__santri");

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
