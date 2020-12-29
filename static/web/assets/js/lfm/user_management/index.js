var backend_url     = window.location.origin+"/lfm/dev/";
$(document).ready(function(){
    loadDataTable();
});
$('#status_user').select2({
    width:'100%',
    placeholder: 'Pilih Status User'
});
$('#role').select2({
    width:'100%',
    placeholder: 'Pilih Role'
});
$('#company').select2({
    width:'100%',
    placeholder: 'Pilih Instansi'
});
$('#btn_add_user').on('click', function(){
        $('#status').val('add');
        $('#id').val('0');
        $('#UserModalLabel').text('Tambah User Baru');
        $('#int_form').css('display','none');
        $('#form_add').css('display','none');
        getStatusUser();
        getCompany();
        getRole();
        $("#modalUser").modal({
            backdrop: 'static',
            keyboard: false,
            show    : true
        });
        // $('#Mmodal-izin-usaha').find('form').trigger('reset');
});
$('#status_user').change(function() {
        getFormData(this.value);
});

function getFormData(value)
{
    var val = value
    if(value == 'INT'){
        $('#int_form').css('display','block');
        $('#form_add').css('display','none');
        $("#nip_npp_lman").val('');
    }else{
        $('#form_add').css('display','block');
        $('#int_form').css('display','none');
        $("#name").val('');
        $("#email").val('');
        $("#nip_npp").val('');
        $("#nip_npp_lman").val('0');
        $("#id_user").val('0');
        $("#name").prop("readonly", false);
        $("#email").prop("readonly", false);
        $("#nip_npp").prop("readonly", false);
        getCompany();
        getRole(2)
        
    }
}
function loadDataTable()
{
    $.ajax({
            url     : backend_url+'User-management/data-user',
            type    : 'POST',
            data    : {'id':'','token' : window.localStorage.getItem('lfm_token')},
            dataType: 'JSON',
            cache   : false,
            beforeSend: function(xhr)
            {
                 xhr.setRequestHeader('Authorization', 'Bearer '+window.localStorage.getItem('lfm_token'));
            },
            success: function(resp)
            { 
                var dataColums = resp.data;
                $('#user_tbl').DataTable({
                    'searching'   : false,
                    'destroy'     : true,
                    // 'dom'         :"brtlp",
                    'responsive'  : true,
                    'processing'  : true,
                    'paging'      : true,
                    'lengthChange': true,
                    'ordering'    : true,
                    'info'        : true,
                    'autoWidth'   : false,
                    'columnDefs'  :[
                                        {
                                            // "targets": [2], //first column / numbering column
                                            // "orderable": false, //set not orderable
                                        },
                                    ],
                    'data'      : dataColums,
                    'columns'   :[
                                    { "data": "no" },
                                    { "data": "name"},
                                    { "data": "company_name"},
                                    { "data": "role_name"},
                                    { "data": "action"}
                                ],
                });
                },
                error: function (jqXHR, textStatus, errorThrown)
                {
                    setTimeout(function() {
                        swal.fire('Gagal',"Error Server ?",'error');
                    }, 1000);
                }
        });
}

function getStatusUser( id = '')
{
    var htmlData = '<option style="color:#3a7311;" value="">&#9724; ** Pilih Status User **</option>';
    htmlData = htmlData + '<option value="INT">LMAN</option>';
    htmlData = htmlData + '<option value="EXT">PPK</option>';
    $('#status_user').html(htmlData);
    $('#status_user').val(id);
}
function getCompany(id='')
{
    $.ajax({
        url     : backend_url+'User-management/company-data',
        type    : 'POST',
        data    : {'id':''},
        dataType: 'JSON',
        cache   : false,
        beforeSend: function(xhr)
        {
            xhr.setRequestHeader('Authorization', 'Bearer '+window.localStorage.getItem('lfm_token'));
        },
        success: function(resp)
        {   
            var data = resp;
            if(data.status)
            { 
                var parent    = data.data;
                var htmlData = '<option style="color:#3a7311;" value="">&#9724; ** Pilih Company **</option>';
                parent.forEach ( function(value){
                    htmlData = htmlData + "<option value="+value.id+">"+value.name+"</option>";
                });
                $('#company').html(htmlData);
                $('#company').val(id);
            }
            else
            {
                setTimeout(function() {
                    swal.fire('Gagal',"Data tidak ditemukan",'error');
                }, 1000);
            }

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            setTimeout(function() {
                    swal.fire('Gagal',"Error",'error');
                }, 1000);
            }
        });
}
function getRole( id = '')
{
    $.ajax({
        url     : backend_url+'User-management/role-data',
        type    : 'POST',
        data    : {'id':''},
        dataType: 'JSON',
        cache   : false,
        beforeSend: function(xhr)
        {
            xhr.setRequestHeader('Authorization', 'Bearer '+window.localStorage.getItem('lfm_token'));
        },
        success: function(resp)
        {   
            var data = resp;
            if(data.status)
            { 
                var parent    = data.data;
                var htmlData = '<option style="color:#3a7311;" value="">&#9724; ** Pilih Role **</option>';
                parent.forEach ( function(value){
                    htmlData = htmlData + "<option value="+value.id+">"+value.name+"</option>";
                });
                $('#role').html(htmlData);
                $('#role').val(id);
            }
            else
            {
                setTimeout(function() {
                    swal.fire('Gagal',"Data tidak ditemukan",'error');
                }, 1000);
            }

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            setTimeout(function() {
                    swal.fire('Gagal',"Kendala Server?",'error');
                }, 1000);
            }
        });
}


function getDetailPegawai()
{
    var nip_npp = $('#nip_npp_lman').val();
    $.ajax({
            url     : backend_url+'User-management/detail-pegawai',
            type    : 'POST',
            data    : {'nip_npp':nip_npp},
            dataType: 'JSON',
            cache   : false,
            beforeSend: function(xhr)
            {
                xhr.setRequestHeader('Authorization', 'Bearer '+window.localStorage.getItem('lfm_token'));   
            },
            success: function(data)
            {   
                if(data.status == 'success')
                { 
                    var data = data.employee;
                    $('#form_add').css('display','block');
                    $('#id_user').val(data.id)
                    $('#name').val(data.name);
                    $('#nip_npp').val(data.nip_npp);
                    $('#email').val(data.email);
                    $("#name").prop("readonly", true);
                    $("#email").prop("readonly", true);
                    $("#nip_npp").prop("readonly", true);
                    getCompany(1);
                    getRole();
                }
                else
                {
                    setTimeout(function() {
                        swal.fire('Gagal',data.message,'error');
                    }, 1000);
                }

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                setTimeout(function() {
                    swal.fire('Gagal',"Server Sedang Galau ..! / Atau Anda yang Galau ?",'error');
                }, 1000);
            }
        });
}

function saveUser()
{
    var form_modal = false;
    $('.form-modal').find('select,input').each(function(i,box){
        // alert($(box).val());
        if($(box).val() == ''){
            form_modal = true
        }
        // alert($(box).attr('id').val());
    });
    // var form_data = new FormData(this);
    // form_data.append("status",$('#status').val());
    // form_data.append("id",$('#id').val());
    // form_data.append("name",$('#name').val());
    // form_data.append("description",$('#description').val());
    if(form_modal == true)
    {
        setTimeout(function() {
                    swal.fire('Gagal',"Pastikan data sudah terisi semua...!",'error');
                }, 1000);
    }else{
        var status      = $('#status').val()
        var id          = $('#id').val()
        var status_user = $('#status_user').val();
        var name        = $('#name').val();
        var id_user     = $('#id_user').val();
        var nip_npp     = $('#nip_npp').val();
        var email       = $('#email').val();
        var company     = $('#company').val();
        var role        = $('#role').val();
        $.ajax({
            url     : backend_url+'User-management/save-user',
            type    : 'POST',
            data    : {'id':id,'status':status,'status_user':status_user,'name':name,'id_user':id_user,'nip_npp':nip_npp,'email':email,'company':company,'role':role},
            dataType: 'JSON',
            cache   : false,
            beforeSend: function(xhr)
            {
                xhr.setRequestHeader('Authorization', 'Bearer '+window.localStorage.getItem('lfm_token'));
            },
            success: function(data)
            {   
                if(data.status == 'success')
                { 
                    setTimeout(function() {
                        swal.fire('Berhasil',"Berhasil Tambah User",'success');
                    }, 1000);
                    $("#modalUser").modal('hide');
                        loadDataTable();
                }
                else
                {
                    setTimeout(function() {
                        swal.fire('Gagal',data.message,'error');
                    }, 1000);
                }
    
                },
            error: function (jqXHR, textStatus, errorThrown)
            {
                setTimeout(function() {
                    swal.fire('Gagal',"Server Sedang Galau ..! / Atau Anda yang Galau ?",'error');
                }, 1000);
            }
        });
        
    }
}


function edit_user(id)
{
    $.ajax({
            url     : backend_url+'User-management/data-user',
            type    : 'POST',
            data    : {'id':id},
            dataType: 'JSON',
            cache   : false,
            beforeSend: function(xhr)
            {
                xhr.setRequestHeader('Authorization', 'Bearer '+window.localStorage.getItem('lfm_token'));
            },
            success: function(data)
            {   
                if(data)
                { 
                    var data = data.data[0];
                    // alert(data.id)
                    $('#id').val(data.id);
                    $('#status').val('edit');
                    getStatusUser(data.status_user);
                    $('#nip_npp_lman').val('0');
                    $('#name').val(data.name);
                    $('#id_user').val(data.user_id)
                    $('#nip_npp').val(data.nip_npp);
                    $('#email').val(data.email);
                    getCompany(data.company_id);
                    getRole(data.role_id);
                    $('#int_form').css('display','none');
                    $("#name").prop("readonly", true);
                    $("#nip_npp").prop("readonly", true);
                    $("#email").prop("readonly", true);
                    $("#status_user").prop("readonly", true);
                    $("#company").prop('readonly', true);
                    
                    $('#UserModalLabel').text('Edit User');
                    $("#modalUser").modal({
                        backdrop: 'static',
                        keyboard: false,
                        show    : true
                    });

                }
                else
                {
                    setTimeout(function() {
                        swal.fire('Gagal',"Terjadi Kesalahan Sistem",'error');
                    }, 1000);
                }

            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                setTimeout(function() {
                    swal.fire('Gagal',"Server Sedang Galau ..! / Atau Anda yang Galau ?",'error');
                }, 1000);
            }
        });
}


function delete_user(id,id2,id3)
{
    Swal.fire({
                title: 'Data akan dihapus?',
                text: "Data yang sudah dihapus tidak bisa dikembalikan",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya , Hapus!'
                // cancelButtonText: 'Ya , Hapus!'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url     : backend_url+'User-management/delete-user',
                        type    : 'POST',
                        data    : {'id':id,'id_user':id2,'status_user':id3},
                        dataType: 'JSON',
                        cache   : false,
                        // async:false,
                        beforeSend: function(xhr)
                        {
                            xhr.setRequestHeader('Authorization', 'Bearer '+window.localStorage.getItem('lfm_token'));   
                            KTApp.blockPage({
                                overlayColor: '#044929', //#044929  000000
                                type: 'v2',
                                state: 'primary',
                                size: 'lg',
                                message: 'Processing...'
                            });
                        },
                        success: function(data)
                        {
                            // alert(data.status);
                            if(data.status == 'success')
                            {
                                setTimeout(function() {
                                    swal.fire('Sukses',"Berhasil Dihapus",'success');
                                }, 1000);
                                loadDataTable();
        
                            }
                            else
                            {
                                swal.fire('Gagal',"Message :"+data.info,'error');
                            }
                            KTApp.unblockPage();
                        },
                        error: function (jqXHR, textStatus, errorThrown)
                        {
                            KTApp.unblockPage();
                            swal.fire('Gagal',"Error Server",'error');
                        }
                    });
                }
            })
}

