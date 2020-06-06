var page = 1;
var current_page = 1;
var total_page = 0;
var is_ajax_fire = 0;
var search = 0;


manageData();

$( "#search" ).keyup(function() {
    manageData();
  });

/* manage data list */
function manageData() {

    $.ajax({
      dataType: 'json',
      url: url,
      data: {page:page,search:$("#search").val()}
    }).done(function(data){


    total_page = data.total % 5;
       current_page = page;

    //    $('#pagination').twbsPagination({
    //         totalPages: total_page,
    //         visiblePages: current_page,
    //         onPageClick: function (event, pageL) {


    //             page = pageL;


    //             if(is_ajax_fire != 0){
    //                getPageData();
    //             }
    //         }
    //     });


        manageRow(data.data);


        is_ajax_fire = 1;


   });
}


/* Get Page Data*/
function getPageData() {


    $.ajax({
       dataType: 'json',
       url: url,
       data: {page:page}
	}).done(function(data){


       manageRow(data.data);


    });


}


/* Add new Item table row */
function manageRow(data) {

    var	rows = '';

    $.each( data, function( key, value ) {

        rows = rows + '<tr>';
        rows = rows + '<td>'+value.sapid+'</td>';
        rows = rows + '<td>'+value.hostname+'</td>';
        rows = rows + '<td>'+value.loopback+'</td>';
        rows = rows + '<td>'+value.mac_address+'</td>';
        rows = rows + '<td data-id="'+value.id+'">';
        rows = rows + '<button data-toggle="modal" data-target="#edit-item" class="btn btn-primary edit-item">Edit</button> ';
        rows = rows + '<button class="btn btn-danger remove-item">Delete</button>';
        rows = rows + '</td>';
        rows = rows + '</tr>';


    });


    $("tbody").html(rows);


}


/* Create new Item */
$(".crud-submit").click(function(e){

    e.preventDefault();
    var form_action = $("#create-item").find("form").attr("action");
    var sapid = $("#create-item").find("input[name='sapid']").val();
    var hostname = $("#create-item").find("input[name='hostname']").val();
    var loopback = $("#create-item").find("input[name='loopback']").val();
    var mac_address = $("#create-item").find("input[name='mac_address']").val();
    
    
    if(sapid != "" &&  hostname !="" && loopback !="" &&  mac_address != ""){

        $.ajax({
            dataType: 'json',
            type:'POST',
            url: form_action,
            data:{sapid:sapid, hostname:hostname,loopback:loopback,mac_address:mac_address}
        }).done(function(data){
            $(".modal").find("input[type=text]").val("")
    
    
            getPageData();
           $(".modal").modal('hide');
            toastr.success('Item Created Successfully.', 'Success Alert', {timeOut: 5000});
    
    
        });
    }
   


});


/* Remove Item */
$("body").on("click",".remove-item",function(){


    var id = $(this).parent("td").data('id');
    var c_obj = $(this).parents("tr");


    if (confirm("Are you sure?")) {

        $.ajax({
            dataType: 'json',
            type:'get',
            url: url + '/delete/' + id,
        }).done(function(data){
    
    
            c_obj.remove();
            toastr.success('Item Deleted Successfully.', 'Success Alert', {timeOut: 5000});
            getPageData();
    
    
        });
        
    }
    


});


/* Edit Item */
$("body").on("click",".edit-item",function(){


    var id = $(this).parent("td").data('id');
    var sapid =  $(this).parent("td").prev("td").prev("td").prev("td").prev("td").text();
    var hostname = $(this).parent("td").prev("td").prev("td").prev("td").text();
    var loopback =  $(this).parent("td").prev("td").prev("td").text();
    var mac_address =  $(this).parent("td").prev("td").text();

    console.log($(this).parent("td").html());
    $("#edit-item").find("input[name='sapid']").val(sapid);
    $("#edit-item").find("input[name='hostname']").val(hostname);
    $("#edit-item").find("input[name='loopback']").val(loopback);
    $("#edit-item").find("input[name='mac_address']").val(mac_address);
    $("#edit-item").find("form").attr("action",url + '/update/' + id);


});


/* Updated new Item */
$(".crud-submit-edit").click(function(e){


    e.preventDefault();


    var form_action = $("#edit-item").find("form").attr("action");
    var sapid = $("#edit-item").find("input[name='sapid']").val();
    var hostname = $("#edit-item").find("input[name='hostname']").val(); 
    var loopback = $("#edit-item").find("input[name='loopback']").val();
    var mac_address = $("#edit-item").find("input[name='mac_address']").val();



    $.ajax({
        dataType: 'json',
        type:'POST',
        url: form_action,
        data:{sapid:sapid, hostname:hostname,loopback:loopback,mac_address:mac_address}
    }).done(function(data){


        getPageData();
        $(".modal").modal('hide');
        toastr.success('Item Updated Successfully.', 'Success Alert', {timeOut: 5000});


    });


});
