// var backend_url     = window.location.origin+"/lfm/dev/";
var id_spp = window.localStorage.getItem('lfm_token');
$('.spp-name-title').text(window.localStorage.getItem('spp_name'));
$('.spp-nominal-title').text(window.localStorage.getItem('spp_nominal'));
$('.spp-status-title').text(window.localStorage.getItem('spp_status'));
$(document).ready(function(){
    loadDataTable();
});
$('#type').select2({
    width:'100%',
    placeholder: 'Pilih Jenis Bidang'
});
$('#province').select2({
    width:'100%',
    placeholder: 'Pilih Provinsi'
});
$('#district').select2({
    width:'100%',
    placeholder: 'Pilih Kabupaten/Kota'
});
$('#sub_district').select2({
    width:'100%',
    placeholder: 'Pilih Kecamatan'
});
$('#village').select2({
    width:'100%',
    placeholder: 'Pilih Kelurahan'
});
// field_condition
$('#field_condition').select2({
    width:'100%',
    placeholder: 'Pilih Kondisi Bidang'
});
$('#compensation_type').select2({
    width:'100%',
    placeholder: 'Pilih Bentuk Ganti Rugi'
});



$('#price').mask('#.##0', {reverse: true});
$('#field_area').mask('#.##0', {reverse: true});

// $( "body" ).on( "click", "#btnUndo", function() {
$('#btnUndo').on('click',function(){
    // window.localStorage.setItem('link_default',window.localStorage.getItem('before_url'));
    window.localStorage.setItem('link_default','spp-detail');
    // window.localStorage.setItem('before_url',window.localStorage.getItem('link_default');
    window.localStorage.setItem('before_url','requet-payment');
    window.localStorage.removeItem('id');
    window.localStorage.removeItem('no_spp');
    window.localStorage.removeItem('spp_name');
    window.localStorage.removeItem('spp_status');
    window.localStorage.removeItem('spp_nominal');
    window.localStorage.removeItem('payment_change');
    window.localStorage.removeItem('payment_type_change');
    
    get_data_container_body(window.localStorage.getItem('link_default'));
});
// modalTutorialBidang
$('#btnInputField').click(function(){
// $( "body" ).on( "click", "#btnInputField", function(){
        $.ajax({
            url     : backend_url+'Bidang-detail/bidang-check',
            type    : 'POST',
            data    : {'id_spp': window.localStorage.getItem('id')},
            dataType: 'JSON',
            cache   : false,
            beforeSend: function(xhr)
            {
                xhr.setRequestHeader('Authorization', 'Bearer '+window.localStorage.getItem('lfm_token'));
            },
            success: function(data)
            {   
                if(data.status === true)
                { 
                    if(data.data === 'Ok'){
                        video_confirm();
                        return false;
                    }else{
                        var src = 'https://www.youtube.com/embed/6z_3up-XIPE';
                        // var src = 'https://www.youtube.com/embed/f0jt7wFru7c&amp;autoplay=1';
                        $('.videoTutorialBidang').removeAttr('id').attr('id','btnCloseVideo');
                        $('#modalTutorialBidang iframe').attr('src',src);
                        $("#modalTutorialBidang").modal({
                                            backdrop: 'static',
                                            keyboard: false,
                                            show    : true
                                        });
                        return false;
                    }
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
// $( "body" ).on( "click", "#btnGuidlineField", function() {
$('#btnGuidlineField').click(function(){
    var src = 'https://www.youtube.com/embed/6z_3up-XIPE';
    // var src = 'https://www.youtube.com/embed/f0jt7wFru7c';
    $('.videoTutorialBidang').removeAttr('id').attr('id','btnOnlyCloseVideo');
    $('#modalTutorialBidang iframe').attr('src',src);
    $("#modalTutorialBidang").modal({
                        backdrop: 'static',
                        keyboard: false,
                        show    : true
                    });
});
// $('#btnOnlyCloseVideo').click(function () {
$( "body" ).on( "click", "#btnOnlyCloseVideo", function() {
    $('#modalTutorialBidang iframe').removeAttr('src');
});
// btnCloseVideo
// $('#modalTutorialBidang button').click(function () {
// $('#btnCloseVideo').click(function () {
$( "body" ).on( "click", "#btnCloseVideo", function() {
        $('#modalTutorialBidang iframe').removeAttr('src');
        Swal.fire({
                title: 'Terimaksih telah menonton tutorial input bidang!',
                text: "Apakah anda ingin melanjutkan ke tahap input bidang ?",
                // icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#1BC5BD',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Tidak , Kembali!',
                confirmButtonText: 'Ya , Lanjutkan!',
                reverseButtons: true,
                showLoaderOnConfirm: true,
                width: '800px'
            }).then((result) => {
                if (result.value) {
                    $('.data-bidang').val('');
                    $('[name="is_eligible"]').removeClass('data-bidang').addClass('data-bidang');
                    $('[name="is_konsinyasi"]').removeClass('data-bidang').addClass('data-bidang');
                    $('.data-dokumen').text('UPLOAD DOKUMEN');
                    $('#id_spp').val(window.localStorage.getItem('id'));
                    var paymentType = window.localStorage.getItem('payment_change');
                    var paymentTypeChange = window.localStorage.getItem('payment_type_change');
                    if(paymentType === 'Langsung')
                    {
                        if(paymentTypeChange === 'Pengadilan'){
                            $('#form-general-payment').css('display','none');
                            $('#form-langsung-konsinyasi').css('display','block');
                            $('#form-konsinyasi').css('display','block');
                            $('#form-konsinyasi #form-konsinyasi-talangan').css('display','none');
                            $('#form-compensation').css('display','none');
                        }else{
                            $('#form-general-payment').css('display','block');
                            $('#form-langsung-konsinyasi').css('display','block');
                            $('#form-konsinyasi').css('display','none');
                            $('#form-konsinyasi-talangan').css('display','none');
                            $('#form-compensation').css('display','block');
                            
                        }
                        $('#form-talangan').css('display','none');
                        $('#talangan-eligible').css('display','none');
                        $('#talangan-eligible2').css('display','none');
                        $('#talangan-konsinyasi').css('display','none');
                        $('#input-konsinyasi').css('display','block');
                    }else{
                        $('#form-talangan').css('display','block');
                        $('#talangan-konsinyasi').css('display','block');
                        $('#talangan-eligible').css('display','block');
                        $('#talangan-eligible2').css('display','none');
                        $('#input-konsinyasi').css('display','none');
                        $('#form-compensation').css('display','none');
                        $('#form-konsinyasi').css('display','none');
                    }
                    $("#modalInputBidang").modal({
                        backdrop: 'static',
                        keyboard: false,
                        show    : true
                    });
                    get_jenis_bidang();
                    get_province();
                    $('#field_condition').val('').trigger('change');
                    $('#compensation_type').val('').trigger('change');
                    $('#spp_num').val(window.localStorage.getItem('no_spp'));
                    $('#div_district,#div_subdistrict,#div_village').css('display','none');
                    $('#div_province').css('display','block');
                }
        });
});

function video_confirm(){
        Swal.fire({
                title: 'Konfirmasi input bidang!',
                text: "Apakah anda ingin melanjutkan ke tahap input bidang ?",
                // icon: 'info',
                showCancelButton: true,
                confirmButtonColor: '#1BC5BD',
                cancelButtonColor: '#d33',
                cancelButtonText: 'Tidak , Kembali!',
                confirmButtonText: 'Ya , Lanjutkan!',
                reverseButtons: true,
                showLoaderOnConfirm: true,
                width: '800px'
            }).then((result) => {
                if (result.value) {
                    $('.data-bidang').val('');
                    $('[name="is_eligible"]').removeClass('data-bidang').addClass('data-bidang');
                    $('[name="is_konsinyasi"]').removeClass('data-bidang').addClass('data-bidang');
                    $('.data-dokumen').text('UPLOAD DOKUMEN');
                    $('#id_spp').val(window.localStorage.getItem('id'));
                    var paymentType = window.localStorage.getItem('payment_change');
                    var paymentTypeChange = window.localStorage.getItem('payment_type_change');
                    if(paymentType === 'Langsung')
                    {
                        if(paymentTypeChange === 'Pengadilan'){
                            $('#form-general-payment').css('display','none');
                            $('#form-langsung-konsinyasi').css('display','block');
                            $('#form-konsinyasi').css('display','block');
                            $('#form-konsinyasi #form-konsinyasi-talangan').css('display','none');
                            $('#form-compensation').css('display','none');
                        }else{
                            $('#form-general-payment').css('display','block');
                            $('#form-langsung-konsinyasi').css('display','block');
                            $('#form-konsinyasi').css('display','none');
                            $('#form-konsinyasi #form-konsinyasi-talangan').css('display','none');
                            $('#form-compensation').css('display','block');
                            
                            
                        }
                        $('#form-talangan').css('display','none');
                        $('#talangan-eligible').css('display','none');
                        $('#talangan-eligible2').css('display','none');
                        $('#talangan-konsinyasi').css('display','none');
                        $('#input-konsinyasi').css('display','block');
                    }else{
                        $('#form-talangan').css('display','block');
                        $('#talangan-konsinyasi').css('display','block');
                        $('#talangan-eligible').css('display','block');
                        $('#talangan-eligible2').css('display','none');
                        $('#input-konsinyasi').css('display','none');
                        $('#form-compensation').css('display','none');
                        $('#form-konsinyasi').css('display','none');
                        // $('#form-konsinyasi-talangan').css('display','none');
                        
                    }
                    $("#modalInputBidang").modal({
                        backdrop: 'static',
                        keyboard: false,
                        show    : true
                    });
                    get_jenis_bidang();
                    get_province();
                    $('#field_condition').val('').trigger('change');
                    $('#compensation_type').val('').trigger('change');
                    $('#spp_num').val(window.localStorage.getItem('no_spp'));
                    $('#div_district,#div_subdistrict,#div_village').css('display','none');
                    $('#div_province').css('display','block');
                }
        });
}

$('[name="is_eligible"]').on('click',function(){
   var value = this.value;
   if(value === '1'){
       $('#talangan-eligible2 .data-bidang').val('');
       $('#talangan-eligible2').css('display','block');
   }else{
       $('#talangan-eligible2').css('display','none');
   }
});
$('[name="is_konsinyasi"]').on('click',function(){
   var value = this.value;
   if(value === '1'){
       $('#input-konsinyasi').css('display','none');
       $('#form-konsinyasi').css('display','block');
   }else{
       $('#input-konsinyasi .data-bidang').val('');
       $('#input-konsinyasi').css('display','block');
       $('#form-konsinyasi').css('display','none');
       
   }
});
$('#btnCloseFormBidang').on('click',function(){
    $('#formInputBidang').trigger("reset");
    $('[name="is_eligible"]').removeClass('data-bidang');
    $('[name="is_konsinyasi"]').removeClass('data-bidang');
});
$('#xxbtnInputField2').on('click',function(){
     $("#modalInputBidang").modal({
                        backdrop: 'static',
                        keyboard: false,
                        show    : true
                    });
    get_jenis_bidang();
    get_kecamatan();
});

// $( "#location" ).autocomplete({
//         source: function( request, response ) {
//           // Fetch data
//           $.ajax({
//             url: backend_url+'Bidang_detail/lokasi-bidang',
//             type: 'post',
//             dataType: "json",
//             data: {
//               search: request.term
//             },
//             beforeSend: function(xhr)
//             {
//                 xhr.setRequestHeader('Authorization', 'Bearer '+window.localStorage.getItem('lfm_token'));
//             },
//             success: function( data ) {
//               response( data.data );
//             }
//           });
//         },
//         select: function (event, ui) {
//           // Set selection
//           $('#location').val(ui.item.name); // display the selected text
//           $('#locationid').val(ui.item.id); // save selected id to input
//           return false;
//         }
// });


$('#doc_nik').change(function () {
		var i = $(this).prev('label').clone();
// 		alert($('#doc_spp')[0].files.length)
        if($('#doc_nik')[0].files.length === 0){
            $(this).prev('label').text("UPLOAD DOKUMEN");
            $('#id_doc_nik').val("");
        }else{
		var file = $('#doc_nik')[0].files[0].name;
            $(this).prev('label').text(file);
            upload_nik();
        }
}); 
$('#doc_poo').change(function () {
		var i = $(this).prev('label').clone();
// 		alert($('#doc_spp')[0].files.length)
        if($('#doc_poo')[0].files.length === 0){
            $(this).prev('label').text("UPLOAD DOKUMEN");
            $('#id_doc_poo').val("");
        }else{
		var file = $('#doc_poo')[0].files[0].name;
            $(this).prev('label').text(file);
            upload_poo();
        }
}); 
$('#doc_result').change(function () {
		var i = $(this).prev('label').clone();
// 		alert($('#doc_spp')[0].files.length)
        if($('#doc_result')[0].files.length === 0){
            $(this).prev('label').text("UPLOAD DOKUMEN");
            $('#id_doc_result').val("");
        }else{
		var file = $('#doc_result')[0].files[0].name;
            $(this).prev('label').text(file);
            upload_result();
        }
}); 
$('#doc_letter').change(function () {
		var i = $(this).prev('label').clone();
// 		alert($('#doc_spp')[0].files.length)
        if($('#doc_letter')[0].files.length === 0){
            $(this).prev('label').text("UPLOAD DOKUMEN");
            $('#id_doc_letter').val("");
        }else{
		var file = $('#doc_letter')[0].files[0].name;
            $(this).prev('label').text(file);
            upload_letter();
        }
});
$('#doc_sptjm').change(function () {
		var i = $(this).prev('label').clone();
// 		alert($('#doc_spp')[0].files.length)
        if($('#doc_sptjm')[0].files.length === 0){
            $(this).prev('label').text("UPLOAD DOKUMEN");
            $('#id_doc_sptjm').val("");
        }else{
		var file = $('#doc_sptjm')[0].files[0].name;
            $(this).prev('label').text(file);
            upload_sptjm();
        }
});
$('#doc_receipt').change(function () {
		var i = $(this).prev('label').clone();
// 		alert($('#doc_spp')[0].files.length)
        if($('#doc_receipt')[0].files.length === 0){
            $(this).prev('label').text("UPLOAD DOKUMEN");
            $('#id_doc_receipt').val("");
        }else{
		var file = $('#doc_receipt')[0].files[0].name;
            $(this).prev('label').text(file);
            upload_receipt();
        }
});
$('#doc_baugr').change(function () {
		var i = $(this).prev('label').clone();
// 		alert($('#doc_spp')[0].files.length)
        if($('#doc_baugr')[0].files.length === 0){
            $(this).prev('label').text("UPLOAD DOKUMEN");
            $('#id_doc_baugr').val("");
        }else{
		var file = $('#doc_baugr')[0].files[0].name;
            $(this).prev('label').text(file);
            upload_baugr();
        }
});
$('#doc_baph').change(function () {
		var i = $(this).prev('label').clone();
// 		alert($('#doc_spp')[0].files.length)
        if($('#doc_baph')[0].files.length === 0){
            $(this).prev('label').text("UPLOAD DOKUMEN");
            $('#id_doc_baph').val("");
        }else{
		var file = $('#doc_baph')[0].files[0].name;
            $(this).prev('label').text(file);
            upload_baph();
        }
});
$('#doc_rek_bpn').change(function () {
		var i = $(this).prev('label').clone();
// 		alert($('#doc_spp')[0].files.length)
        if($('#doc_rek_bpn')[0].files.length === 0){
            $(this).prev('label').text("UPLOAD DOKUMEN");
            $('#id_doc_rek_bpn').val("");
        }else{
		var file = $('#doc_rek_bpn')[0].files[0].name;
            $(this).prev('label').text(file);
            upload_rek_bpn();
        }
});
$('#doc_court').change(function () {
		var i = $(this).prev('label').clone();
// 		alert($('#doc_spp')[0].files.length)
        if($('#doc_court')[0].files.length === 0){
            $(this).prev('label').text("UPLOAD DOKUMEN");
            $('#id_doc_court').val("");
        }else{
		var file = $('#doc_court')[0].files[0].name;
            $(this).prev('label').text(file);
            upload_court();
        }
});
$('#doc_ba_court').change(function () {
		var i = $(this).prev('label').clone();
// 		alert($('#doc_spp')[0].files.length)
        if($('#doc_ba_court')[0].files.length === 0){
            $(this).prev('label').text("UPLOAD DOKUMEN");
            $('#id_ba_court').val("");
        }else{
		var file = $('#doc_ba_court')[0].files[0].name;
            $(this).prev('label').text(file);
            upload_bacourt();
        }
});
$('#doc_add').change(function () {
		var i = $(this).prev('label').clone();
// 		alert($('#doc_spp')[0].files.length)
        if($('#doc_add')[0].files.length === 0){
            $(this).prev('label').text("UPLOAD DOKUMEN");
            $('#id_doc_add').val("");
        }else{
		var file = $('#doc_add')[0].files[0].name;
            $(this).prev('label').text(file);
            upload_docAdd();
        }
});
// get_district()
// get_subdistrict()
$('#province').change(function(){
    $('#div_province,#div_subdistrict,#div_svillage').css('display','none');
    $('#div_district').css('display','block');
    get_district(this.value);
});
$('#district').change(function(){
    $('#div_province,#div_district,#div_svillage').css('display','none');
    $('#div_subdistrict').css('display','block');
    get_subdistrict(this.value);
});
$('#sub_district').change(function(){
    $('#div_province,#div_district,#div_subdistrict').css('display','none');
    $('#div_village').css('display','block');
    get_village(this.value);
});

$('#btn_reset_location').click(function(){
    // $('#district').val('');
    // $('#sub_district').val('');
    $('#div_subdistrict,#div_district,#div_village').css('display','none');
    $('#div_province').css('display','block');
    get_province();
});
$('#btnSaveField').click(function(){
    save_bidang();
});
function loadDataTable()
{
    $.ajax({
            url     : backend_url+'Bidang_detail/data-bidang',
            type    : 'POST',
            data    : {'id_spp':window.localStorage.getItem('id'),'id_bidang':''},
            dataType: 'JSON',
            cache   : false,
            beforeSend: function(xhr)
            {
                xhr.setRequestHeader('Authorization', 'Bearer '+window.localStorage.getItem('lfm_token'));
            },
            success: function(resp)
            { 
                if(resp.status === 'success'){
                    var dataColums = resp.data;
                    if(resp.sendStatus == true)
                    {
                        $('.btn-request-spp').removeAttr('id').attr('id','btnSendRequestSpp').attr('disabled',false);
                        $('.btn-send-request-spp').removeAttr('id').attr('id','btnInputField').attr('disabled',false);
                         
                    }else{
                        $('.btn-request-spp').removeAttr('id').attr('disabled',true);
                        $('.btn-send-request-spp').removeAttr('id').attr('disabled',true);
                    }
                    $('#tableDetailBidang').DataTable({
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
                                        { "data": "num" },
                                        { "data": "no_spp"},
                                        { "data": "name"},
                                        { "data": "type_field"},
                                        { "data": "nik"},
                                        { "data": "no_nominatif"},
                                        { "data": "nib"},
                                        { "data": "location"},
                                        { "data": "proof_owner"},
                                        { "data": "area_rank"},
                                        { "data": "nominal_idr"},
                                        { "data": "action"}
                                    ],
                    });
                    
                }else{
                    $('.btn-request-spp').removeAttr('id').attr('id','btnSendRequestSpp').attr('disabled',true);
                    $('.btn-send-request-spp').removeAttr('id').attr('id','btnInputField').attr('disabled',false);
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
function get_jenis_bidang(id='')
{
    $.ajax({
        url     : backend_url+'Bidang_detail/jenis-bidang',
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
            if(data.status == 'success')
            { 
                var parent    = data.data;
                var htmlData = '<option style="color:#3a7311;" value="">&#9724; ** Pilih Jenis Bidang **</option>';
                parent.forEach ( function(value){
                    htmlData = htmlData + "<option value="+value.id+">"+value.name+"</option>";
                });
                $('#type').html(htmlData);
                $('#type').val(id);
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
function get_province(id='',id2='')
{
    $.ajax({
        url     : backend_url+'Bidang_detail/get-province',
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
                var htmlData = '<option style="color:#3a7311;" value="">&#9724; ** Pilih Provinsi **</option>';
                parent.forEach ( function(value){
                    htmlData = htmlData + "<option value="+value.id+">"+value.name+"</option>";
                });
                $('#province').html(htmlData);
                $('#province').val(id2);
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
function get_district(id='',id2='')
{
    $.ajax({
        url     : backend_url+'Bidang_detail/get-district',
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
                var htmlData = '<option style="color:#3a7311;" value="">&#9724; ** Pilih Kabupaten/Kota **</option>';
                parent.forEach ( function(value){
                    htmlData = htmlData + "<option value="+value.id+">"+value.name+"</option>";
                });
                $('#district').html(htmlData);
                $('#district').val(id2);
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
function get_subdistrict(id='',id2='')
{
    $.ajax({
        url     : backend_url+'Bidang_detail/get-subdistrict',
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
                var htmlData = '<option style="color:#3a7311;" value="">&#9724; ** Pilih Kelurahan **</option>';
                parent.forEach ( function(value){
                    htmlData = htmlData + "<option value="+value.id+">"+value.name+"</option>";
                });
                $('#sub_district').html(htmlData);
                $('#sub_district').val(id2);
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
function get_village(id='',id2='')
{
    $.ajax({
        url     : backend_url+'Bidang_detail/get-village',
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
                var htmlData = '<option style="color:#3a7311;" value="">&#9724; ** Pilih Kecamatan **</option>';
                parent.forEach ( function(value){
                    htmlData = htmlData + "<option value="+value.id+">"+value.name+"</option>";
                });
                $('#village').html(htmlData);
                $('#village').val(id2);
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
function upload_nik(){
    var file = $('#doc_nik')[0].files[0];
    var fileExt = $('#doc_nik')[0].files[0].type;
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
            $('#id_doc_nik').val("");
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
                            url: backend_url + 'File/upload_file_field',
                            type: 'POST',
                            beforeSend: function(xhr) {
                                xhr.setRequestHeader('Authorization', 'Bearer '+window.localStorage.getItem('lfm_token'));
                            },
                            dataType: 'json',
                            data: {
                                file_name: file.name,
                                id  :window.localStorage.getItem('id'),
                                folder: 'KTP' 
                            },
                            async: false,
                            success: function(retdata) {
                                if(retdata.status === 'success')
                                {
                                    var dataS3 = retdata.data;
                                    var bucket = retdata.bucket;
                                    let s3FormData = new FormData();
                                    s3FormData.append('file', file);
                                    Object.keys( dataS3 ).forEach( key => {
                                                s3FormData.append( `${key}`, `${dataS3[key]}` )
                                            });
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
                                            s3FormData.append('id',window.localStorage.getItem('id'));
                                            s3FormData.append('s3_bucket', bucket);
                                            s3FormData.append('s3_object', dataS3.key);
                                            $.ajax({
                                                url: backend_url + 'File/save-file-field',
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
                                                    if (data.status === true) {
                                                        $('#id_doc_nik').val(data.id);
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
                                }else{
                                    swal.fire('Gagal',retdata.message,'error')
                                }
                                
    
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
function upload_poo(){
    var file = $('#doc_poo')[0].files[0];
    var fileExt = $('#doc_poo')[0].files[0].type;
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
            $('#id_doc_poo').val("");
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
                            url: backend_url + 'File/upload_file_field',
                            type: 'POST',
                            beforeSend: function(xhr) {
                                xhr.setRequestHeader('Authorization', 'Bearer '+window.localStorage.getItem('lfm_token'));
                            },
                            dataType: 'json',
                            data: {
                                file_name: file.name,
                                id  :window.localStorage.getItem('id'),
                                folder: 'BUKTI-MILIK' 
                            },
                            async: false,
                            success: function(retdata) {
                                if(retdata.status === 'success')
                                {
                                    var dataS3 = retdata.data;
                                    var bucket = retdata.bucket;
                                    let s3FormData = new FormData();
                                    s3FormData.append('file', file);
                                    Object.keys( dataS3 ).forEach( key => {
                                                s3FormData.append( `${key}`, `${dataS3[key]}` )
                                            });
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
                                            s3FormData.append('id',window.localStorage.getItem('id'));
                                            s3FormData.append('s3_bucket', bucket);
                                            s3FormData.append('s3_object', dataS3.key);
                                            $.ajax({
                                                url: backend_url + 'File/save-file-field',
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
                                                    if (data.status === true) {
                                                        $('#id_doc_poo').val(data.id);
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
                                }else{
                                    swal.fire('Gagal',retdata.message,'error')
                                }
                                
    
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
function upload_result(){
    var file = $('#doc_result')[0].files[0];
    var fileExt = $('#doc_result')[0].files[0].type;
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
            $('#id_doc_result').val("");
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
                            url: backend_url + 'File/upload_file_field',
                            type: 'POST',
                            beforeSend: function(xhr) {
                                xhr.setRequestHeader('Authorization', 'Bearer '+window.localStorage.getItem('lfm_token'));
                            },
                            dataType: 'json',
                            data: {
                                file_name: file.name,
                                id  :window.localStorage.getItem('id'),
                                folder: 'LAPORAN-HASIL' 
                            },
                            async: false,
                            success: function(retdata) {
                                if(retdata.status === 'success')
                                {
                                    var dataS3 = retdata.data;
                                    var bucket = retdata.bucket;
                                    let s3FormData = new FormData();
                                    s3FormData.append('file', file);
                                    Object.keys( dataS3 ).forEach( key => {
                                                s3FormData.append( `${key}`, `${dataS3[key]}` )
                                            });
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
                                            s3FormData.append('id',window.localStorage.getItem('id'));
                                            s3FormData.append('s3_bucket', bucket);
                                            s3FormData.append('s3_object', dataS3.key);
                                            $.ajax({
                                                url: backend_url + 'File/save-file-field',
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
                                                    if (data.status === true) {
                                                        $('#id_doc_result').val(data.id);
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
                                }else{
                                    swal.fire('Gagal',retdata.message,'error')
                                }
    
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
function upload_letter(){
    var file = $('#doc_letter')[0].files[0];
    var fileExt = $('#doc_letter')[0].files[0].type;
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
            $('#id_doc_letter').val("");
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
                            url: backend_url + 'File/upload_file_field',
                            type: 'POST',
                            beforeSend: function(xhr) {
                                xhr.setRequestHeader('Authorization', 'Bearer '+window.localStorage.getItem('lfm_token'));
                            },
                            dataType: 'json',
                            data: {
                                file_name: file.name,
                                id  :window.localStorage.getItem('id'),
                                folder: 'VALIDASI-BPN' 
                            },
                            async: false,
                            success: function(retdata) {
                                if(retdata.status === 'success')
                                {
                                    var dataS3 = retdata.data;
                                    var bucket = retdata.bucket;
                                    let s3FormData = new FormData();
                                    s3FormData.append('file', file);
                                    Object.keys( dataS3 ).forEach( key => {
                                                s3FormData.append( `${key}`, `${dataS3[key]}` )
                                            });
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
                                            s3FormData.append('id',window.localStorage.getItem('id'));
                                            s3FormData.append('s3_bucket', bucket);
                                            s3FormData.append('s3_object', dataS3.key);
                                            $.ajax({
                                                url: backend_url + 'File/save-file-field',
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
                                                    if (data.status === true) {
                                                        $('#id_doc_letter').val(data.id);
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
                                }else{
                                    swal.fire('Gagal',retdata.message,'error')
                                }
    
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
function upload_sptjm(){
    var file = $('#doc_sptjm')[0].files[0];
    var fileExt = $('#doc_sptjm')[0].files[0].type;
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
            $('#id_doc_sptjm').val("");
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
                            url: backend_url + 'File/upload_file_field',
                            type: 'POST',
                            beforeSend: function(xhr) {
                                xhr.setRequestHeader('Authorization', 'Bearer '+window.localStorage.getItem('lfm_token'));
                            },
                            dataType: 'json',
                            data: {
                                file_name: file.name,
                                id  :window.localStorage.getItem('id'),
                                folder: 'SPTJM' 
                            },
                            async: false,
                            success: function(retdata) {
                                if(retdata.status === 'success')
                                {
                                    var dataS3 = retdata.data;
                                    var bucket = retdata.bucket;
                                    let s3FormData = new FormData();
                                    s3FormData.append('file', file);
                                    Object.keys( dataS3 ).forEach( key => {
                                                s3FormData.append( `${key}`, `${dataS3[key]}` )
                                            });
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
                                            s3FormData.append('id',window.localStorage.getItem('id'));
                                            s3FormData.append('s3_bucket', bucket);
                                            s3FormData.append('s3_object', dataS3.key);
                                            $.ajax({
                                                url: backend_url + 'File/save-file-field',
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
                                                    if (data.status === true) {
                                                        $('#id_doc_sptjm').val(data.id);
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
                                }else{
                                    swal.fire('Gagal',retdata.message,'error')
                                }
    
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
function upload_receipt(){
    var file = $('#doc_receipt')[0].files[0];
    var fileExt = $('#doc_receipt')[0].files[0].type;
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
            $('#id_doc_receipt').val("");
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
                            url: backend_url + 'File/upload_file_field',
                            type: 'POST',
                            beforeSend: function(xhr) {
                                xhr.setRequestHeader('Authorization', 'Bearer '+window.localStorage.getItem('lfm_token'));
                            },
                            dataType: 'json',
                            data: {
                                file_name: file.name,
                                id  :window.localStorage.getItem('id'),
                                folder: 'KUITANSI' 
                            },
                            async: false,
                            success: function(retdata) {
                                if(retdata.status === 'success')
                                {
                                    var dataS3 = retdata.data;
                                    var bucket = retdata.bucket;
                                    let s3FormData = new FormData();
                                    s3FormData.append('file', file);
                                    Object.keys( dataS3 ).forEach( key => {
                                                s3FormData.append( `${key}`, `${dataS3[key]}` )
                                            });
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
                                            s3FormData.append('id',window.localStorage.getItem('id'));
                                            s3FormData.append('s3_bucket', bucket);
                                            s3FormData.append('s3_object', dataS3.key);
                                            $.ajax({
                                                url: backend_url + 'File/save-file-field',
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
                                                    if (data.status === true) {
                                                        $('#id_doc_receipt').val(data.id);
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
                                }else{
                                    swal.fire('Gagal',retdata.message,'error')
                                }
    
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
function upload_baugr(){
    var file = $('#doc_baugr')[0].files[0];
    var fileExt = $('#doc_baugr')[0].files[0].type;
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
            $('#id_doc_baugr').val("");
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
                            url: backend_url + 'File/upload_file_field',
                            type: 'POST',
                            beforeSend: function(xhr) {
                                xhr.setRequestHeader('Authorization', 'Bearer '+window.localStorage.getItem('lfm_token'));
                            },
                            dataType: 'json',
                            data: {
                                file_name: file.name,
                                id  :window.localStorage.getItem('id'),
                                folder: 'BAUGR' 
                            },
                            async: false,
                            success: function(retdata) {
                                if(retdata.status === 'success')
                                {
                                    var dataS3 = retdata.data;
                                    var bucket = retdata.bucket;
                                    let s3FormData = new FormData();
                                    s3FormData.append('file', file);
                                    Object.keys( dataS3 ).forEach( key => {
                                                s3FormData.append( `${key}`, `${dataS3[key]}` )
                                            });
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
                                            s3FormData.append('id',window.localStorage.getItem('id'));
                                            s3FormData.append('s3_bucket', bucket);
                                            s3FormData.append('s3_object', dataS3.key);
                                            $.ajax({
                                                url: backend_url + 'File/save-file-field',
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
                                                    if (data.status === true) {
                                                        $('#id_doc_baugr').val(data.id);
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
                                }else{
                                    swal.fire('Gagal',retdata.message,'error')
                                }
    
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
function upload_baph(){
    var file = $('#doc_baph')[0].files[0];
    var fileExt = $('#doc_baph')[0].files[0].type;
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
            $('#id_doc_baph').val("");
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
                            url: backend_url + 'File/upload_file_field',
                            type: 'POST',
                            beforeSend: function(xhr) {
                                xhr.setRequestHeader('Authorization', 'Bearer '+window.localStorage.getItem('lfm_token'));
                            },
                            dataType: 'json',
                            data: {
                                file_name: file.name,
                                id  :window.localStorage.getItem('id'),
                                folder: 'BAPH' 
                            },
                            async: false,
                            success: function(retdata) {
                                if(retdata.status === 'success')
                                {
                                    var dataS3 = retdata.data;
                                    var bucket = retdata.bucket;
                                    let s3FormData = new FormData();
                                    s3FormData.append('file', file);
                                    Object.keys( dataS3 ).forEach( key => {
                                                s3FormData.append( `${key}`, `${dataS3[key]}` )
                                            });
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
                                            s3FormData.append('id',window.localStorage.getItem('id'));
                                            s3FormData.append('s3_bucket', bucket);
                                            s3FormData.append('s3_object', dataS3.key);
                                            $.ajax({
                                                url: backend_url + 'File/save-file-field',
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
                                                    if (data.status === true) {
                                                        $('#id_doc_baph').val(data.id);
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
                                }else{
                                    swal.fire('Gagal',retdata.message,'error')
                                }
    
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
// tambahan upload 
function upload_rek_bpn(){
    var file = $('#doc_rek_bpn')[0].files[0];
    var fileExt = $('#doc_rek_bpn')[0].files[0].type;
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
            $('#id_doc_rek_bpn').val("");
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
                            url: backend_url + 'File/upload_file_field',
                            type: 'POST',
                            beforeSend: function(xhr) {
                                xhr.setRequestHeader('Authorization', 'Bearer '+window.localStorage.getItem('lfm_token'));
                            },
                            dataType: 'json',
                            data: {
                                file_name: file.name,
                                id  :window.localStorage.getItem('id'),
                                folder: 'BPN' 
                            },
                            async: false,
                            success: function(retdata) {
                                if(retdata.status === 'success')
                                {
                                    var dataS3 = retdata.data;
                                    var bucket = retdata.bucket;
                                    let s3FormData = new FormData();
                                    s3FormData.append('file', file);
                                    Object.keys( dataS3 ).forEach( key => {
                                                s3FormData.append( `${key}`, `${dataS3[key]}` )
                                            });
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
                                            s3FormData.append('id',window.localStorage.getItem('id'));
                                            s3FormData.append('s3_bucket', bucket);
                                            s3FormData.append('s3_object', dataS3.key);
                                            $.ajax({
                                                url: backend_url + 'File/save-file-field',
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
                                                    if (data.status === true) {
                                                        $('#id_doc_rek_bpn').val(data.id);
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
                                }else{
                                    swal.fire('Gagal',retdata.message,'error')
                                }
    
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
function upload_court(){
    var file = $('#doc_court')[0].files[0];
    var fileExt = $('#doc_court')[0].files[0].type;
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
            $('#id_doc_court').val("");
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
                            url: backend_url + 'File/upload_file_field',
                            type: 'POST',
                            beforeSend: function(xhr) {
                                xhr.setRequestHeader('Authorization', 'Bearer '+window.localStorage.getItem('lfm_token'));
                            },
                            dataType: 'json',
                            data: {
                                file_name: file.name,
                                id  :window.localStorage.getItem('id'),
                                folder: 'PENETAPAN-PENGADILAN' 
                            },
                            async: false,
                            success: function(retdata) {
                                if(retdata.status === 'success')
                                {
                                    var dataS3 = retdata.data;
                                    var bucket = retdata.bucket;
                                    let s3FormData = new FormData();
                                    s3FormData.append('file', file);
                                    Object.keys( dataS3 ).forEach( key => {
                                                s3FormData.append( `${key}`, `${dataS3[key]}` )
                                            });
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
                                            s3FormData.append('id',window.localStorage.getItem('id'));
                                            s3FormData.append('s3_bucket', bucket);
                                            s3FormData.append('s3_object', dataS3.key);
                                            $.ajax({
                                                url: backend_url + 'File/save-file-field',
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
                                                    if (data.status === true) {
                                                        $('#id_doc_court').val(data.id);
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
                                }else{
                                    swal.fire('Gagal',retdata.message,'error')
                                }
    
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
function upload_bacourt(){
    var file = $('#doc_ba_court')[0].files[0];
    var fileExt = $('#doc_ba_court')[0].files[0].type;
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
            $('#id_ba_court').val("");
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
                            url: backend_url + 'File/upload_file_field',
                            type: 'POST',
                            beforeSend: function(xhr) {
                                xhr.setRequestHeader('Authorization', 'Bearer '+window.localStorage.getItem('lfm_token'));
                            },
                            dataType: 'json',
                            data: {
                                file_name: file.name,
                                id  :window.localStorage.getItem('id'),
                                folder: 'BAPP' 
                            },
                            async: false,
                            success: function(retdata) {
                                if(retdata.status === 'success')
                                {
                                    var dataS3 = retdata.data;
                                    var bucket = retdata.bucket;
                                    let s3FormData = new FormData();
                                    s3FormData.append('file', file);
                                    Object.keys( dataS3 ).forEach( key => {
                                                s3FormData.append( `${key}`, `${dataS3[key]}` )
                                            });
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
                                            s3FormData.append('id',window.localStorage.getItem('id'));
                                            s3FormData.append('s3_bucket', bucket);
                                            s3FormData.append('s3_object', dataS3.key);
                                            $.ajax({
                                                url: backend_url + 'File/save-file-field',
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
                                                    if (data.status === true) {
                                                        $('#id_ba_court').val(data.id);
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
                                }else{
                                    swal.fire('Gagal',retdata.message,'error')
                                }
    
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
function upload_docAdd(){
    var file = $('#doc_add')[0].files[0];
    var fileExt = $('#doc_add')[0].files[0].type;
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
            $('#id_doc_add').val("");
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
                            url: backend_url + 'File/upload_file_field',
                            type: 'POST',
                            beforeSend: function(xhr) {
                                xhr.setRequestHeader('Authorization', 'Bearer '+window.localStorage.getItem('lfm_token'));
                            },
                            dataType: 'json',
                            data: {
                                file_name: file.name,
                                id  :window.localStorage.getItem('id'),
                                folder: 'ADD' 
                            },
                            async: false,
                            success: function(retdata) {
                                if(retdata.status === 'success')
                                {
                                    var dataS3 = retdata.data;
                                    var bucket = retdata.bucket;
                                    let s3FormData = new FormData();
                                    s3FormData.append('file', file);
                                    Object.keys( dataS3 ).forEach( key => {
                                                s3FormData.append( `${key}`, `${dataS3[key]}` )
                                            });
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
                                            s3FormData.append('id',window.localStorage.getItem('id'));
                                            s3FormData.append('s3_bucket', bucket);
                                            s3FormData.append('s3_object', dataS3.key);
                                            $.ajax({
                                                url: backend_url + 'File/save-file-field',
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
                                                    if (data.status === true) {
                                                        $('#id_doc_add').val(data.id);
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
                                }else{
                                    swal.fire('Gagal',retdata.message,'error')
                                }
    
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
                    $('#formInputBidang').trigger("reset");
                    $('[name="is_eligible"]').removeClass('data-bidang');
                    $('[name="is_konsinyasi"]').removeClass('data-bidang');
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
                    
                    $('[name="is_eligible"]').removeClass('data-bidang').addClass('data-bidang');
                    $('[name="is_konsinyasi"]').removeClass('data-bidang').addClass('data-bidang');
                    var paymentType = data.payment_type;
                    var paymentTypeChange = data.payment_to;
                    if(paymentType === 'Langsung')
                    {
                        if(paymentTypeChange === 'Pengadilan'){
                            $('#form-general-payment').css('display','none');
                            $('#form-langsung-konsinyasi').css('display','block');
                            $('#form-konsinyasi').css('display','block');
                            $('#form-konsinyasi #form-konsinyasi-talangan').css('display','none');
                            $('#form-compensation').css('display','none');
                        }else{
                            $('#form-general-payment').css('display','block');
                            $('#form-langsung-konsinyasi').css('display','block');
                            $('#form-konsinyasi').css('display','none');
                            $('#form-konsinyasi-talangan').css('display','none');
                            $('#form-compensation').css('display','block');
                            
                        }
                        $('#form-talangan').css('display','none');
                        $('#talangan-eligible').css('display','none');
                        $('#talangan-eligible2').css('display','none');
                        $('#talangan-konsinyasi').css('display','none');
                        $('#input-konsinyasi').css('display','block');
                    }else{
                        $('#form-talangan').css('display','block');
                        $('#talangan-konsinyasi').css('display','block');
                        $('#talangan-eligible').css('display','block');
                        $('#talangan-eligible2').css('display','none');
                        $('#input-konsinyasi').css('display','none');
                        $('#form-compensation').css('display','none');
                    }
                    $('#id_spp').val(data.spp_id);
                    $('#id_bidang').val(data.id);
                    $('#spp_num').val(data.no_spp);
                    $('#name').val(data.name);
                    
                    if(data.is_eligible === '1'){
                        $("input[name=is_eligible][value='1']").prop("checked",true);
                        $('#talangan-eligible2').css('display','block');
                    }else{
                        $("input[name=is_eligible][value='0']").prop("checked",true);
                        $('#talangan-eligible2').css('display','none');
                    }
                    
                    $('#lhv_num').val(data.id_lhv);
                    $('#lhv_date').val(data.date_lhv);
                    
                    if(data.is_konsinyasi === 0){
                        $("input[name=is_konsinyasi][value='0']").prop("checked",true);
                        $('#input-konsinyasi').css('display','block');
                    }else{
                        $("input[name=is_konsinyasi][value='1']").prop("checked",true);
                         $('#input-konsinyasi').css('display','none');
                    }
                    $('#val_num').val(data.val_num);
                    $('#val_date').val(data.val_date);
                    $('#field_condition').val(data.field_condition).trigger('change');
                    $('#compensation_type').val(data.compensation_type).trigger('change');
                    
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
                    // $('#id_doc_sptjm').val(data.sptjm_doc_id);
                    $('#id_doc_letter').val(data.letter_doc_id);
                    $('#id_doc_receipt').val(data.receipt_doc_id);
                    $('#id_doc_baugr').val(data.baugr_doc_id);
                    $('#id_doc_baph').val(data.baph_doc_id);
                    $('#id_doc_rek_bpn').val(data.doc_rek_bpn_id);
                    $('#id_doc_court').val(data.doc_court_id);
                    $('#id_ba_court').val(data.doc_ba_court_id);
                    $('#id_doc_add').val(data.doc_add_id);
                    
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


$('#btnBackToHome').click(function(){
    $(".modal-backdrop").css('display','none');
    window.localStorage.setItem('link_default','home');
    window.localStorage.removeItem('id');
    window.localStorage.removeItem('no_spp');
    window.localStorage.removeItem('spp_name');
    window.localStorage.removeItem('spp_status');
    window.localStorage.removeItem('spp_nominal');
    get_data_container_body(window.localStorage.getItem('link_default'))
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
