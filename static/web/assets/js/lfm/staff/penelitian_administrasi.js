var backend_url     = window.location.origin+"/lfm/dev/";
$(document).ready(function(){
    loadDataTable();
});

function loadDataTable()
{
    $.ajax({
            url     : backend_url+'Penelitian-administrasi-ppk/data-spp',
            type    : 'POST',
            data    : {'id':''},
            dataType: 'JSON',
            cache   : false,
            beforeSend: function(xhr)
            {
                xhr.setRequestHeader('Authorization','Bearer '+window.localStorage.getItem('lfm_token'))
            },
            success: function(resp)
            { 
                var dataColums = resp.data;
                if(resp.status === 'success'){
                    $.each(dataColums, function( index, value ) {
                        var statusSpp;
                        var sppClass;
                        var infoTertolak = '';
                        if(value.status_process === 'Belum Diteliti'){
                            statusSpp = false;
                            sppClass = 'label label-lg label-light-warning label-inline';
                        }else{
                            statusSpp = true;
                            if(value.status_spp === 'Tertolak' )
                            {
                                sppClass='label label-lg label-light-danger label-inline'
                                infoTertolak = value.status_spp+' - ';
                            }else{
                                sppClass='label label-lg label-light-success label-inline'
                                
                            }
                        }
                        
                        $('#spp-data-detail').clone().attr('id','spp-'+value.id).appendTo('#spp-data');
                        $('#spp-'+value.id+' #spp_type').text(value.psn_type+'-'+value.payment_to)
                        $('#spp-'+value.id+' #spp_no').text(value.spp_no);
                        $('#spp-'+value.id+' #psn_name').text(value.psn_name);
                        $('#spp-'+value.id+' #psn_info').text(value.psn_info).attr('class',sppClass);;
                        // $('#spp-'+value.id+' #psn_type').text(' Pembayaran '+value.psn_type);
                        $('#spp-'+value.id+' #status_spp').text(infoTertolak+''+value.status_process).attr('class',sppClass);
                        $('#spp-'+value.id+' #btnCompleteField').attr('onclick','detailBidang("'+value.id+'","'+value.spp_no+'","'+value.psn_name+'","'+value.status_spp+'","'+value.nominal_idr+'","'+value.psn_type+'","'+value.payment_to+'","'+value.status_process+'")');
                        $('#spp-'+value.id).show();
           			});
                    $('#infoDataKosong').css('display','none');
                }else{
                    if(resp.message === 'Data Kosong'){
                        $('#infoDataKosong').css('display','block');
                    }else{
                        setTimeout(function() {
                            swal.fire('Gagal',resp.message,'error');
                        }, 1000);
                        
                    }
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

function detailBidang(id,spp,name,status,nominal,payment,payment_to,spp_status)
{
    //cek apakah ada bidang yang tertolak
    // jika ada -> popup notifikasi beruppa modal
    // jika tidak ada langsung ke view input bidang
    
    // $("#requestPaymentModal").modal('hide');
    // $(".modal-backdrop").css('display','none');
    
    window.localStorage.setItem('before_url','penelitian-administrasi-ppk');
    window.localStorage.setItem('link_default','penelitian-administrasi-ppk-bidang');
    window.localStorage.setItem('id',id);
    window.localStorage.setItem('no_spp',spp);
    window.localStorage.setItem('spp_name',name);
    window.localStorage.setItem('spp_status',spp_status);
    window.localStorage.setItem('spp_nominal',nominal);
    window.localStorage.setItem('payment_change',payment);
    window.localStorage.setItem('payment_type_change',payment_to);
    get_data_container_body(window.localStorage.getItem('link_default'));
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
    window.localStorage.setItem('before_url','spp-detail');
    window.localStorage.setItem('payment_type','Warga');
    window.localStorage.setItem('link_default','spp-detail');
    get_data_container_body('spp-detail');
});
$('.btn-add-2').on('click',function(){
    $("#requestPaymentModal").modal('hide');
    $(".modal-backdrop").css('display','none');
    window.localStorage.setItem('before_url','spp-detail');
    window.localStorage.setItem('payment_type','Pengadilan');
    window.localStorage.setItem('link_default','spp-detail');
    get_data_container_body('spp-detail');
});
$('.btn-add-3').on('click',function(){
    $("#requestPaymentModal").modal('hide');
    $(".modal-backdrop").css('display','none');
    window.localStorage.setItem('before_url','spp-detail');
    window.localStorage.setItem('payment_type','Rekening KL');
    window.localStorage.setItem('link_default','spp-detail');
    get_data_container_body('spp-detail');
});

$('.btn-byr-tlg').on('click',function(){
    window.localStorage.setItem('payment','Talangan');
    window.localStorage.setItem('before_url','spp-detail');
    window.localStorage.setItem('payment_type','BUJT');
    window.localStorage.setItem('link_default','spp-detail');
    get_data_container_body('spp-detail')
})
$('.btn-byr-lsg').on('click',function(){
    window.localStorage.setItem('payment','Langsung');
    $("#requestPaymentModal").modal({
                        backdrop: 'static',
                        keyboard: false,
                        show    : true
                    });
})
$('.btn-byr-cof').on('click',function(){
    // window.localStorage.setItem('payment','COF');
    swal.fire('Gagal','Belum Ada Data','info');
    // $("#modalDetailBidangCof").modal({
    //                     backdrop: 'static',
    //                     keyboard: false,
    //                     show    : true
    //                 });
})


$( "body" ).on( "click", "#btnAddSpp", function() {
// $('#btnAddSpp').on('click',function(){
    $("#modalInputSpp").modal({
                        backdrop: 'static',
                        keyboard: false,
                        show    : true
                    });
    var paymentTo='';
    if(window.localStorage.getItem('payment') === 'Langsung'){
        paymentTo='-'+window.localStorage.getItem('payment_type');
    }
    $('#modalSppTitle').text('Input Dokumen Surat Pengajuan Pembayaran (SPP) '+ window.localStorage.getItem('payment')+paymentTo)
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
                $('#psn_name_data').val('');
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
function save_spp()
{
        var formData = $(".data-spp").serialize();
        $('#id').val()
        $.ajax({
            url     : backend_url+'spp/spp-save',
            type    : 'POST',
            data    : formData + "&payment_type=" + window.localStorage.getItem('payment')+ "&payment_to=" + window.localStorage.getItem('payment_type'),
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
                        swal.fire('Berhasil',"Berhasil Simpan SPP",'success');
                    }, 1000);
                    $("#modalInputSpp").modal('hide');
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



// $('.btnCompleteField').on('click',function($this){
//     inputBidang(this.value);
// });



// $('#tableDetailBidangRejected').on('change', '.group-checkable', function() {
$("body").on("change", "#tableDetailBidangRejected .group-checkable", function() {
    var set = $(this).closest('table').find('td:last-child .checkable');
    var checked = $(this).is(':checked');

    $(set).each(function() {
        if (checked) {
            $(this).prop('checked', true);
            $(this).closest('tr').addClass('active');
        } else {
            $(this).prop('checked', false);
            $(this).closest('tr').removeClass('active');
        }
    });
    countCheckedTableDetailBidangRejected();
    
});

// $('#tableDetailBidangRejected').on('change', 'tbody tr .checkbox', function() {
$("body").on("change", "#tableDetailBidangRejected tbody tr .checkbox", function() {
    $(this).parents('tr').toggleClass('active');
    countCheckedTableDetailBidangRejected();
});
function countCheckedTableDetailBidangRejected()
{
    var countchecked = $("#tableDetailBidangRejected input[type=checkbox]:checked").length;
    if(countchecked >= 1) 
    {
        $('#btnNextNewField').attr('disabled',false);
    }
    else
    {
        $('#btnNextNewField').attr('disabled',true);
    }
}

$('#btnSKipRejectField').click(function()
{
    window.localStorage.setItem('before_url','spp-detail');
    window.localStorage.setItem('link_default','bidang-detail');
    $("#modalDetailBidangRejected").modal({
        backdrop: 'static',
        keyboard: false,
        show    : false
    });
    $(".modal-backdrop").css('display','none');
    get_data_container_body(window.localStorage.getItem('link_default'));
});
$('#btnNextNewField').click(function()
{
    var insert = [];
    $("#tableDetailBidangRejected .checkable:checked").each(function() {
        var $row = $(this).closest('tr');
              $('td:first-child', $row).each(function(index){
                  var idSpp = $(this).text();
                    insert .push(idSpp);
              })
    });
    // insert = insert.toString();
    alert(insert)

    $.ajax({
            url     : backend_url+'Bidang-detail/bidang-reject-update',
            type    : 'POST',
            data    : {'data':insert,'id_spp': window.localStorage.getItem('id')},
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
                    window.localStorage.setItem('before_url','spp-detail');
                    window.localStorage.setItem('link_default','bidang-detail');
                    $("#modalDetailBidangRejected").modal({
                        backdrop: 'static',
                        keyboard: false,
                        show    : false
                    });
                    $(".modal-backdrop").css('display','none');
                    get_data_container_body(window.localStorage.getItem('link_default'));
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
    
});
// $( "body" ).on( "click", "#btnUndo", function() {
$('#btnUndo').on('click',function(){
    window.localStorage.removeItem('payment');
    window.localStorage.removeItem('payment_type');
    window.localStorage.setItem('link_default','request-payment');
    window.localStorage.setItem('before_url','home');
    get_data_container_body(window.localStorage.getItem('link_default'))
});



















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
