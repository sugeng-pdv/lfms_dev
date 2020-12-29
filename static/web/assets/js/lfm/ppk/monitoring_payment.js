$(document).ready(function(){
    loadDataSearch()
    $('#btnProcess').click();
});

$('#btnProcess').click(function(){
    $('#btnProcess').removeClass('btn-outline-success').addClass('btn-success');
    $('#btnApproved').removeClass('btn-success').addClass('btn-outline-success');
    $('#btnRejected').removeClass('btn-success').addClass('btn-outline-success');
    loadData('Sudah Kirim'); 
});
$('#btnApproved').click(function(){
    $('#btnApproved').removeClass('btn-outline-success').addClass('btn-success');
    $('#btnProcess').removeClass('btn-success').addClass('btn-outline-success');
    $('#btnRejected').removeClass('btn-success').addClass('btn-outline-success');
   loadData('Terbayar'); 
});
$('#btnRejected').click(function(){
    $('#btnRejected').removeClass('btn-outline-success').addClass('btn-success');
    $('#btnProcess').removeClass('btn-success').addClass('btn-outline-success');
    $('#btnApproved').removeClass('btn-success').addClass('btn-outline-success');
    loadData('Tertolak'); 
});
$('#btnMonitoringAlokasi').click(function(){
    
});



function loadDataSearch(query = '')
{
    $('#spp-detail-timeline .result-spp').remove();
    $.ajax({
            url     : backend_url+'Monitoring_payment/data-spp',
            type    : 'POST',
            data    : {'id_spp':window.localStorage.getItem('id'),'id_bidang':'','query':query},
            dataType: 'JSON',
            cache   : false,
            beforeSend: function(xhr)
            {
                xhr.setRequestHeader('Authorization', 'Bearer '+window.localStorage.getItem('lfm_token'));
            },
            success: function(resp)
            { 
                if(resp.status === 'success'){
                    var dataSpp = resp.data;
                    // $( "body" ).on( "click", "#btnSendRequestSpp", function() {
                    $.each(dataSpp, function( index, value ) {
                        $('#spp-detail').clone().attr('id','spp-'+value.id).addClass('result-spp').appendTo('#spp-detail-timeline');
                        $('#spp-'+value.id+' #spp_num').text(value.spp_no)
                        $('#spp-'+value.id+' #psn_name').text(value.psn_name);
                        $('#spp-'+value.id+' #payment_type').text(value.spp_type);
                        $('#spp-'+value.id+' #request_status').text(value.spp_status);
                            
                            $.each(value.timeline, function( index2, value2 ) {
                               
                                $('#spp-'+value.id+' #master-timeline-spp-detail').clone().attr('id','spp2-'+value2[index2].id).appendTo('#spp-'+value.id+' #timeline-spp');
                                $('#spp-'+value.id+' #spp2-'+value2[index2].id+' #title').text(value2[index2].desc);
                                $('#spp-'+value.id+' #spp2-'+value2[index2].id+' #title').removeClass('wizard-title').addClass('wizard-title '+value2[index2].timeline_class);
                                $('#spp-'+value.id+' #spp2-'+value2[index2].id+' #date').text(value2[index2].date);
                                $('#spp-'+value.id+' #spp2-'+value2[index2].id+' #date').removeClass('wizard-title').addClass('wizard-title '+value2[index2].timeline_class);
                                $('#spp-'+value.id+' #spp2-'+value2[index2].id+' #icon').removeClass('far fa-check-circle icon-3x mt-5 mb-5').addClass(value2[index2].wizard_icon)
                                if(index2 == 3){
                                    if(value2[index2].info_alert !== ""){
                                        $('#spp-'+value.id+' #info-step4').css('display','block')
                                    }
                                }
                                if(index2 == 5){
                                    if(value2[index2].info_alert !== ""){
                                        $('#spp-'+value.id+' #info-step6').css('display','block')
                                    }
                                }
                                
                                $('#spp-'+value.id+' #spp2-'+value2[index2].id).show();
                               
                                
                            });
                        $('#spp-'+value.id).show();
                        // return false;
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
$('#spp-search').keypress(function(e) {
    var key = e.which;
    if (key == 13) // the enter key code
    {
        loadDataSearch(this.value);
        return false;
    }
  });
function loadData(query='')
{
    $('#tableMonitoringSpp').DataTable().clear().draw();
    $.ajax({
            url     : backend_url+'Monitoring_payment/data-table-spp',
            type    : 'POST',
            data    : {'id_spp':window.localStorage.getItem('id'),'id_bidang':'','query':query},
            dataType: 'JSON',
            cache   : false,
            beforeSend: function(xhr)
            {
                xhr.setRequestHeader('Authorization', 'Bearer '+window.localStorage.getItem('lfm_token'));
            },
            success: function(resp)
            { 
                 
                if(resp.status === 'success'){
                    var dataColums = resp.dataHistory;
                    $('#tableMonitoringSpp').DataTable({
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
                                        { "data": "fieldtype_name"},
                                        { "data": "psn_name"},
                                        { "data": "fieldtype"},
                                        { "data": "area"},
                                        { "data": "nominal"},
                                        { "data": "name"},
                                        { "data": "date_process"},
                                        { "data": "date_decision"},
                                        { "data": "action"}
                                    ],
                    });
                    
	   // <th>Nama Bidang</th>
    //                     <th>Nama PSN</th>
    //                     <th>Jenis Bidang</th>
    //                     <th>Luas</th>
    //                     <th>Harga/Nilai Tambah</th>
    //                     <th>Nama Yang Berhak</th>
    //                     <th>Tanggal Di Proses</th>
    //                     <th>Tanggal Keputusan</th>
    //                     <th>Surat Keputusan</th>
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

function loadDataCof(query='')
{
    $('#tableMonitoringSpp').DataTable().clear().draw();
    $.ajax({
            url     : backend_url+'Monitoring_payment/data-table-cof',
            type    : 'POST',
            data    : {'id_spp':window.localStorage.getItem('id'),'id_bidang':'','query':query},
            dataType: 'JSON',
            cache   : false,
            beforeSend: function(xhr)
            {
                xhr.setRequestHeader('Authorization', 'Bearer '+window.localStorage.getItem('lfm_token'));
            },
            success: function(resp)
            { 
                 
                if(resp.status === 'success'){
                    var dataColums = resp.dataHistory;
                    $('#tableMonitoringSpp').DataTable({
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
                                        { "data": "fieldtype_name"},
                                        { "data": "psn_name"},
                                        { "data": "fieldtype"},
                                        { "data": "area"},
                                        { "data": "nominal"},
                                        { "data": "name"},
                                        { "data": "date_process"},
                                        { "data": "date_decision"},
                                        { "data": "action"}
                                    ],
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

$('#btnMonitoringAlokasi').click(function(){
    // $(".modal-backdrop").css('display','none');
    $(".modal-backdrop").css('display','none');
    // window.localStorage.setItem('request_status','Belum diapprove')
    // window.localStorage.setItem('before_url','bidang-detail');
    window.localStorage.setItem('link_default','monitoring-allocations');
    get_data_container_body('monitoring-allocations')
});
$('#btnUndo').on('click',function(){
    window.localStorage.setItem('link_default',window.localStorage.getItem('before_url'));
    window.localStorage.setItem('before_url','request-payment');
    get_data_container_body(window.localStorage.getItem('link_default'))
});