    var hiddenurl = $('#hiddenURL').val();
    var pageURL = $(location).attr("href");
    function convertToSlug(Text)
    {
        return Text
            .toLowerCase()
            .replace(/ /g,'-')
            .replace(/[^\w-]+/g,'')
            ;
    }

    
 //add item and create table in
 $("#add_items_edit").click(function() {
         var status = true;
        var request_title = $('#request_title').val();
        var item_address = $('#item_cat').val();
        var item_location_type = $('#item_location_type').val();
        var html_location_type
        if(item_location_type == 'PM') {
            html_location_type = "Primary Home";
        } else if(item_location_type == 'VH') {
            html_location_type = "Vacation Home";
        } else if(item_location_type == 'OFC'){
            html_location_type = 'Office';
        } else if(item_location_type == 'OTHER'){
            html_location_type = 'Other';
        }else{
            html_location_type = '';
        }
        var main = $('#main_order_id').val();
        var item_address_slug = convertToSlug($.trim(item_address));
        var location = $('#request_location').val();
        var table_row_att = $('#table_row_att').val();
        var item_name = $("#item_name").val();
        var item_price = $("#item_price").val();
        var item_quantity = $("#item_quantity").val();
        var gallery_photo_add = $("#gallery-photo-add").prop('files');
        // var item_description = $("#item_description").val();
        var item_location = $("#item_location").val();
        var item_select = $("#item_select").val();
        var gallrey = $("#gallrey").html();

        // alert(item_select);
        var result = '';
            if (gallery_photo_add.files) {
                var filesAmount = gallery_photo_add.files.length;
                // console.log(gallery_photo_add.files);
                for (i = 0; i < filesAmount; i++) {
                    var type = files[i].type.split('/').pop().toLowerCase();
                    return;
                    var reader = new FileReader();
                    reader.onload = function(event) {
                        result += ($.parseHTML('<img class="prev"  style="height:70px; width:70px;" alt="No Image">')).attr('src', event.target.files[i]);
                    }
                    reader.readAsDataURL(gallery_photo_add.files[i]);
                }
            }

            // handling insert item in database
            var form = $('#new_order_form')[0];
            var formData = new FormData(form);

             $('.attribute_data tr.old_location').each(function(index, tr) {
                 var address_data = $(tr).attr('data-address');
                 var loc_type = $(tr).attr('data-loc');
                 console.log(address_data,loc_type);
                  if($(tr).find('td.itm-price')) {
                         if(item_address == address_data && item_location_type == loc_type){
                            var nexttr_id= $(tr).next('tr').attr('id');
                            console.log(nexttr_id);
                             // if (nexttr_id.indexOf("trid") > -1) {
                             if (nexttr_id && nexttr_id.indexOf('trid') > -1) {
                                status = true;
                             }else {
                                status = false;
                                swal("This Address or location alredy exists!");
                             }
                        }else { status == true; }
                     }
                 // console.log(item_address,address_data,item_address == address_data && item_location_type == loc_type,item_location_type,loc_type);
            });
             console.log(status);
             if(status == false){ 
                return false;
            }else {
             if (item_location_type != '' && item_address != '' && item_location != "" && item_price != '' && item_quantity != '' && item_select != ''){
                // $("#error_item_name").hide();
                // $("#error_item_price").hide();
                // $("#error_item_qty").hide();
                // $("#error_location").hide();
                // $(".ajax-loader").fadeIn("slow");
            $.ajax({
                url: hiddenurl + "Edit_copy_Controller/edit_copy_order_insert",
                method: "POST",
                data: formData,
                contentType: false,
                processData: false,
                cache: false,
                // dataType: 'JSON',
                dataType: 'HTML',
                success: function(response) {
                     $(".html-content").html(response);
                        // console.log(response);
                       /* if(response.already != '') {
                        alert("Location and Address in already use");
                                //  $("#result_error_message").fadeIn("slow").html(response.already);
                                // setTimeout(function() {
                                //     $("#result_error_message").fadeOut("slow");
                                // }, 2000);
                        }*/
                        // if (window.location.href.indexOf("edit") > -1) {
                        //     var newurl = window.location;
                        // } else {
                        //      var newurl = hiddenurl+ "duplicate_order/"+main;
                        // }
                        //   window.location = newurl;
                        // placetrdata($('.attribute_data'), response.head, response.body,response.checkbox);

                        $('#table_row_att').val(table_row_att);
                        $('#item_name').val("");
                        $('#item_quantity').val("");
                        $('#item_price').val("");
                        $('#item_location').val("");
                        $('#item_select').val("");
                        // $('#item_description').val("");
                        $('#gallery-photo-add').val("");
                        $('#gallrey').empty();
                        $('.display-attribute').show();
                        // $(".ajax-loader").fadeOut("slow");
                        $("#result_message").fadeIn("slow").html("Item Saved Successfully");
                        setTimeout(function() {
                            $("#result_message").fadeOut("slow");
                        }, 2000);

                   // }

                   /* if (response.error != "") {
                        $(".image_gellery_show").empty();
                        $("#gallery-photo-add").val(null);
                        var error = response.error;
                        var display = error.replace("/<[\/]{0,1}(p)[^><]*>/ig", " ");
                        $(".ajax-loader").fadeOut("slow");
                        $("#result_error_message").fadeIn("slow").html(display);
                        setTimeout(function() {
                            $("#result_error_message").fadeOut("slow");
                        }, 2000);
                    }*/
                }
            });
        }else{
            swal("Please enter all fields");
            // $("#error_item_address").show();
            // $("#error_item_location").show();
            // $("#error_item_name").show();
            // $("#error_item_price").show();
            // $("#error_item_qty").show();
            // $("#error_location").show();
            return false;
        }
    }
    });


    $("#edit_entire_chk").click(function() {
        // alert("dfds");
        var status = true;
        var item_address = $('#item_cat').val();
        var item_location_type = $('#item_location_type').val();
        var main = $('#main_order_id').val();
        if (!item_address && !item_location_type.length ){
            alert("lkdflkg");
            swal("Please enter all fields");
        }
         $('.attribute_data tr.old_location').each(function(index, tr) {
             var address_data = $(tr).attr('data-address');
             var loc_type = $(tr).attr('data-loc');
             if(item_address == address_data && item_location_type == loc_type){
               swal("This Address or location alredy exists!");
                status = false;
             }
        });
         if(status == false) {
            return false;
         }else {
         if (item_address != "" && item_location_type != ''){
            //  $("#error_item_address").hide();
            // $("#error_item_location").hide();
             $.ajax({

                    url: hiddenurl + "Edit_copy_Controller/edit_insert_disable_location",

                    method: "POST",

                    data: {
                        item_address: item_address,
                        item_location_type: item_location_type,
                        main_order_id:main
                    },

                    dataType: 'HTML',
                    // dataType: 'JSON',
                     success: function(response) {
                        $(".html-content").html(response);
                             /*if(response.already != '') {
                            alert("Location and Address in already use");
                                    //  $("#result_error_message").fadeIn("slow").html(response.already);
                                    // setTimeout(function() {
                                    //     $("#result_error_message").fadeOut("slow");
                                    // }, 2000);
                            }*/
                            /* if (window.location.href.indexOf("edit") > -1) {
                                var newurl = window.location;
                            } else {
                                 var newurl = hiddenurl+ "duplicate_order/"+main;
                            }
                              window.location = newurl;*/
                            // placetrdata($('.attribute_data'), response.head, null,response.checkbox,chk);
                            //  $('.display-attribute').show();
                    }
                });
        } else  {
            swal("Please enter all fields");
            // $("#error_item_address").show();
            // $("#error_item_location").show();
            return false
        }
    }
});

     // edit address location js
    $(document).delegate('.locatiob_edit_tr', 'click', function(event) {
        $("#small_copy").modal('show');
        var id = $(this).data('id');
        $.ajax({

            url: hiddenurl + "Edit_copy_Controller/edit_tr",

            method: "POST",

            data: {
                item_id: id
            },

            success: function(response) {

                // console.log(response)

                $(".small_copy_edit").html(response);



            }

        });
    });
    // edit address location js

// update edit tr
$(document).delegate('#update_copytr_value', 'click', function(event) {
     var status = true;
     var item_address = $("#address").val();
     var item_location_type = $("#location").val();
     var form = $('#edit_tr_row_copy')[0];
     var formData = new FormData(form);
      $('.attribute_data tr.old_location').each(function(index, tr) {
             var address_data = $(tr).attr('data-address');
             var loc_type = $(tr).attr('data-loc');
             if(item_address == address_data && item_location_type == loc_type){
                 $("#small_copy").modal('hide');
               swal("This Address or location alredy exists!");
                status = false;
             }
        });
     console.log(status);
         if(status == false) {
            return false;
         }else {
     $.ajax({
        url: hiddenurl + "Edit_copy_Controller/update_tr",
        method: "POST",
        data: formData,
        // dataType: 'JSON',
        dataType: 'HTML',
        contentType: false,
        processData: false,
        cache: false,
        success: function(response) {
            if (response.success != "" && response.item != "") {
            $(".html-content").html(response);
            $("#small_copy").modal('hide');
                $("#result_message").fadeIn("slow").html("Location Updated Successfully");
                setTimeout(function() {
                    $("#result_message").fadeOut("slow");
                }, 2000);
            }else {
              
                // $(".ajax-loader").fadeOut("slow");
                $("#result_error_message").fadeIn("slow").html(display);
                setTimeout(function() {
                    $("#result_error_message").fadeOut("slow");
                }, 2000);
            }
           /* if (response.success != "" && response.item != "") {
                placetrdata($('.attribute_data'), response.head, response.body);
                $(".ajax-loader").fadeOut("slow");
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
            }*/
        }
    });
 }
});
// });