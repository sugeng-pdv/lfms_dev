var backend_url     = window.location.origin+"/lfm/dev/";
$(document).ready(function(){
    loadData();
// alert("etfeh")
});

$('#btn_add_role').on('click', function(){
        $('#status').val('add');
        $('#RoleModalLabel').text('Tambah Role Baru');
        $("#modalRole").modal({
            backdrop: 'static',
            keyboard: false,
            show    : true
        });
        // $('#Mmodal-izin-usaha').find('form').trigger('reset');
});

function edit_role(id)
{
    $.ajax({
            url     : backend_url+'Role-management/data-role',
            type    : 'POST',
            data    : {'id':id},
            dataType: 'JSON',
            cache   : false,
            beforeSend: function()
            {
                
            },
            success: function(data)
            {   
                if(data)
                { 
                    var data = data.data[0];
                    // alert(data.id)
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#description').val(data.description);
                    $('#status').val('edit');
                    $('#RoleModalLabel').text('Edit Role');
                    $("#modalRole").modal({
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
function delete_role(id)
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
                        url     : backend_url+'Role-management/delete-role',
                        type    : 'POST',
                        data    : {'id':id},
                        dataType: 'JSON',
                        cache   : false,
                        // async:false,
                        beforeSend: function()
                        {
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
                            if(data.status)
                            {
                                setTimeout(function() {
                                    swal.fire('Sukses',"Berhasil Dihapus",'success');
                                }, 1000);
                                loadData();
        
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
function saveRole()
{
        // var form_data = new FormData(this);
        // form_data.append("status",$('#status').val());
        // form_data.append("id",$('#id').val());
        // form_data.append("name",$('#name').val());
        // form_data.append("description",$('#description').val());
        var status =$('#status').val()
        var id =$('#id').val()
        var name = $('#name').val()
        var description = $('#description').val()
        $('#id').val()
        $.ajax({
            url     : backend_url+'Role-management/save-role',
            type    : 'POST',
            data    : {'id':id,'status':status,'name':name,'description':description},
            dataType: 'JSON',
            cache   : false,
            beforeSend: function()
            {
                
            },
            success: function(data)
            {   
                if(data.status)
                { 
                    setTimeout(function() {
                        swal.fire('Berhasil',"Berhasil Simpan Role",'success');
                    }, 1000);
                    $("#modalRole").modal('hide');
                    loadData();
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
// $(document).on('submit','#form_add_pemilik_usaha',function(){
//         var form_data = new FormData(this);
//         form_data.append("token",$('#token').val());
//         form_data.append("lman_csrf",$('#token_csrf').val());
//         $.ajax({
//             url     : backend_url+'save-pemilik-perusahaan',
//             type    : 'POST',
//             data    : form_data,
//             dataType: 'JSON',
//             processData : false,
//             contentType : false,
//             cache : false,
//             // async:false,
//             beforeSend: function()
//             {
//             //kosong sek
//             },
//             success: function(data)
//             {
//                 $('#token_csrf').val(data.token_csrf)
//                 if(data.status)
//                 {
//                     // $('#tbl_pemilik_usaha').DataTable().clear();
//                     swal.fire('Sukses',"Berhasil Simpan",'success');
//                     get_pemilik();
//                     $("#modal-pemilik-usaha").modal('hide');
//                     // $('#tbl_pemilik_usaha').DataTable().ajax.reload(null, false );
//                 }
//                 else
//                 {
//                     swal.fire('Gagal',"Gagal Simpan",'error');
//                 }
//             },
//             error: function (jqXHR, textStatus, errorThrown)
//             {
//                 swal.fire('Gagal',"Server Error",'error');
//             }
//         });
//         return false;
// });
function loadData()
{
    $('#role_tbl').DataTable({
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
        'ajax'      :{
                        'url' : backend_url+'Role-management/data-role',
                        'type': 'POST',
                        'data': {'id':''},
                    },
        'columns'   :[
                        // { "data": "num" },
                        { "data": "role"},
                        { "data": "pengguna"},
                        { "data": "action"}
                    ],
    });
}
