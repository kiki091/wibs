
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 *
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

function crud_cms_report_kesehatan() {
    var token = Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");

    var controller = new Vue({
    	el: '#app',
        data: {

            models: {
                id:'',
                siswa_id: '',
                berat_badan: '',
                tinggi_badan: '',
                tensi_darah: '',
                golongan_darah: '',
                riwayat_sakit: '',
                keadaan_siswa: '',
                keadaan_siswa_other: '',
                report_from: '',
            },
            form_add_title: "Report Kesehatan Santri",
            id: '',
            edit: false,
            responseData: {},
            responseDataSantri: {},
        },

        methods: {

            fetchData: function() {

                var domain  = laroute.url(wibs.systemLocation +'/report/kesehatan/data', []);
                
                this.$http.get(domain).then(function (response) {
                    response = response.data
                    if(response.status == true) {
                        this.responseData = response.data
                    } else {
                        pushNotif(response.status, response.message)
                    }
                })
            },

            getDataSiswa: function(param) {
                nis = $('#form-search-data').val();

                var domain  = laroute.url(wibs.systemLocation +'/santri/search-data', []);
                this.$http.get(domain+'?nis='+nis).then(function (response) {
                    response = response.data
                    this.responseDataSantri = response.data.nis
                });
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

                $("#form__cms__report_kesehatan").ajaxForm(optForm);
                $("#form__cms__report_kesehatan").submit();
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

                var domain  = laroute.route('cms_report_kesehatan_edit_data', []);
                this.$http.post(domain, form).then(function(response) {

                    response = response.data
                    if (response.status) {
                        this.models = response.data;

                        this.form_add_title = "Edit Report Kesehatan"
                        $('.btn__add').click()

                    } else {
                        pushNotif(response.status,response.message)
                    }
                })
            },

            resetForm: function() {

                this.models.id = ''
                this.models.siswa_id = ''
                this.models.berat_badan = ''
                this.models.tinggi_badan = ''
                this.models.tensi_darah = ''
                this.models.golongan_darah = ''
                this.models.riwayat_sakit = ''
                this.models.keadaan_siswa = ''
                this.models.keadaan_siswa_other = ''
                this.models.report_from = ''

                this.form_add_title = "Report Kesehatan Santri"
                document.getElementById("form__cms__report_kesehatan");

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
