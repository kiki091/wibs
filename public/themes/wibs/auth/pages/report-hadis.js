
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 *
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

function crud_cms_report_hadis() {
    var token = Vue.http.headers.common['X-CSRF-TOKEN'] = $("#_token").attr("value");

    var controller = new Vue({
    	el: '#app',
        data: {

            models: {
                id:'',
                siswa_id: '',
                kedisiplinan: '',
                total_hafalan: '',
                kekuatan_hafalan: '',
                nilai_hafalan: '',
                description: '',
                kitab_id: '',
                report_from: '',
            },
            form_add_title: "Report Hadits Santri",
            id: '',
            edit: false,
            responseData: {},
            responseDataSantri: {},
            responseDataKitab: {},
        },

        methods: {

            fetchData: function() {

                var domain  = laroute.url(wibs.systemLocation +'/report/hadis/data', []);
                
                this.$http.get(domain).then(function (response) {
                    response = response.data
                    if(response.status == true) {
                        this.responseData = response.data
                        this.responseDataKitab = response.data.kitab
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
                        setTimeout(function(){
                            hideLoading()
                        }, 3000);
                        
                    }

                };

                $("#form__cms__report_hadis").ajaxForm(optForm);
                $("#form__cms__report_hadis").submit();
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

                var domain  = laroute.url(wibs.systemLocation +'/report/hadis/edit', []);
                this.$http.post(domain, form).then(function(response) {

                    response = response.data
                    if (response.status) {
                        this.models = response.data.santri;

                        this.form_add_title = "Edit Report Tahfidz Qur'an"
                        $('.btn__add').click()

                    } else {
                        pushNotif(response.status,response.message)
                    }
                })
            },

            resetForm: function() {

                this.models.id = ''
                this.models.siswa_id = ''
                this.models.kedisiplinan = ''
                this.models.total_hafalan = ''
                this.models.kekuatan_hafalan = ''
                this.models.nilai_hafalan = ''
                this.models.description = ''
                this.models.kitab_id = ''
                this.models.report_from = ''

                this.form_add_title = "Report Hadits Santri"
                document.getElementById("form__cms__report_hadis");

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
