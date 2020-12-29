var backend_url     = window.location.origin+"/lfm/dev/";
// $(document).ready(function() {
//     // get_data_container_body(dataUrl);
// });
// alert("etfeh")
function update()
{
    var form_modal = false;
    $('.form-change-pasword').find('select,input').each(function(i,box){
        // alert($(box).val());
        if($(box).val() === ''){
            form_modal = true
        }
        // alert($(box).attr('id').val());
    });
    // var form_data = new FormData(this);
    // form_data.append("status",$('#status').val());
    // form_data.append("id",$('#id').val());
    // form_data.append("name",$('#name').val());
    // form_data.append("description",$('#description').val());
    if(form_modal === true)
    {
        setTimeout(function() {
                    swal.fire('Gagal',"Pastikan data sudah terisi semua...!",'error');
                }, 1000);
    }else if($('#new_password').val() != $('#new_password2').val())
    {
         setTimeout(function() {
                    swal.fire('Gagal',"password tidak sama",'error');
                }, 1000);
                
    }else{
        var old_password    = $('#old_password').val();
        var new_password    = $('#new_password').val();
        var new_password2    = $('#new_password2').val();
        var user     = $('#user').val();
        $.ajax({
            url     : backend_url+'Auth/update-password',
            type    : 'POST',
            data    : {'old_password':old_password,'new_password':new_password,'new_password2':new_password2},
            dataType: 'JSON',
            cache   : false,
            beforeSend: function(xhr)
            {
                xhr.setRequestHeader('Authorization', 'Bearer '+window.localStorage.getItem('lfm_token'));
            },
            success: function(data)
            {   
                if(data.status == 'success')
                { 
    			    swal.fire("Berhasil!", "Update Password berhasil..", "success");
    			 //   if ( window.localStorage.getItem('lman_nextUrlAfterLogin') ){
        //       			setTimeout(function () { window.location = window.baseUrl+window.localStorage.getItem('lman_nextUrlAfterLogin') }, 1000);
    			 //   }else{
               			setTimeout(function () { window.location = window.backend_url }, 2000);
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
function login()
{
    var form_modal = false;
    $('.form-change-pasword').find('select,input').each(function(i,box){
        // alert($(box).val());
        if($(box).val() === ''){
            form_modal = true
        }
        // alert($(box).attr('id').val());
    });
    // var form_data = new FormData(this);
    // form_data.append("status",$('#status').val());
    // form_data.append("id",$('#id').val());
    // form_data.append("name",$('#name').val());
    // form_data.append("description",$('#description').val());
    if(form_modal == true)
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


