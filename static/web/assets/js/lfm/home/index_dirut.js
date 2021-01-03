// var backend_url     = window.location.origin+"/lfm/dev/";
$(document).ready(function(){
    // loadDataTable();
});

$('.owl-carousel').owlCarousel({
			loop: false,
			margin: 10,
			responsiveClass: true,
			autoplay: true,
			responsive: {
			  0: {
				items: 1,
				nav: true
			  },
			  600: {
				items: 3,
				nav: false
			  },
			  1000: {
				items: 4,
				nav: true,
				margin: 20
			  }
			}
		});




















function loadDataTable()
{
    $.ajax({
            url     : backend_url+'Authority-management/data-authority',
            type    : 'POST',
            data    : {'id':''},
            dataType: 'JSON',
            cache   : false,
            beforeSend: function()
            {

            },
            success: function(resp)
            { 
                var dataColums = resp.data;
                $('#authority_tbl').DataTable({
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
                                    { "data": "no" },
                                    { "data": "role"},
                                    { "data": "menu"},
                                    { "data": "authority"},
                                    { "data": "action"}
                                ],
                });
            },
            error: function (jqXHR, textStatus, errorThrown)
            {
                setTimeout(function() {
                    swal.fire('Gagal',"Error Server ?",'error');
                }, 1000);
            }
    });
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
                if(data.status == 'success')
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
