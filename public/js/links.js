$(document).ready(function() {
    $.ajaxSetup({
        headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var ctrAddRow=0,idcol="";
    var table=$('#dataTables-example').DataTable({
        responsive: true,
        "order": [[ 3, "asc" ]],
        "columnDefs": [ {
        "targets": 4,
        "searchable": false,
        "orderable":false
        } ]
    });
    $('#fnClickAddRow').on( 'click', function () { 
        $("#panelbottomMsg").hide();             
        $("#saveAllBtn").show();
        $("table").addClass('table table-bordered table-hover');
        $('#dataTables-example').dataTable().fnAddData( [
            "<input type='text' class='form-control' name='link[]' style='width:100%;padding:0px'/>",
            "<input type='text' class='form-control' name='linkTitle[]'  style='width:100%'/>",
            "<input type='text' class='form-control' name='linkDescription[]' style='width:100%'/>",
            "",
            "<a href='#'  title='Delete' class='deleteRow' data-id='addedRow"+ctrAddRow+"'><i class='fa fa-trash-o fa-fw' style='color:red'></i></a>",
        ] );
        ctrAddRow++;
    });

    $('#dataTables-example').on("click", ".deleteRow", function(){
        console.log($(this).parent());
        table.row($(this).parents('tr')).remove().draw(false);
        ctrAddRow--;
        if(ctrAddRow==0 && idcol==""){ $("#saveAllBtn").hide();}
        $("#panelbottomMsg").hide();
    });

    $('#dataTables-example').on("click", ".deleteRowData", function(){
        if(confirm("Are you sure you want to delete?")){
            var id=$(this).attr("data-id");
            $.ajax({ 
                type: "DELETE", 
                url: "/links/"+id, 
                success: function(result) {
                    window.location.reload();
                }
            });
        }
    });
    $('#saveAllBtn').click(function(){
        $("#panelbottomMsg").hide();
            var linkCol="",titleCol="",detailCol="";
            var idcolArr=idcol.split("^"); 
            var empno=$("#empnohidden").val();
            var linkTitleArr = $("input[name='linkTitle[]']").map(function(){return $(this).val();}).get();
            var linkDescriptionArr = $("input[name='linkDescription[]']").map(function(){return $(this).val();}).get();
            var linkArr = $("input[name='link[]']").map(function(){return $(this).val();}).get();
            if(idcol!=""){
                for ( var x = 1; x < idcolArr.length; x++) {
                    linkCol=linkCol+"^^@"+$("#linkInp_"+idcolArr[x]).val();
                    titleCol=titleCol+"^^@"+$("#vLinkTitleInp_"+idcolArr[x]).val();
                    detailCol=detailCol+"^^@"+$("#vLinkDescriptionInp_"+idcolArr[x]).val();
                }
            }
            $.ajax({ 
                type: "POST", 
                url: "/links",
                data:{ 'link': linkArr, 'linkTitle': linkTitleArr,'linkDescription':linkDescriptionArr,'empno':empno,'idcol':idcol, 'linkCol':linkCol, 'titleCol':titleCol, 'detailCol':detailCol }, 
                success: function(result) {
                    $("#panelbottomMsg").show();
                    alert(result)
                    if(result===1){
                        var msg="<div class='alert alert-danger alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Cannot proceed to saving. There are empty fields!</div>";
                    }else{
                        for ( var x = 1; x < idcolArr.length; x++) {
                            $( "#tr_"+idcolArr[x]).addClass( "trcolor" );
                            $("#tr_"+idcolArr[x]).css("background-color","#ebdea0");
                            $("#link_"+idcolArr[x]).show();$("#linkInp_"+idcolArr[x]).hide();
                            $("#vLinkTitle_"+idcolArr[x]).show();$("#vLinkTitleInp_"+idcolArr[x]).hide();
                            $("#vLinkDescription_"+idcolArr[x]).show();$("#vLinkDescriptionInp_"+idcolArr[x]).hide();
                        }
                        var msg="<div class='alert alert-success alert-dismissable'><button type='button' class='close' data-dismiss='alert' aria-hidden='true'>&times;</button>Saving is successful.</div>";
                    }
                    $("#panelbottomMsg").html(msg);
                        //window.location.reload();
                }
            });
    }); 

    $('.editIcon').click(function(){
        var idcolArr=idcol.split("^"); 
        for ( var x = 1; x < idcolArr.length; x++) {
            $( "#tr_"+idcolArr[x] ).removeClass( "trcolor" );
            $( "#tr_"+idcolArr[x] ).addClass( "trcolorOrig" );
        }
        $("#panelbottomMsg").hide();
        var id=$(this).attr("data-id");
        $("#editIcon"+id).hide();$("#cancelIcon"+id).show();
        var tablename=$(this).attr("data-tablename");
        if(!(idcol.indexOf(id) > -1)){ idcol=idcol+"^"+id;}
        if(tablename=="links"){
            $("#saveAllBtn").show();
            $("#link_"+id).hide();$("#linkInp_"+id).show();
            $("#vLinkTitle_"+id).hide();$("#vLinkTitleInp_"+id).show();
            $("#vLinkDescription_"+id).hide();$("#vLinkDescriptionInp_"+id).show();
        }
        if(tablename=="employees"){
            $("#btnSaveUsers").show();
            $("#fnameSpan_"+id).hide();$("#fnameInp_"+id).show();
            $("#snameSpan_"+id).hide();$("#snameInp_"+id).show();
            $("#posiSpan_"+id).hide();$("#posiSel_"+id).show();
            $("#deptSpan_"+id).hide();$("#deptSel_"+id).show();
            $("#regionSpan_"+id).hide();$("#regionSel_"+id).show();
        }
    }); 

    $('.cancelIcon').click(function(){
        var id=$(this).attr("data-id");
        var newidcol=idcol.replace("^"+id, "");
        idcol=newidcol;
        var tablename=$(this).attr("data-tablename");
        $("#editIcon"+id).show();$("#cancelIcon"+id).hide();
        if(tablename=="employees"){
            if(idcol==""){ $("#btnSaveUsers").hide();}
            $("#fnameSpan_"+id).show();$("#fnameInp_"+id).hide();
            $("#snameSpan_"+id).show();$("#snameInp_"+id).hide();
            $("#posiSpan_"+id).show();$("#posiSel_"+id).hide();
            $("#deptSpan_"+id).show();$("#deptSel_"+id).hide();
            $("#regionSpan_"+id).show();$("#regionSel_"+id).hide();
        }
        if(tablename=="links"){
            if(idcol=="" && ctrAddRow==0){ $("#saveAllBtn").hide();}
            $("#link_"+id).show();$("#linkInp_"+id).hide();
            $("#vLinkTitle_"+id).show();$("#vLinkTitleInp_"+id).hide();
            $("#vLinkDescription_"+id).show();$("#vLinkDescriptionInp_"+id).hide();
        }
        
    }); 

});
