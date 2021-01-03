// var backend_url     = window.location.origin+"/lfm/dev/";

$(document).ready(function(){
    // loadData();
alert("etfeh")
});
function loadData()
{
    $('#role_tbl').DataTable({
        responsive: true,
        searchDelay: 500,
        processing: true,
        serverSide: false,
        'columnDefs'  :[
                            {
                                // "targets": [2], //first column / numbering column
                                // "orderable": false, //set not orderable
                            },
                        ],
        'ajax'      :{
                        'url' : backend_url+'Role-management/data-role',
                        'type': 'POST',
                        'data': {},
                    },
        'columns'   :[
                        { "data": "num" },
                        { "data": "role"},
                        { "data": "pengguna"},
                        { "data": "action"}
                    ],
    });
}