
$(document).ready(function(){
    loadDataTable();
});
$('#name_pic').select2({
    width:'100%',
    maximumInputLength: 2,
    placeholder: 'Pilih Nama Pegawai'
});

function loadDataTable()
{
    $('#spp-data .result-spp').remove();
    $.ajax({
            url     : backend_url+'Penelitian_administrasi/detail_summary_spp',
            type    : 'POST',
            data    : {'id_spp':window.localStorage.getItem('spp_id')},
            dataType: 'JSON',
            cache   : false,
            beforeSend: function(xhr)
            {
                xhr.setRequestHeader('Authorization','Bearer '+window.localStorage.getItem('lfm_token'))
            },
            success: function(resp)
            { 
                var dataSpp = resp.dataSpp[0];
                var dataBidang = resp.dataBidang;
                var dataLampiran = resp.dataLampiran;
                if(resp.status === 'success'){
                    $('#spp_no').text(dataSpp.spp_no);
                    $('#psn_name').text(dataSpp.psn_name);
                    // $('#pp_type').text(dataSpp.psn_type+' '+dataSpp.payment_to);
                    $('#nd_date').text("Tanggal "+ GetTodayDate());
                    $('#tableSummarySpp').DataTable({
                        'searching'   : false,
                        'destroy'     : true,
                        // 'dom'         :"brtlp",
                        'responsive'  : true,
                        'processing'  : true,
                        'paging'      : false,
                        'lengthChange': false,
                        'ordering'    : true,
                        'info'        : false,
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
                                    
                        'data'      : dataBidang,
                        'columns'   :[
                                        { "data": "num" },
                                        { "data": "type_field"},
                                        { "data": "nominal_idr"},
                                        { "data": "result"},
                                        { "data": "noted"}
                                    ],
                    });
                }else{
                    setTimeout(function() {
                            swal.fire('Gagal',resp.message,'error');
                        }, 1000);
                }
                
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                setTimeout(function() {
                    swal.fire('Gagal',"Error Server ?",'error');
                }, 1000);
            }
    });
            return false;
}

$('#rejectSpp').click(function(){
    // Swal.fire({
    //     title: "Catatan Tertolak",
    //     text: "",
    //     input: 'textarea',
    //     showCancelButton: true ,
    //     confirmButtonColor: 'green'
    //     }).then((result) => {
    //     if (result.value) {
    //         Swal.fire('Result:'+result.value);
    //     }});
            
    
    
    
    
    
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-outline-success',
      },
      buttonsStyling: false
    })
    
    swalWithBootstrapButtons.fire({
        text: "Catatan Tertolak",
        showCancelButton: true,
        confirmButtonColor: '#1BC5BD',
        cancelButtonColor: '#d33',
        cancelButtonText: 'Batalkan!',
        confirmButtonText: 'Ya , Tolak!',
        reverseButtons: true,
        showLoaderOnConfirm: true,
        width: '800px',
        input: 'textarea',
        inputLabel: 'Message',
        inputPlaceholder: 'Catatan tertolak',
        inputAttributes: {
        'aria-label': 'Type your message here'
        },
        inputValidator: (input) => {
            if (!input) {
              return 'Silahkan isi catatan tertolak'
            }
          }
    }).then((result) => {
        if (result.isConfirmed) {
            if (result.value) {
                alert("dhfbhdbfj")
                $.ajax({
                    url     : backend_url+'Penelitian_administrasi/update-spp-approval-kadiv',
                    type    : 'POST',
                    data    : {'id_spp':window.localStorage.getItem('spp_id'),'message':result.value,'status':'Tertolak'},
                    dataType: 'JSON',
                    cache   : false,
                    beforeSend: function(xhr)
                    {
                        xhr.setRequestHeader('Authorization', 'Bearer '+window.localStorage.getItem('lfm_token'));
                    },
                    success: function(resp)
                    { 
                        if(resp.status === 'success'){
                            swal.fire('Sukses','Spp yang anda tolak berhasil disimpannn','info');
                            $('#btnUndo').click();
                            // setTimeout($('#btnUndo').click(),10000);
                        }else{
                            swal.fire('Gagal',resp.message,'info');
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        setTimeout(function() {
                            swal.fire('',"Error Server ?",'error');
                        }, 1000);
                    }
                });
            }
        }else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
            ) 
        {
            
        }
    
    });
    
    
});


$('#acceptSpp').click(function(){
    // window.localStorage.setItem('link_default','nd_spp');
    // window.localStorage.setItem('before_url','decision-spp');
    // get_data_container_body(window.localStorage.getItem('link_default'))
    const swalWithBootstrapButtons = Swal.mixin({
      customClass: {
        confirmButton: 'btn btn-success',
        cancelButton: 'btn btn-outline-success'
      },
      buttonsStyling: false
    })
    
    swalWithBootstrapButtons.fire({
      title: 'Apakah Anda yakin menyetujui SPP ?',
      text: "",
      icon: 'question',
      showCancelButton: true,
      confirmButtonText: 'Ya, Kirim',
      cancelButtonText: 'Batalkan',
      reverseButtons: true
    }).then((result) => {
      if (result.isConfirmed) {
                $.ajax({
                    url     : backend_url+'Penelitian_administrasi/update-spp-approval-kadiv',
                    type    : 'POST',
                    data    : {'id_spp':window.localStorage.getItem('spp_id'),'message':'','status':'Diterima'},
                    dataType: 'JSON',
                    cache   : false,
                    beforeSend: function(xhr)
                    {
                        xhr.setRequestHeader('Authorization', 'Bearer '+window.localStorage.getItem('lfm_token'));
                    },
                    success: function(resp)
                    { 
                        if(resp.status === 'success'){
                            swal.fire('Sukses','SPP berhasil diapprove','success');
                            // swal.fire('Sukses','Data yang anda Approve sudah terkirim ke Direktur dan telah di informasikan ke KADIV ATL melalui Email','success');
                            undo();
                            // setTimeout($('#btnUndo').click(),10000);
                        }else{
                            swal.fire('Gagal',resp.message,'info');
                        }
                    },
                    error: function (jqXHR, textStatus, errorThrown)
                    {
                        setTimeout(function() {
                            swal.fire('',"Error Server ?",'error');
                        }, 1000);
                    }
                });
        // swalWithBootstrapButtons.fire(
        //   'Deleted!',
        //   'Your file has been deleted.',
        //   'success'
        // )
      } 
    
    })
});

$('#btnUndo').on('click',function(){
    // window.localStorage.removeItem('spp_id');
    window.localStorage.setItem('link_default','decision-spp');
    window.localStorage.setItem('before_url','penelitian-administrasi');
    get_data_container_body(window.localStorage.getItem('link_default'));
});
function undo(){
    window.localStorage.removeItem('spp_id');
    window.localStorage.setItem('link_default','penelitian-administrasi');
    window.localStorage.setItem('before_url','');
    get_data_container_body(window.localStorage.getItem('link_default'));
}







function updatePic(id=null)
{
    $.ajax({
            url     : backend_url+'Penelitian_administrasi/data-spp',
            type    : 'POST',
            data    : {'id_spp':id},
            dataType: 'JSON',
            cache   : false,
            beforeSend: function(xhr)
            {
                xhr.setRequestHeader('Authorization', 'Bearer '+window.localStorage.getItem('lfm_token'));
            },
            success: function(resp)
            { 
                if(resp.status === 'success'){
                    var data = resp.data[0];
                    $('#id_spp').val(id);
                    get_pic(data.pic);
                    
                    $('#picModalLabel').text('Update Pegawai PIC SPP : ' + data.psn_name);
                    $("#modalUpdatePic").modal({
                        backdrop: 'static',
                        keyboard: false,
                        show    : true
                    });
                    
                }else{
                    swal.fire('Gagal',resp.message,'info');
                }
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                setTimeout(function() {
                    swal.fire('',"Error Server ?",'error');
                }, 1000);
            }
    });
}
function get_pic(id='')
{
    $.ajax({
        url     : backend_url+'Penelitian_administrasi/data-pegawai',
        type    : 'POST',
        data    : {'id':id},
        dataType: 'JSON',
        cache   : false,
        beforeSend: function(xhr)
        {
            xhr.setRequestHeader('Authorization', 'Bearer '+window.localStorage.getItem('lfm_token'));
        },
        success: function(resp)
        {   
            var data = resp;
            if(data.status === 'success')
            { 
                var parent    = data.data;
                var htmlData = '<option style="color:#3a7311;" value="">&#9724; ** Pilih Pegawai **</option>';
                parent.forEach ( function(value){
                    htmlData = htmlData + "<option value="+value.userid_name+">"+value.name+"</option>";
                });
                $('#name_pic').html(htmlData);
                $('#name_pic').val(id);
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
                    swal.fire('Gagal',"Error",'error');
                }, 1000);
            }
        });
}
function saveUpdatePic()
{
    var formData = $(".data-update-pegawai").serialize();
    // alert($("#name_pic").val());
    // return false;
        $.ajax({
            url     : backend_url+'Penelitian_administrasi/pic-update',
            type    : 'POST',
            data    : formData,
            dataType: 'JSON',
            cache   : false,
            beforeSend: function(xhr)
            {
                xhr.setRequestHeader('Authorization', 'Bearer '+window.localStorage.getItem('lfm_token'));
            },
            success: function(data)
            {   
                if(data.status === 'success')
                { 
                    setTimeout(function() {
                        swal.fire('Berhasil',"Berhasil Input Bidang",'success');
                    }, 1000);
                    $("#modalUpdatePic").modal('hide');
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
                    swal.fire('Gagal',"Terjadi error,Silahkan coba input ulang !",'error');
                }, 1000);
            }
        });
}




















$('#psn_sector').select2({
    width:'100%',
    placeholder: 'Pilih Sektor PSN'
});
$('#psn_name_data').select2({
    width:'100%',
    placeholder: 'Pilih Nama PSN'
});
// $('#value').autoNumeric('init');
$('#value').mask('#.##0', {reverse: true});
$('#field_count').mask('#.##0',{reverse:true});

$('.btn-add-1').on('click',function(){
    $("#requestPaymentModal").modal('hide');
    $(".modal-backdrop").css('display','none');
    window.localStorage.setItem('link_default','spp-detail');
    get_data_container_body('spp-detail')
});

$('.btn-byr-tlg').on('click',function(){
    $("#requestPaymentModal").modal({
                        backdrop: 'static',
                        keyboard: false,
                        show    : true
                    });
})
$('.btn-byr-lsg').on('click',function(){
    $("#requestPaymentModal").modal({
                        backdrop: 'static',
                        keyboard: false,
                        show    : true
                    });
})
$('.btn-byr-cof').on('click',function(){
    $("#requestPaymentModal").modal({
                        backdrop: 'static',
                        keyboard: false,
                        show    : true
                    });
})


$( "body" ).on( "click", "#btnAddSpp", function() {
// $('#btnAddSpp').on('click',function(){
    $("#modalInputSpp").modal({
                        backdrop: 'static',
                        keyboard: false,
                        show    : true
                    });
    getSectorPsn();
    $('#btnSaveSpp').prop('disabled',true);
                    
})

$('#psn_sector').change(function() {
        getPsnName(this.value);
});
// btnSaveSpp
$('#btnSaveSpp').on('click',function(){
    save_spp();
})
$('#doc_spp').change(function () {
		var i = $(this).prev('label').clone();
// 		alert($('#doc_spp')[0].files.length)
        if($('#doc_spp')[0].files.length === 0){
            $(this).prev('label').text("UPLOAD DOKUMEN");
            $('#id_doc_spp').val("");
        }else{
		var file = $('#doc_spp')[0].files[0].name;
            $(this).prev('label').text(file);
            upload_spp();
        }
}); 

function getSectorPsn(id='')
{
    $.ajax({
        url     : backend_url+'Spp/sectorPsn-data',
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
                var htmlData = '<option style="color:#3a7311;" value="">&#9724; ** Pilih Sektor PSN **</option>';
                parent.forEach ( function(value){
                    htmlData = htmlData + "<option value="+value.id+">"+value.name+"</option>";
                });
                $('#psn_sector').html(htmlData);
                $('#psn_sector').val(id);
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
function getPsnName(id='')
{
    $.ajax({
        url     : backend_url+'Spp/namePsn-data',
        type    : 'POST',
        data    : {'id':id},
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
                var htmlData = '<option style="color:#3a7311;" value="">&#9724; ** Pilih PSN **</option>';
                parent.forEach ( function(value){
                    htmlData = htmlData + "<option value="+value.id+">"+value.name+"</option>";
                });
                $('#psn_name_data').html(htmlData);
                $('#psn_name_data').val(id);
                $('#div-psn-name').css('display','block')
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

function upload_spp(){
    var file = $('#doc_spp')[0].files[0];
    var fileExt = $('#doc_spp')[0].files[0].type;
    // cek jenis file
    var fileTypeAllowed = ["application/pdf"];
    if (jQuery.inArray(fileExt, fileTypeAllowed) < 0) {
        swal.fire("Gagal!", 'Jenis file yang diizinkan hanya .pdf', "error");
    } else {
        let batas = 10 // dalam MB
        // cek ukuran file
        if (parseInt(file.size) > (batas * 1048576)) {
            Swal.fire("Gagal!", 'Ukuran file yang diizinkan maksimal ' + batas + ' MB.', "error");
        } else {
            $('#id_doc_spp').val("");
            $.ajax({
                url: backend_url + 'file/get_s3_url',
                type: 'GET',
                beforeSend: function(xhr) {
                    xhr.setRequestHeader('Authorization', 'Bearer '+window.localStorage.getItem('lfm_token'));
                },
                dataType: 'json',
                data: {},
                async: false,
                success: function(retdata) {
                    if (retdata.status == 'success') {
                        var s3UploadUrl = retdata.url
                        $.ajax({
                            url: backend_url + 'File/upload_file',
                            type: 'POST',
                            beforeSend: function(xhr) {
                                xhr.setRequestHeader('Authorization', 'Bearer '+window.localStorage.getItem('lfm_token'));
                            },
                            dataType: 'json',
                            data: {
                                file_name: file.name
                            },
                            async: false,
                            success: function(retdata) {
                                var dataS3 = retdata.data;
                                var bucket = retdata.bucket;
                                let s3FormData = new FormData();
                                s3FormData.append('file', file);
                                Object.keys( dataS3 ).forEach( key => {
                                            s3FormData.append( `${key}`, `${dataS3[key]}` )
                                        });
                                // Object.keys(dataS3).forEach(key => {
                                //     s3FormData.append(`$ {
                                //         key
                                //     }`, `$ {
                                //         dataS3[key]
                                //     }`)
                                // });
                                $.ajax({
                                    url: s3UploadUrl,
                                    type: 'POST',
                                    beforeSend: function(xhr) {
                                        // xhr.setRequestHeader('Authorization', 'Bearer '+window.localStorage.getItem('lfm_token'));
                                    },
                                    // dataType: 'json',
                                    data: s3FormData,
                                    processData: false,
                                    contentType: false,
                                    cache: false,
                                    async: false,
                                    success: function(retdata) {
                                        let s3FormData = new FormData();
                                        s3FormData.append('id', '1');
                                        s3FormData.append('s3_bucket', bucket);
                                        s3FormData.append('s3_object', dataS3.key);
                                        $.ajax({
                                            url: backend_url + 'File/save-file',
                                            type: 'POST',
                                            // data    : param + '&' + $.param({csrf_token_lman:newToken}),
                                            data: s3FormData,
                                            dataType: 'JSON',
                                            processData: false,
                                            contentType: false,
                                            cache: false,
                                            // async:false,
                                            beforeSend: function(xhr) {
                                                xhr.setRequestHeader('Authorization', 'Bearer '+window.localStorage.getItem('lfm_token'));
                                            },
                                            success: function(data) {
                                                $('#token_csrf').val(data.token_csrf)
                                                if (data.status === true) {
                                                    $('#id_doc_spp').val(data.id);
                                                    $('#btnSaveSpp').prop('disabled',false);
                                                    // swal.fire('Sukses', "Berhasil Simpan", 'success');
                                                } else {
                                                    swal.fire('Gagal', data.message, 'error');
                                                }
                                            },
                                            error: function(jqXHR, textStatus, errorThrown) {
                                                swal.fire('Gagal', "Server Error", 'error');
                                            }
                                        });
                                        return false;
    
                                    }
                                });
    
                            },
                            //   error: handleAjaxError
                        });
    
                    } else {
                        swal.fire("Gagal!", retdata.message, "error");
    
                    }
                },
                //   error: handleAjaxError
            });
    
        }
    } // akhir - cek jenis file
    return false;
}




// $('.btnCompleteField').on('click',function($this){
//     inputBidang(this.value);
// });

function inputBidang(id)
{
    //cek apakah ada bidang yang tertolak
    // jika ada -> popup notifikasi beruppa modal
    // jika tidak ada langsung ke view input bidang
    
    // $("#requestPaymentModal").modal('hide');
    $(".modal-backdrop").css('display','none');
    window.localStorage.setItem('link_default','bidang-detail');
    get_data_container_body('bidang-detail')
    
    
}



















function getRole( id = '')
{
    $.ajax({
        url     : backend_url+'Authority-management/role-data',
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

function getMenu( id = '')
{
    $.ajax({
        url     : backend_url+'Authority-management/menu-data',
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
                var parent    = data.data;
                var htmlData = '<option style="color:#3a7311;" value="">&#9724; ** Pilih Menu **</option>';
                parent.forEach ( function(value){
                    htmlData = htmlData + "<option value="+value.id+">"+value.name+"</option>";
                });
                $('#menu').html(htmlData);
                $('#menu').val(id);
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

function getAuthority( id = '')
{
    var htmlData = '<option style="color:#3a7311;" value="">&#9724; ** Pilih Authority **</option>';
    htmlData = htmlData + '<option value="R">READ</option>';
    htmlData = htmlData + '<option value="RW">READ-WRITE</option>';
    $('#authority').html(htmlData);
    $('#authority').val(id);
}

function saveAuthority()
{
       
        // var name = $('#name').val()
        var status =$('#status').val()
        var id =$('#id').val()
        var role = $('#role').val()
        var menu = $('#menu').val()
        var authority = $('#authority').val()
        $('#id').val()
        $.ajax({
            url     : backend_url+'Authority-management/save-authority',
            type    : 'POST',
            data    : {'id':id,'status':status,'role':role,'menu':menu,'authority':authority},
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
                    $("#modalAuthority").modal('hide');
                    loadDataTable();
                    // window.localStorage.setItem('link_default','Authority-management');
                    setTimeout(function () { window.location = window.backend_url }, 2000);
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



function edit_authority(id)
{
    $.ajax({
            url     : backend_url+'Authority-management/data-authority',
            type    : 'POST',
            data    : {'id':id},
            dataType: 'JSON',
            cache   : false,
            beforeSend: function()
            {
                
            },
            success: function(data)
            {   
                if(data.status === 'success')
                { 
                    var data = data.data[0];
                    // alert(data.id)
                    $('#id').val(data.id);
                    $('#status').val('edit');
                    getRole(data.role_id);
                    getMenu(data.menu_id);
                    getAuthority(data.authority);
                    // $('#authority').val(data.authority);
                    $('#AuthorityModalLabel').text('Edit Authority');
                    $("#modalAuthority").modal({
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


function delete_authority(id)
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
                        url     : backend_url+'Authority-management/delete-authority',
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
                                loadDataTable();
                                setTimeout(function() {
                                    swal.fire('Sukses',"Berhasil Dihapus",'success');
                                }, 1000);
                                window.localStorage.setItem('link_default','Authority-management');
                                setTimeout(function () { window.location = window.backend_url }, 2000);
        
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
