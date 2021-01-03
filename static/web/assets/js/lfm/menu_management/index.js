// var backend_url     = window.location.origin+"/lfm/dev/";
$(document).ready(function(){
    loadTreeMenu();
    loadDataTable();
// alert("etfeh")
});
$('#parent').select2({
    width:'100%',
    placeholder: 'Pilih Parent Menu'
});
$('#btn_add_menu').on('click', function(){
        $('#status').val('add');
        $('#MenuModalLabel').text('Tambah Menu Baru');
        getParent();
        $("#modalMenu").modal({
            backdrop: 'static',
            keyboard: false,
            show    : true
        });
        // $('#Mmodal-izin-usaha').find('form').trigger('reset');
});


function loadDataTable()
{
    $.ajax({
            url     : backend_url+'Menu-management/data-menu',
            type    : 'POST',
            data    : {'id':''},
            dataType: 'JSON',
            cache   : false,
            beforeSend: function()
            {

            },
            success: function(resp)
            { 
                var dataColums = resp.menu;
                $('#menu_tbl').DataTable({
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
                    // 'ajax'      :{
                    //                 'url' : backend_url+'Menu-management/data-menu',
                    //                 'type': 'POST',
                    //                 'data': {'id':''},
                    //             },
                                
                    'data'      : dataColums,
                    'columns'   :[
                                    { "data": "no" },
                                    { "data": "name"},
                                    { "data": "parent"},
                                    { "data": "code"},
                                    { "data": "link"},
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


function loadTreeMenu() {
        $("#treeMenu").jstree({
            "core": {
                "themes": {
                    "responsive": false
                },
                // so that create works
                "check_callback": true,
                'data': {
                    'url': function(node) {
                        return HOST_URL + '/api//jstree/ajax_data.php';
                    },
                    'data': function(node) {
                        return {
                            'parent': node.id
                        };
                    }
                }
            },
            "types": {
                "default": {
                    "icon": "fa fa-folder text-primary"
                },
                "file": {
                    "icon": "fa fa-menu  text-primary"
                }
            },
            "state": {
                "key": "demo3"
            },
            "plugins": ["dnd", "state", "types"]
        });
}



function getParent( idParent = '')
{
    $.ajax({
        url     : backend_url+'Menu-management/parent-menu',
        type    : 'POST',
        data    : {'id':''},
        dataType: 'JSON',
        cache   : false,
        beforeSend: function()
        {

        },
        success: function(resp)
        {   
            var data = resp;
            if(data.status)
            { 
                var parent    = data.menu;
                var htmlParent = '<option style="color:#3a7311;" value="">&#9724; ** Pilih Parent Menu **</option>';
                parent.forEach ( function(value){
                    htmlParent = htmlParent + "<option value="+value.id+">"+value.name+"</option>";
                });
                $('#parent').html(htmlParent);
                $('#parent').val(idParent);
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

function saveMenu()
{
       
        // var name = $('#name').val()
        var status =$('#status').val()
        var id =$('#id').val()
        var parent = $('#parent').val()
        var name = $('#name').val()
        var code = $('#code').val()
        var link = $('#link').val()
        $('#id').val()
        $.ajax({
            url     : backend_url+'Menu-management/save-menu',
            type    : 'POST',
            data    : {'id':id,'status':status,'parent':parent,'name':name,'code':code,'link':link},
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
                        swal.fire('Berhasil',"Berhasil Simpan Menu",'success');
                    }, 1000);
                    $("#modalMenu").modal('hide');
                    loadDataTable();
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



function edit_menu(id)
{
    $.ajax({
            url     : backend_url+'Menu-management/data-menu',
            type    : 'POST',
            data    : {'id':id},
            dataType: 'JSON',
            cache   : false,
            beforeSend: function()
            {
                
            },
            success: function(data)
            {   
                if(data.status == 'success')
                { 
                    var data = data.menu[0];
                    // alert(data.id)
                    $('#id').val(data.id);
                    $('#status').val('edit');
                    getParent(data.parent_id);
                    $('#name').val(data.name);
                    $('#code').val(data.code);
                    $('#link').val(data.link);
                    $('#MenuModalLabel').text('Edit Menu');
                    $("#modalMenu").modal({
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


function delete_menu(id)
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
                        url     : backend_url+'Menu-management/delete-menu',
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

