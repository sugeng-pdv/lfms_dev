$(document).ready(function(){
    getYearSearch();
    loadDataTable();
});
$('#psn_sector').select2({
    width:'100%',
    placeholder: 'Pilih Sektor PSN'
});

$('#business_entity').select2({
    width:'100%',
    placeholder: 'Pilih Badan Usaha'
});
$('#fiscal_year').select2({
    width:'100%',
    placeholder: 'Pilih Tahun Anggaran'
});

$('#fiscal_year_search').select2({
    width:'20%',
    placeholder: 'Tahun'
});

$('#payment_type').select2({
    width:'100%',
    placeholder: 'Pilih Jenis Pembayaran'
});

$('#payment_type_search').select2({
    width:'30%',
    placeholder: 'Jenis Pembayaran'
});



$('#area').mask('#.##0', {reverse: true});
$('#value').mask('#.##0', {reverse: true});
$('#allocation_ttl').mask('#.##0', {reverse: true});
$('#realization_ttl').mask('#.##0', {reverse: true});
$('#remaining_fund').mask('#.##0', {reverse: true});

// btnSaveBudget
$('#btnSaveBudget').on('click',function(){
    save_budget();
});


$('#payment_type_search').change(function(){
   loadDataTable(); 
});
$('#fiscal_year_search').change(function(){
   loadDataTable(); 
});
$('#psn_search').change(function(){
   loadDataTable(); 
});

function loadDataTable()
{
    $('#psn-data .result-psn').remove();
    var formData = $(".data-search").serialize();
    $.ajax({
            url     : backend_url+'Control_budget/data-psn',
            type    : 'POST',
            data    : formData,
            // data    : {'id':''},
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
                        if(value.status_spp === 'Belum Kirim'){
                            statusSpp = false;
                            sppClass = 'label label-lg label-light-warning label-inline';
                        }else{
                            statusSpp = true;
                            sppClass='label label-lg label-light-success label-inline'
                        }
                        $('#psn-data-detail').clone().attr('id','psn-'+value.id).addClass('result-psn').appendTo('#psn-data');
                        $('#psn-'+value.id+' #psn_name_data').text(value.name)
                        $('#psn-'+value.id+' #fiscal_year_data').text(value.fiscal_year);
                        $('#psn-'+value.id+' #area_data').text(value.area);
                        $('#psn-'+value.id+' #institution_data').text(value.institution);
                        $('#psn-'+value.id+' #saldo_psn').text("Nilai Saldo Tabungan PSN : "+value.nominal);
                        $('#psn-'+value.id+' #btnCompleteField').attr('onclick','editPsn("'+value.id+'","'+value.id_sector+'","'+value.name_edit+'","'+value.fiscal_year+'","'+value.nominal_edit+'","'+value.id_institution+'","'+value.area_edit+'")');
                        $('#psn-'+value.id+' #btnEditDetailPsn').attr('onclick','editDetailPsn("'+value.id+'")');
                        $('#psn-'+value.id).show();
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

$( "body" ).on( "click", "#btnAddPsn", function() {
// $('#btnAddSpp').on('click',function(){
    $('#modalSppTitle').text('Input alokasi anggaran PSN')
    $("#modalInputPsn").modal({
                        backdrop: 'static',
                        keyboard: false,
                        show    : true
                    });
    getSectorPsn();
    getYear();
    getBusinessEntity();
    $('#type').val('add');
    $('#btnSavePsn').prop('disabled',true);
                    
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
function getYear(year='')
{
    // fiscal_year
    var startYear = 2015;
    var defaultYear = new Date().getFullYear();
    var htmlData = '<option style="color:#3a7311;" value="">&#9724; ** Pilih Tahun Anggaran **</option>';

    for(var Y=(defaultYear+1); Y>=startYear; Y--) {
      htmlData = htmlData + "<option value="+Y+">"+Y+"</option>";
    }
    $('#fiscal_year').html(htmlData);
    $('#fiscal_year').val(year);
    
}
function getYearSearch(year='')
{
    // fiscal_year
    var startYear = 2015;
    var defaultYear = new Date().getFullYear();
    var htmlData = '<option style="color:#3a7311;" value="">&#9724; ** Tahun Anggaran **</option>';
    htmlData = htmlData + '<option style="color:#3a7311;" value="all">Semua Tahun</option>';

    for(var Y=(defaultYear+1); Y>=startYear; Y--) {
      htmlData = htmlData + "<option value="+Y+">"+Y+"</option>";
    }
    $('#fiscal_year_search').html(htmlData);
    $('#fiscal_year_search').val(year);
    // $('#fiscal_year_search').addClass('data-search');
    
}
function getBusinessEntity(id='')
{
    $.ajax({
        url     : backend_url+'Control_budget/businessEntity-data',
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
                var htmlData = '<option style="color:#3a7311;" value="">&#9724; ** Pilih Badan Usaha **</option>';
                parent.forEach ( function(value){
                    htmlData = htmlData + "<option value="+value.id+">"+value.name+"</option>";
                });
                $('#business_entity').html(htmlData);
                $('#business_entity').val(id);
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

function save_budget()
{
        var formData = $(".data-budget").serialize();
        $('#id').val()
        $.ajax({
            url     : backend_url+'Control_budget/budget-save',
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
                        swal.fire('Berhasil',"Control Budget PSN telah berhasil tersimpan",'success');
                    }, 1000);
                    $("#modalInputPsn").modal('hide');
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
function editPsn(id,id_sector,name,fiscal_year,nominal,institution,area)
{
    
    var formData = $(".data-search").serialize();
    $.ajax({
            url     : backend_url+'Control_budget/data-psn',
            type    : 'POST',
            data    : formData+"&id="+id,
            // data    : {'id':''},
            dataType: 'JSON',
            cache   : false,
            beforeSend: function(xhr)
            {
                xhr.setRequestHeader('Authorization','Bearer '+window.localStorage.getItem('lfm_token'))
            },
            success: function(resp)
            { 
                var dataColums = resp.data[0];
                if(resp.status === 'success'){
                    $('#id').val(id);
                    $('#type').val('edit_anggaran');
                    getSectorPsn(dataColums.id_sector);
                    $('#psn_name').val(dataColums.name_edit).attr('readonly',true);
                    getYear(dataColums.fiscal_year);
                    $('#value').val(dataColums.nominal_edit).attr('readonly',false);
                    getBusinessEntity(dataColums.id_institution);
                    $('#area').val(dataColums.area);
                    $('#kepdirut_num').val(dataColums.kepdir_num);
                    $('#payment_type').val(dataColums.payment_type).trigger('change');
                    $('#allocation_ttl').val(dataColums.allocation_ttl).attr('readonly',false);
                    $('#realization_ttl').val(dataColums.realization_ttl).attr('readonly',false);
                    $('#remaining_fund').val(dataColums.remaining_fund).attr('readonly',false);
                    
                    $('#modalSppTitle').text('Update Aggaran alokasi anggaran PSN')
                    $("#modalInputPsn").modal({
                        backdrop: 'static',
                        keyboard: false,
                        show    : true
                    });
                    
                }else{
                    if(resp.message === 'Data Kosong'){
                        swal.fire('Gagal','Tidak ada data','error');
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
function editDetailPsn(id)
{
    
    var formData = $(".data-search").serialize();
    $.ajax({
            url     : backend_url+'Control_budget/data-psn',
            type    : 'POST',
            data    : formData+"&id="+id,
            // data    : {'id':''},
            dataType: 'JSON',
            cache   : false,
            beforeSend: function(xhr)
            {
                xhr.setRequestHeader('Authorization','Bearer '+window.localStorage.getItem('lfm_token'))
            },
            success: function(resp)
            { 
                var dataColums = resp.data[0];
                if(resp.status === 'success'){
                    $('#id').val(id);
                    $('#type').val('edit_detail');
                    getSectorPsn(dataColums.id_sector);
                    $('#psn_name').val(dataColums.name_edit);
                    getYear(dataColums.fiscal_year);
                    $('#value').val(dataColums.nominal_edit).attr('readonly',true);
                    getBusinessEntity(dataColums.id_institution);
                    $('#area').val(dataColums.area);
                    $('#kepdirut_num').val(dataColums.kepdir_num);
                    $('#payment_type').val(dataColums.payment_type).trigger('change');
                    $('#allocation_ttl').val(dataColums.allocation_ttl).attr('readonly',true);;
                    $('#realization_ttl').val(dataColums.realization_ttl).attr('readonly',true);;
                    $('#remaining_fund').val(dataColums.remaining_fund).attr('readonly',true);;
                    
                    $('#modalSppTitle').text('Update Detail alokasi anggaran PSN')
                    $("#modalInputPsn").modal({
                        backdrop: 'static',
                        keyboard: false,
                        show    : true
                    });
                    
                }else{
                    if(resp.message === 'Data Kosong'){
                        swal.fire('Gagal','Tidak ada data','error');
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

// payment_type
$('#payment_type').change(function () {
		var val = $(this).val();
		
// 		alert(val)
		if(val === 'Langsung'){
		    $('.div_business_entity').css('display','none');
		}else{
		    $('.div_business_entity').css('display','block');
		}
		
}); 

































// $('#value').autoNumeric('init');

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





// payment_type
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
