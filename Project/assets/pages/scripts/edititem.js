var hiddenurl = $('#hiddenURL').val();

$("#edit_item_form").validate({
    rules: {
        edit_item_name: {
            required: true
        },
        edit_item_price: {
            required: true,
            min: 1
        },
        edit_item_quantity: {
            required: true,
            min: 1

        },
        edit_item_description: {
            required: true
        },
        edit_item_location: {
            required: true
        },
    },
});

function convertToSlug(Text)
{
    return Text
        .toLowerCase()
        .replace(/ /g,'-')
        .replace(/[^\w-]+/g,'')
        ;
}


    function placetrdata(tr_object, head = null, body = null, checkbox_selection = false, remove_tr = false){
    var address_slug = '';
    var location_slug = '';
    if (head.length > 0) {
        /* find address slug from ajax repsonse */
        var first_split = head.split('address="')
        if ($.isArray(first_split)) {
            var second_split = first_split[1].split('"><td')
            address_slug = second_split[0]
        }
        /* find location from ajax repsonse */
        var third_split = head.split('loc"');
         var forth_split = '';
         var fifth_split = '';
        if ($.isArray(third_split)) {
            //var html = '<tr id="temp_VH" class="old_location" data-loc="VH" data-address="12-23"><td class="panel-heading" colspan="7"><span class="category">12-23</span><span class="locaton_type">VH</span></td></tr>';
            var $html = $(head);
            $('[data-address]', $html.wrapAll($('<tr>')).parent()).each(function (ix, el) {
                 forth_split = $(el).data('address');
                 fifth_split = $(el).data('loc');
            });
            // var forth_split = third_split[1].split('data-address');
            address_slug = forth_split;
            location_slug = fifth_split;
        }
    }
    console.log(tr_object);
    // if ($.type(tr_object) == 'objecct') {
       
        var status = 0;
         $('.attribute_data tr').each(function(index, tr) {
            var address_data = $(tr).attr('data-address')
            var location_data = $(tr).attr('data-loc')
            console.log(address_data == address_slug,location_data == location_slug);
            if (address_data == address_slug && location_data == location_slug && !checkbox_selection) {
                status = 1;
                $(tr).after(body);
            }
            if (remove_tr) {
                $('.attribute_data tr').each(function(index, tr) {
                if($(tr).data('address') == 12 && $(tr).data("loc") == 'PM'){
                   $(tr).remove();
                }
            });
            }
        })
             if(status == 0){
                $(".attribute_data").append(head);
                $(".attribute_data").append(body);
             } 
        // if (checkbox_selection) {
        //     tr_object.append('<tr><td colspan="4" data-ent="' + checkbox_selection + '">Enitre Location</td></tr>');
        // }
    // }
}



$("#edit_submit").click(function(e) {
    e.preventDefault();
     var status = true;
    // alert(copy_itemid);
    // var table_row_att = $('#table_row_att').val();
    var edit_item_name_popup = $("#edit_item_name_popup").val();
    var edit_item_select_popup = $("#edit_item_select_popup").val();
    var edit_item_address = $("#edit_item_address").val();
    var edit_item_location_type = $("#edit_item_location_type").val();
    var old_text = $("#old_val").val();
    var edit_item_price = $("#edit_item_price").val();
    var edit_item_quantity = $("#edit_item_quantity").val();
    var edit_item_description = $("#edit_item_description").val();
    var edit_item_location = $("#edit_item_location").val();
    var rowid = $("#copy_orderitem_id").val();
    // var gallrey = $("#gallrey1").html();
    var item_id = $("#item_id").val();
    var chk = "";
    
     $('.attribute_data tr.old_location').each(function(index, tr) {
                 var address_data = $(tr).attr('data-address');
                 var loc_type = $(tr).attr('data-loc');
                  if($(tr).find('td.itm-price')) {
                         if(edit_item_address == address_data && edit_item_location_type == loc_type){
                            var nexttr_id= $(tr).next('tr').attr('id');
                            console.log(nexttr_id);
                             // if (nexttr_id.indexOf("trid") > -1) {
                             if (nexttr_id && nexttr_id.indexOf('trid') > -1) {
                                $("#trid_"+item_id).remove();
                                status = true;
                             }else {
                                status = false;
                                swal("This Address or location alredy exists!");
                                 $("#exampleModal").modal('toggle');
                             }
                        }else { status == true; }
                     }
                 // console.log(item_address,address_data,item_address == address_data && item_location_type == loc_type,item_location_type,loc_type);
            });
             // console.log(status);
             if(status == false){ 
                return false;
            }else {
    if (edit_item_name_popup != "" || edit_item_select_popup != '' && edit_item_price != "" && edit_item_quantity != "" && edit_item_location != ""  && edit_item_description != "" && (edit_item_quantity > 0) && (edit_item_price > 0)) {

        // if (edit_gallery_photo_add.files) {
        //     var filesAmount = edit_gallery_photo_add.files.length;

        //     for (i = 0; i < filesAmount; i++) {
        //         var type = files[i].type.split('/').pop().toLowerCase();

        //         return;
        //         var reader = new FileReader();
        //         reader.onload = function(event) {
        //             result += ($.parseHTML('<img class="prev"  style="height:70px; width:70px;" alt="No Image">')).attr('src', event.target.files[i]);
        //         }
        //         reader.readAsDataURL(edit_gallery_photo_add.files[i]);
        //     }
        // }


        var form = $('#edit_item_form')[0];
        var formData = new FormData(form);
        // $(".ajax-loader").fadeIn("slow");


        $.ajax({
            url: hiddenurl + "Dashboard_Controller/updateitem",
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            dataType: 'JSON',
            success: function(response) {
                console.log(response);
                if (response.success != "" && response.item != "") {
                 placetrdata($('.attribute_data'), response.head, response.body,chk,response.remove_tr);
                 /*$('.old_location').each(function(index, tr) {
                    if($(this).data("address") == 122) {
                        $(this).remove();
                }
                 });*/
                    $(".ajax-loader").fadeOut("slow");
                    $("#exampleModal").modal('toggle');
                    $("#result_message").fadeIn("slow").html("Item Updated Successfully");
                    setTimeout(function() {
                        $("#result_message").fadeOut("slow");
                    }, 2000);

                } else {
                    $(".ajax-loader").fadeOut("slow");
                    $("#result_error_message").fadeIn("slow").html(display);
                    setTimeout(function() {
                        $("#result_error_message").fadeOut("slow");
                    }, 2000);
                }
            }
        })


    } else {
        // alert("Please Enter all the value");
    }
}

})

// copy of above script for update copy order

$("#edit_copy").click(function(e) {
    // alert("copy");
    e.preventDefault();
    var status = true;
    var copy_itemid = $('#copyitem_id').val();
    var pageURL = $(location).attr("href");
    var dis = "edit";
    // alert(copy_itemid);
    // var table_row_att = $('#table_row_att').val();
    var edit_item_name_popup = $("#edit_item_name_popup").val();
    var edit_item_select_popup = $("#edit_item_select_popup").val();
    var edit_item_price = $("#edit_item_price").val();
    var edit_item_quantity = $("#edit_item_quantity").val();
    var edit_gallery_photo_add = $("#gallery-photo-add1").prop('files');
    var edit_item_description = $("#edit_item_description").val();
    var edit_item_address = $("#edit_item_address").val();
    var edit_item_location_type = $("#edit_item_location_type").val();

    // var gallrey = $("#gallrey1").html();
    var newitem_id = $("#copyitem_id").val();

    var edit_item_location = $("#edit_item_location").val();
    // var gallrey = $("#gallrey1").html();
    var newitem_id = $("#copyitem_id").val();
        var form = $('#edit_item_form')[0];
        var formData = new FormData(form);
         $('.attribute_data tr.old_location').each(function(index, tr) {
                 var address_data = $(tr).attr('data-address');
                 var loc_type = $(tr).attr('data-loc');
                  if($(tr).find('td.itm-price')) {
                         if(edit_item_address == address_data && edit_item_location_type == loc_type){
                            var nexttr_id= $(tr).next('tr').attr('id');
                            console.log(nexttr_id);
                             // if (nexttr_id.indexOf("trid") > -1) {
                             if (nexttr_id && nexttr_id.indexOf('trid') > -1) {
                                // $("#trid_"+copy_itemid).remove();
                                status = true;
                             }else {
                                status = false;
                                swal("This Address or location alredy exists!");
                                 $("#exampleModal").modal('toggle');
                             }
                        }else { status == true; }
                     }
                 console.log(edit_item_address,address_data,edit_item_address == address_data, edit_item_location_type == loc_type,edit_item_location_type,loc_type);
            });
            //  console.log(status);
             if(status == false){ 
                return false;
            }else {
    if (edit_item_name_popup != "" || edit_item_select_popup != '' && edit_item_price != "" && edit_item_quantity != "" && edit_item_description != "" && edit_item_location != "" && edit_item_address != "" && (edit_item_quantity > 0) && (edit_item_price > 0)) {

        // $(".ajax-loader").fadeIn("slow");
        $.ajax({
            url: hiddenurl + "Dashboard_Controller/update_newitem",
            method: "POST",
            data: formData,
            contentType: false,
            processData: false,
            cache: false,
            dataType: 'HTML',
            // dataType: 'JSON',
            success: function(response) {
                   if (response) {
                     $(".html-content").html(response);
                    // var rowtoremove = response.item;
                    // $("#" + response.rowid).remove();
                    // $("tbody.attribute_data").append(response.tablerow);
                    // $(".ajax-loader").fadeOut("slow");
                    $("#exampleModal").modal('toggle');
                    $("#result_message").fadeIn("slow").html("Item Updated Successfully");
                    setTimeout(function() {
                        $("#result_message").fadeOut("slow");
                    }, 2000);
                     // console.log(pageURL.indexOf(dis) != -1);
                    // r va pageURL = $(location).attr("href");
                     // var dis = "edit";
                   /* if(pageURL.indexOf(dis) != -1){
                         var newurl = hiddenurl+ "edit/"+response.order_id;
                    } else {
                         var newurl = hiddenurl+ "duplicate_order/"+response.order_id;
                    }*/
                    // var newurl = hiddenurl+ "duplicate_order/"+response.order_id;
                     // window.location = newurl;
                     // "<?php base_url('Dashboard_Controller/copyorder/' ?>" + response.order_id);
                    // location.reload();
                } else {
                    // $(".ajax-loader").fadeOut("slow");
                    $("#result_error_message").fadeIn("slow").html(display);
                    setTimeout(function() {
                        $("#result_error_message").fadeOut("slow");
                    }, 2000);
                }
            },
             error: function(data){
                console.log("gfd");
             }
        })


    } else {
        alert("Please Enter all the value");
    }
}

});

// update edit tr
$(document).delegate('#update_tr_value', 'click', function(event) {
     var status = true;
     var item_address = $("#address").val();
     var item_location_type = $("#location").val();
     var old_address = $("#old_adddress").val();
     var old_location_type = $("#old_loc").val();
     var form = $('#edit_tr_row')[0];
     var formData = new FormData(form);
    //  console.log(form);
     $('.attribute_data tr.old_location').each(function(index, tr) {
                 var address_data = $(tr).attr('data-address');
                 var loc_type = $(tr).attr('data-loc');
                  // if($(tr).find('td.itm-price')) {
                         if(item_address == address_data && item_location_type == loc_type){
                             status = false;
                              swal("This Address or location alredy exists!");
                           /* var nexttr_id= $(tr).next('tr').attr('id');
                            console.log(nexttr_id);
                             // if (nexttr_id.indexOf("trid") > -1) {
                             if (nexttr_id && nexttr_id.indexOf('trid') > -1) {
                                status = true;
                             }else {
                                status = false;
                                swal("This Address or location alredy exists!");
                             }*/
                        }else { status == true; }
                     // }
                 // console.log(item_address,address_data,item_address == address_data && item_location_type == loc_type,item_location_type,loc_type);
            });
             // console.log(status);
             if(status == false){ 
                 $("#small").modal('hide');
                return false;
            }else {
     $.ajax({
        url: hiddenurl + "Dashboard_Controller/update_tr",
        method: "POST",
        data: formData,
        dataType: 'JSON',
        contentType: false,
        processData: false,
        cache: false,
        success: function(response) {
            if (response.success != "" && response.item != "") {
                $('.attribute_data tr.checkbox_tr').each(function(index, tr) {
                     var address_data = $(tr).attr('data-oldaddress');
                     var loc_type = $(tr).attr('data-oldloc');
                     console.log(old_address == address_data,old_location_type == loc_type);
                     if(old_address == address_data && old_location_type == loc_type){
                            $(tr).prev().replaceWith(response.head);
                     }
                });
                $("#small").modal('hide');
                $("#result_message").fadeIn("slow").html("Location Updated Successfully");
                setTimeout(function() {
                    $("#result_message").fadeOut("slow");
                }, 2000);

            } else {
                $(".ajax-loader").fadeOut("slow");
                $("#result_error_message").fadeIn("slow").html(display);
                setTimeout(function() {
                    $("#result_error_message").fadeOut("slow");
                }, 2000);
            }
        }
    });
 }
});

$(".removeImage12").click(function(e) {
    // alert("fdfg");
    e.preventDefault();
    if (confirm("Are you sure you want to delete ?")) {
        // alert("dfsdf");
        var imgid = $(this).data("imageid");
        var newimage_id = $(this).data("newimage_id");
        // alert(imgid);
        var imgname = $(this).data("imagename");
        var thisdata = $(this);

        console.dir(thisdata);
        // alert(imgid);
        $.ajax({
            url: hiddenurl + 'Dashboard_Controller/deleteimage',
            type: 'POST',
            data: {
                imgid: imgid,
                imgname: imgname,
                newimage_id: newimage_id
            },
            success: function(response) {
                if (response.success != "") {
                    thisdata.parent('div').remove();
                    $("#result_message").fadeIn("slow").html("Image Deleted Successfully");
                    setTimeout(function() {
                        $("#result_message").fadeOut("slow");
                    }, 5000);
                } else {
                    $("#result_error").fadeIn("slow").html("Something went wrong..");
                    setTimeout(function() {
                        $("#result_error").fadeOut("slow");
                    }, 5000);
                }
            }
        });
    }
});

//delete image in edit item popup
// $(document).delegate('.removeImage1', 'click', function() {

//     if (confirm("Are you sure you want to delete ?")) {
//         var imgid = $(this).data("imageid");
//         var imgname = $(this).data("imagename");
//         var thisdata = $(this);
//         // alert(imgid);
//         $.ajax({
//             url: hiddenurl + 'dashboard_controller/deleteimage',
//             type: 'POST',
//             data: {
//                 imgid: imgid,
//                 imgname: imgname
//             },
//             success: function(response) {
//                 if (response.success != "") {
//                     thisdata.parent('div').remove();
//                     $("#result_message").fadeIn("slow").html("Image Deleted Successfully");
//                     setTimeout(function() {
//                         $("#result_message").fadeOut("slow");
//                     }, 5000);
//                 } else {
//                     $("#result_error").fadeIn("slow").html("Something went wrong..");
//                     setTimeout(function() {
//                         $("#result_error").fadeOut("slow");
//                     }, 5000);
//                 }
//             }
//         });
//     }

// });


// image preview in edit order
var imagesPreview = function(input, placeToInsertImagePreview) {

    if (input.files) {
        var filesAmount = input.files.length;

        for (k = 0; k < filesAmount; k++) {
            console.log(input.files[k].size);
            if ((input.files[k].type == "image/jpeg" || input.files[k].type == "image/png" || input.files[k].type == "image/jpg" || input.files[k].type == "image/gif") && input.files[k].size <= 2000000) {

                var reader = new FileReader();
                reader.onload = function(event) {
                    var path = $('<div class="single"></div>').appendTo(placeToInsertImagePreview);
                    $($.parseHTML('<img class="prev"  style="height:70px; width:70px;" alt="No Image">')).attr('src', event.target.result).appendTo(path);
                }
                reader.readAsDataURL(input.files[k]);
            } else {

                $(".image_gellery_show1").empty();
                $("#gallery-photo-add1").val(null);
                $("#img_err1").html("Please Enter Valid Image");
                return false;
            }

        }
    }
};

//after choosing the image .input clear code
$('#gallery-photo-add1').on('change', function() {
    $("#img_err").html("");
    $(".image_gellery_show1").empty();
    imagesPreview(this, 'div.gallery1');
});