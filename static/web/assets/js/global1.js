var backend_url     = window.location.origin+"/lfm/dev/";
if(window.localStorage.getItem('link_default') === null){
    var dataUrl = 'Auth';
}else{
    var dataUrl = window.localStorage.getItem('link_default');
    
}
$(document).ready(function() {
    get_menu();
    get_data_container_body(dataUrl);
});
//di off sementara
// var time_session = setInterval(function(){check_session();},10000);
function check_session()
{
    $.ajax({
        url     : backend_url+'Auth/loop/'+Date.now(),
        type    : 'POST',
        // data    : {'id':''},
        dataType: 'JSON',
        cache   : false,
        beforeSend: function(xhr)
        {
            xhr.setRequestHeader('Authorization', 'Bearer '+window.localStorage.getItem('lfm_token'));
        },
        success: function(resp)
        {   
            var data = resp;
            if(data.status === true)
            { 
                
                return false;
            }
            else
            {
                $("#auth-popup").modal({
                    backdrop: 'static',
                    keyboard: false,
                    show    : true
                });
                clearInterval(time_session);
            }

        },
        error: function (jqXHR, textStatus, errorThrown)
        {
            clearInterval(time_session);
            $("#auth-popup").modal({
                backdrop: 'static',
                keyboard: false,
                show    : true
            });
        }
    });
}
function get_menu()
{
    $.ajax({
        url     : backend_url+'Menu-management/menu-nav',
        type    : 'POST',
        // data    : {'id':''},
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
                var menu    = data.menu;
                $(".menu-nav").append(menu);
                if(data.login){
                    $('#topbarUser').css('display','block') //enabled
                    // $('#employee_company').text("&nbsp;"+data.detail[0].company);
                    $('#employee_company').replaceWith('<span class="text-white font-weight-bolder font-size-sm d-none d-md-inline" id="employee_company">&nbsp;&nbsp;'+data.detail[0].name+'</span>'); //company
                    $('#emplooye_name').text(data.detail[0].name);
                    $('#employee_role').text(data.detail[0].role);
                    $('#employee_email').text(data.detail[0].email);
                }else{
                    window.localStorage.removeItem('link_default');
                    clearInterval(time_session);
                    $('#topbarUser').css('display','none') //enabled
                }
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
$( "body" ).on( "click", ".menu-nav .menu-li", function() {
    $(".menu-li").removeClass("menu-item-active");
    $(this).addClass("menu-item-active");
    dataUrl = $(this).find('a').attr('data-url');
    if(dataUrl === ''){
       return true; 
    }else{
        get_data_container_body(dataUrl)
        window.localStorage.setItem('link_default',dataUrl);
    }
});



function get_data_container_body(menu)
{
    $.ajax({
        url: backend_url+menu,
        async: true,
        type: "POST",
        data: "",
        dataType: "json",
        beforeSend: function(xhr)
        {
            xhr.setRequestHeader('Authorization', 'Bearer '+window.localStorage.getItem('lfm_token'));
            $('#ajax-content-container').html("");
        },
        success: function(data) {
            $('#title-lfm').html(data.title)
            $('#ajax-content-container').html(data.content);
            $('.info-text').text(data.menu_text);
          // return false;
        }
    });
}

function login(){
    var form_modal = false;
    $('.form-modal-login-popup').find('select,input').each(function(i,box){
        // alert($(box).val());
        if($(box).val() === ''){
            form_modal = true
        }
        // alert($(box).attr('id').val());
    });
    if(form_modal === true)
    {
        setTimeout(function() {
                    swal.fire('Gagal',"Pastikan data sudah terisi semua...!",'error');
                }, 1000);
    }else{
        var user     = $('#useridAuth').val();
        var password = $('#passwordAuth').val();
        $.ajax({
            url     : backend_url+'Auth/login',
            type    : 'POST',
            data    : {'user':user,'password':password},
            dataType: 'JSON',
            cache   : false,
            beforeSend: function()
            {
                
            },
            success: function(data)
            {   
                if(data.status == 'success')
                { 
                    window.localStorage.setItem('lfm_token',data.token);
               		setTimeout(function () { window.location = window.backend_url }, 1000);
                    
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
function change_password(){
    dataUrl = $('.change-password').attr('data-url');
    $('#kt_quick_user_close')[0].click();
    get_data_container_body(dataUrl);
    window.localStorage.setItem('link_default',dataUrl);
}
function refresh(){
    window.localStorage.removeItem('lfm_token');
	window.localStorage.removeItem('link_default');
    window.location.replace(window.backend_url);
}

function logout(){
	window.localStorage.removeItem('lfm_token');
	window.localStorage.removeItem('link_default');
// 	window.localStorage.removeItem('lman_nextUrlAfterLogin');
    window.location.replace(window.backend_url);
}
function GetTodayDate() {
   var tdate = new Date();
   var dd = tdate.getDate(); //yields day
   var MM = tdate.getMonth(); //yields month
   var yyyy = tdate.getFullYear(); //yields year
   var currentDate = dd + "/" +(MM+1) + "/" + yyyy;

   return currentDate;
}

