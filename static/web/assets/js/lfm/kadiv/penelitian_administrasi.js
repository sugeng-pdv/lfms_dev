
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
            url     : backend_url+'Penelitian_administrasi/data-spp',
            type    : 'POST',
            data    : {'id_spp':''},
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
                        var statusSpp,classInfoPic,sppClass,btnTaskTxt;
                        if(value.status_spp == 'Tertolak')
                        {
                            statusSpp = false;
                            value.status_process = value.status_spp;
                            sppClass = 'label label-lg label-light-danger label-inline';
                            $('#infoDetail').css('display','none');
                            $('#infoDecision').css('display','none');
                        }else{
                            if(value.status_process === 'Belum Diteliti'){
                                statusSpp = false;
                                sppClass = 'label label-lg label-light-danger label-inline';
                                $('#infoDetail').css('display','none');
                                $('#infoDecision').css('display','none');
                            }else if(value.status_process === 'Dalam Proses Penelitian'){
                                statusSpp = false;
                                sppClass = 'label label-lg label-light-warning label-inline';
                                $('#infoDetail').css('display','none');
                                $('#infoDecision').css('display','none');
                            }else if(value.status_process === 'Sudah Diteliti'){
                                statusSpp = true;
                                sppClass='label label-lg label-light-success label-inline';
                                $('#infoDetail').css('display','none');
                                $('#infoDecision').css('display','block');
                            }else{
                                statusSpp = true;
                                sppClass='label label-lg label-light-success label-inline';
                                $('#infoDetail').css('display','block');
                                $('#infoDecision').css('display','none');
                            }
                        }
                        if(value.pic === ""){
                            classInfoPic = "bg-light-danger";
                            classbtnTaskTxt = "text-danger";
                            btnTaskTxt ='Tambah Penugasan Baru';
                        }else{
                            classInfoPic = "bg-light-success";
                            classbtnTaskTxt = "text-success";
                            btnTaskTxt = 'Perubahan Penugasan Baru';
                        }
                        $('#spp-data-detail').clone().attr('id','spp-'+value.id).addClass('result-spp').appendTo('#spp-data');
                        $('#spp-'+value.id+' #spp_type').text(value.psn_type+'-'+value.payment_to)
                        $('#spp-'+value.id+' #spp_no').text(value.spp_no);
                        $('#spp-'+value.id+' #psn_name').text(value.psn_name);
                        // $('#spp-'+value.id+' #psn_type').text(' Pembayaran '+value.psn_type);
                        $('#spp-'+value.id+' #status_spp').text(value.status_process).attr('class',sppClass);
                        $('#spp-'+value.id+' #btnDecision').attr('onclick','decisionSpp("'+value.id+'")');
                        $('#spp-'+value.id+' #btnDetail').attr('onclick','detailSpp("'+value.id+'")');
                        
                        $('#spp-'+value.id+' #info-pic').addClass(classInfoPic);
                        $('#spp-'+value.id+' #staff_pic').text("Staff Divisi Pendanaan Lahan : "+value.pic2);

                        
                        
                        $('#spp-'+value.id+' #btnTask').attr('onclick','updatePic("'+value.id+'")').text(btnTaskTxt).addClass(classbtnTaskTxt);
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


function detailSpp(id='')
{
    window.localStorage.setItem('before_url','penelitian-administrasi');
    window.localStorage.setItem('link_default','summary-spp');
    window.localStorage.setItem('spp_id',id)
    get_data_container_body('summary-spp')
}
function decisionSpp(id='')
{
    window.localStorage.setItem('before_url','penelitian-administrasi');
    window.localStorage.setItem('link_default','decision-spp');
    window.localStorage.setItem('spp_id',id)
    get_data_container_body('decision-spp')
}













$( "body" ).on( "click", "#btnInputField", function() {
    var src = 'https://www.youtube.com/embed/f0jt7wFru7c';
    // var src = 'https://www.youtube.com/embed/f0jt7wFru7c&amp;autoplay=1';
    $('.videoTutorialBidang').removeAttr('id').attr('id','btnCloseVideo');
    $('#modalTutorialBidang iframe').attr('src',src);
    $("#modalTutorialBidang").modal({
                        backdrop: 'static',
                        keyboard: false,
                        show    : true
                    });
});

$('#btnSaveField').click(function(){
    save_bidang();
});
function save_bidang()
{
        var formData = $(".data-bidang").serialize();
        $.ajax({
            url     : backend_url+'Bidang-detail/bidang-save',
            type    : 'POST',
            data    : formData+ "&payment_type=" + window.localStorage.getItem('payment_change')+ "&payment_to=" + window.localStorage.getItem('payment_type_change'),
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
                    $("#modalInputBidang").modal('hide');
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


function edit_field(id)
{
    $.ajax({
            url     : backend_url+'Bidang_detail/data-bidang',
            type    : 'POST',
            data    : {'id_spp':window.localStorage.getItem('id'),'id_bidang':id},
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
                    $('.data-bidang').val('');
                    $('.data-dokumen').text('Ubah File');
                    
                    $('#id_spp').val(data.spp_id);
                    $('#id_bidang').val(data.id);
                    $('#spp_num').val(data.no_spp);
                    $('#name').val(data.name);
                    get_jenis_bidang(data.type_field_id);//select
                    $('#nik').val(data.nik);
                    $('#no_nominatif').val(data.no_nominatif);
                    $('#nib_temp').val(data.nib);
                    get_province('',data.province);//select2
                    get_district(data.province,data.district);//select2
                    get_subdistrict(data.district,data.sub_district);//select2
                    get_village(data.sub_district,data.village);//select2
                    $('#ownership_type').val(data.proof_owner);
                    $('#field_area').val(data.area);
                    $('#price').val(data.nominal);
                    $('#id_doc_nik').val(data.nik_doc_id);
                    $('#id_doc_poo').val(data.poo_doc_id);
                    $('#id_doc_result').val(data.result_doc_id);
                    $('#id_doc_letter').val(data.letter_doc_id);
                    $('#id_doc_sptjm').val(data.sptjm_doc_id);
                    
                    $('#modalBidangTitle').text('Edit Detail Bidang yang akan diajukan');
                    $('#div_province,#div_district,#div_subdistrict').css('display','none');
                    $('#div_village').css('display','block');
                    $("#modalInputBidang").modal({
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

// $('#btnSendRequestSpp').click(function(){
$( "body" ).on( "click", "#btnSendRequestSpp", function() {
   Swal.fire({
                title: '',
                text: "Dengan mengirimkan berkas ini, saya selaku PPK menyatakan bertanggung jawab atas kebenaran dan kelengkapannya.",
                icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#1BC5BD',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Batalkan',
                confirmButtonText: 'Ya , Kirim!',
                reverseButtons: true,
                showLoaderOnConfirm: true,
                width: '600px'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        url     : backend_url+'Bidang-detail/bidang-send',
                        type    : 'POST',
                        data    : {'id_spp':window.localStorage.getItem('id'),'spp_name':window.localStorage.getItem('spp_name'),'spp_nominal':window.localStorage.getItem('spp_nominal')},
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
                                window.localStorage.setItem('spp_status','Sudah Kirim');
                                $('.spp-status-title').text('Sudah Kirim');
                                $('#codeRequest').text(data.code)
                                $("#modalSuccessRequestBidang").modal({
                                    backdrop: 'static',
                                    keyboard: false,
                                    show    : true
                                });
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
                    // $("#modalInputBidang").modal({
                    //     backdrop: 'static',
                    //     keyboard: false,
                    //     show    : true
                    // });
                }
        });
});


$('#btnCheckStatusRequest').click(function(){
    // $(".modal-backdrop").css('display','none');
    $(".modal-backdrop").css('display','none');
    window.localStorage.setItem('request_status','Belum diapprove')
    window.localStorage.setItem('before_url','bidang-detail');
    window.localStorage.setItem('link_default','monitoring-payment');
    get_data_container_body('monitoring-payment')
});



















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
