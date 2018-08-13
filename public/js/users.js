$(document).ready(function() {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $('#dataTables-users').DataTable({
        "processing": true,
        "serverSide": true,
        "iDisplayLength": 10,
        "aLengthMenu": [[10, 15, 25, 35, 50, 100, -1], [10, 15, 25, 35, 50, 100, "All"]],
        "ajax":({
            url: "index",
            type: "GET",
            contentType: "application/json;charset=UTF-8",
            dataType: "json"
        }),
        "columns": [
            { data:'empno' },
            { data:'firstname' 
            
            },
            { data:'surname' },
            { data:'positionName' },
            { data:'deptName' },
            { data:'regionName' },
            {
                data: 'isDeactivated',
                render: function (data, type, full, meta) {
                    return data === '1' ? 'Deactivated' : 'Activated';
                }
            },
            {
                data: 'isDeactivated',
                render: function (data, type, full, meta) {
                    return data === "1" ? "<table><tr><td><a href='#' title='Edit' class='editIcon' data-id='"+data[0]+"'  data-tablename='employees' id='editIcon"+data[0]+"'><i class='fa fa-edit fa-fw' style='color:orange;'></i></a>&nbsp;&nbsp;</td><td><a href='#' title='Cancel Edit' class='cancelIcon' data-id='"+data[0]+"'  data-tablename='employees' id='cancelIcon"+data[0]+"' style='display:none;text-decoration:none;margin-right:10px;'><i class='fa fa-edit fa-fw' style='color:orange'></i><span style='color:red;margin-left:-22px;font-weight:bold'>X</span></a>&nbsp;&nbsp;</td><td><button type='button' class='btn btn-outline btn-success activateBtn' data-type='0' data-id='"+data[0]+"'><i class='fa fa-plus'> &nbsp;Activate</i></button></td></tr></table>" : "<table><tr><td><a href='#' title='Edit' class='editIcon' data-id='"+data[0]+"'  data-tablename='employees' id='editIcon"+data[0]+"'><i class='fa fa-edit fa-fw' style='color:orange;'></i></a>&nbsp;&nbsp;</td><td><a href='#' title='Cancel Edit' class='cancelIcon' data-id='"+data[0]+"'  data-tablename='employees' id='cancelIcon"+data[0]+"' style='display:none;text-decoration:none;margin-right:10px;'><i class='fa fa-edit fa-fw' style='color:orange'></i><span style='color:red;margin-left:-22px;font-weight:bold'>X</span></a>&nbsp;&nbsp;</td><td><button type='button' class='btn btn-outline btn-success activateBtn' data-type='0' data-id='"+data[0]+"'><i class='fa fa-plus'> &nbsp;Activate</i></button></td></tr></table>"
                }
            }
        ]	 
    });

    $('#dataTables-users').on("click", ".activateBtn", function(){
        var type=$(this).attr("data-type");
        var id=$(this).attr("data-id");
        alert(type+"-"+id)
        $.ajax({ 
            type: "POST", 
            url: "/users/activate", 
            data:{"type":type,"id":id},
            success: function(result) {
                window.location.reload();
                if(type==0){ alert("Successfully activated user.") }
                else{ alert("Successfully deactivated user.") }
            }
        });    
    });
 
});

