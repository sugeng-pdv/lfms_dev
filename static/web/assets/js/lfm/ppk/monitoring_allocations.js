$(document).ready(function(){
    loadDataSearch()
});


$('#btnMonitoringAlokasi').click(function(){
    
});



function loadDataSearch(query = '')
{
    $('#spp-detail-timeline .result-spp').remove();
    $.ajax({
            url     : backend_url+'Monitoring_payment/data-allocations',
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
                    // swal.fire('Gagal',resp.message,'info');
                     swal.fire('Gagal','Konfliik Query','info');
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
$('#allocation-search').keypress(function(e) {
    var key = e.which;
    if (key == 13) // the enter key code
    {
        loadDataSearch(this.value);
        return false;
    }
  });


$('#btnMonitoringSpp').click(function(){
    // $(".modal-backdrop").css('display','none');
    $(".modal-backdrop").css('display','none');
    // window.localStorage.setItem('request_status','Belum diapprove')
    // window.localStorage.setItem('before_url','bidang-detail');
    window.localStorage.setItem('link_default','monitoring-payment');
    get_data_container_body('monitoring-payment')
});
$('#btnUndo').on('click',function(){
    window.localStorage.setItem('link_default',window.localStorage.getItem('before_url'));
    window.localStorage.setItem('before_url','request-payment');
    get_data_container_body(window.localStorage.getItem('link_default'))
});