
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
            nama_ayah: '',
            nama_ibu: '',
        },
        data_tahfidz : {
            nama_siswa : '',
            nilai_hafalan : '',
        },
        data_hadis : {
            nama_siswa : '',
            nilai_hafalan : '',
        },
        foto : '',
        image : '',
        responseData : {},
        form_title: "BIODATA",
        form_sub_title: "Santri information",
        edit: false,
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

            var domain  = laroute.route('msc_get_data_siswa', []);
            
            this.$http.get(domain).then(function (response) {
                response = response.data
                if(response.status == true) {
                    this.responseData = response.data.siswa
                    this.data_hadis = response.data.data_hadis
                    this.data_tahfidz = response.data.data_tahfidz
                    this.foto = response.data.siswa.foto_url
                } else {
                    pushNotif(response.status, response.message)
                }
            })
        },


        storeData: function(event) {

            var vm = this;
            var optForm      = {

                dataType: "json",

                beforeSerialize: function(form, options) {
                    for (instance in CKEDITOR.instances)
                        CKEDITOR.instances[instance].updateElement();
                },
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

            $("#from__siswa").ajaxForm(optForm);
            $("#from__siswa").submit();
        },

        editData: function(siswa_id) {
            
            var payload = []
            payload['id'] = siswa_id
            payload['_token'] = token

            var form = new FormData();

            for (var key in payload) {
                form.append(key, payload[key])
            }

            var domain  = laroute.route('msc_edit_data_siswa', []);
            this.$http.post(domain, form).then(function(response) {

                response = response.data
                if (response.status) {
                    this.models = response.data
                    this.foto = response.data.foto_url

                    $('#toggle-form-content').slideDown('swing')
                    $('.hide__form').fadeOut()

                } else {
                    pushNotif(response.status,response.message)
                }
            })
        },

        resetForm: function() {
            $('#toggle-form-content').slideUp('swing')
            $('.hide__form').fadeIn()
        },

        clearErrorMessage: function() {
            $(".form--error--message--left").text('')
        },

    },
    mounted: function () {
        this.fetchData();
    }

});