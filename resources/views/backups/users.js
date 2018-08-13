$(document).ready(function() {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var tableUsers=$('#dataTables-users').DataTable({
        responsive: true,
        "iDisplayLength": 10,
        "aLengthMenu": [[10, 15, 25, 35, 50, 100, -1], [10, 15, 25, 35, 50, 100, "All"]],
        "order": [[ 0, "asc" ]],
        "columnDefs": [ {
        "targets": [6,7],
        "searchable": false,
        "orderable":false
        } ]
    });

    $('#dataTables-users').on("click", ".activateBtn", function(){
        var type=$(this).attr("data-type");
        var id=$(this).attr("data-id");
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

    $('#dataTables-users').on("click", ".adminPassLink", function(){
        $("#userIdClicked").val($(this).attr("data-id"));
        
    });

    $('#checkAdminPassBtn').on( 'click', function () { 
        $("#pwordSpan_"+$("#userIdClicked").val()).show();$("#pwordInp_"+$("#userIdClicked").val()).hide();
    });
   
    $( ".fnameSpan" ).hover(function() {
        $("#overlay").show();
    });

    $( ".fnameSpan" ).mouseout(function() {
        $("#overlay").hide();
    })
    
    
});
