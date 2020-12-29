var backend_url     = window.location.origin+"/lfm/dev/";
var dataUrl = 'Home';
$(document).ready(function() {
    // get_data_container_body(dataUrl);
});
// alert("etfeh")

$('#password').keypress(function (e) {
 var key = e.which;
 if(key == 13)  // the enter key code
  {
    login();
    return false;  
  }
}); 
function login()
{
    var form_modal = false;
    $('.form-modal-login').find('select,input').each(function(i,box){
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
        var user     = $('#user').val();
        var password = $('#password').val();
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
                    window.localStorage.setItem('link_default','home');
    			    swal.fire("Berhasil!", "Login berhasil..", "success");
    			 //   if ( window.localStorage.getItem('lman_nextUrlAfterLogin') ){
        //       			setTimeout(function () { window.location = window.baseUrl+window.localStorage.getItem('lman_nextUrlAfterLogin') }, 1000);
    			 //   }else{
               			setTimeout(function () { window.location = window.backend_url }, 1000);
    			 //   }
                    
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


