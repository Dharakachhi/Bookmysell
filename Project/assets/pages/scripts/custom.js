$(document).ready(function() {



    var hiddenurl = $('#hiddenURL').val();

    var url_email = hiddenurl + "Home_Controller/check_duplicate_email";



    $("#reload").click(function() {

        var url = hiddenurl + 'Home_Controller/refresh_captcha';

        $.ajax({

            url: url,

            dataType: 'json',

            processData: false,

            contentType: false,

            success: function(response) {

                $("#captchaimage").html(response.captchaimage);

                $("#captcha_word").val(response.captcha_word);

            }

        });



    });



 

    // image previe while add the item

    var imagesPreview = function(input, placeToInsertImagePreview) {



        if (input.files) {

            var filesAmount = input.files.length;



            for (k = 0; k < filesAmount; k++) {

                //console.log(input.files[k].size);

                if ((input.files[k].type == "image/jpeg" || input.files[k].type == "image/png" || input.files[k].type == "image/jpg" || input.files[k].type == "image/gif") && input.files[k].size <= 2000000) {



                    var reader = new FileReader();

                    reader.onload = function(event) {

                        var path = $('<div class="single"></div>').appendTo(placeToInsertImagePreview);

                        $($.parseHTML('<img class="prev"  style="height:70px; width:70px;" alt="No Image">')).attr('src', event.target.result).appendTo(path);

                    }

                    reader.readAsDataURL(input.files[k]);

                } else {



                    $(".image_gellery_show").empty();

                    $("#gallery-photo-add").val(null);

                    $("#img_err").html("Please Enter Valid Image");

                    return false;

                }



            }

        }

    };



    //after choosing the image .input clear code

    $('#gallery-photo-add').on('change', function() {

        $("#img_err").html("");

        $(".image_gellery_show").empty();

        imagesPreview(this, 'div.gallery');

    });




   $("#item_select").change(function() {
 // $(document).delegate('#item_select', 'click', function() {
    if($(this).val() == 'Other') {
        $('#item_name').show();
        // $('#item_select').hide();
    } else {
        $('#item_name').hide();
    }


 });

 $(document).delegate('#edit_item_select_popup', 'change', function() {
    if($(this).val() == 'Other') {
        $('#edit_item_name_popup').show();
        // $('#item_select').hide();
    } else {
        $('#edit_item_name_popup').hide();
    }
 });

function convertToSlug(Text)
{
    return Text
        .toLowerCase()
        .replace(/ /g,'-')
        .replace(/[^\w-]+/g,'')
        ;
}

function placetrdata(tr_object, head = null, body = null, checkbochmtl = null, checkbox_selection = false, remove_tr = false){
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
                // console.log(forth_split);
            });
            // console.log(address_slug);
            // var forth_split = third_split[1].split('data-address');
            address_slug = forth_split;
            location_slug = fifth_split;
        }
    }
	// if ($.type(tr_object) == 'objecct') {
        var status = 0;
        var ck = false;
        // console.log(head,checkbochmtl,checkbox_selection)
         $('.attribute_data tr').each(function(index, tr) {
            var address_data = $(tr).attr('data-address')
            var location_data = $(tr).attr('data-loc')
            var location_entire = $(tr).find("td").attr('data-ent')
            // console.log(address_data == address_slug,location_data == location_slug, !checkbox_selection,location_entire != 'entire-location');
            if (address_data == address_slug && location_data == location_slug && !checkbox_selection) {
                status = 1;
                $(tr).after(body);
            }
        })
             if(status == 0 && !checkbox_selection){
                $(".attribute_data").append(head);
                $(".attribute_data").append(body);
             }
        if (checkbox_selection) {
        	// console.log('dfGDFg');
            $('.attribute_data tr').each(function(index, tr) {
                if($(tr).data('address') == address_slug && $(tr).data("loc") == location_slug){
                    ck = true;
                  swal("Please Enter differnt address or Location");
                }
            });
            if(!ck) {
                $(".attribute_data").append(head);
                $(".attribute_data").append(checkbochmtl);
                // tr_object.append(checkbochmtl);
            }
            // tr_object.append('<tr><td colspan="6" data-ent="' + checkbox_selection + '">Enitre Location</td></tr>');
        }
    // }
}

$("#entire_chk").click(function() {
    var status = true;
    var item_address = $('#item_cat').val();
    var item_location_type = $('#item_location_type').val();
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
         $.ajax({

                url: hiddenurl + "Dashboard_Controller/insert_disable_location",

                method: "POST",

                data: {
                    item_address: item_address,
                    item_location_type: item_location_type
                },

                dataType: 'JSON',
                 success: function(response) {
                 		var chk = true;
                        console.log(response);
                        placetrdata($('.attribute_data'), response.head, null,response.checkbox,chk);
                         $('.display-attribute').show();
                }
            });
     }
    // } else  {
    //      $("#error_item_address").show();
    //     $("#error_item_location").show();
    //     return false
    // }

});

    //add item and create table in
$(document).delegate('.add_attribute', 'click', function() {
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
        }  else if(item_location_type == 'OTHER'){
            html_location_type = 'Other';
        }else{
            html_location_type = '';
        }
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
            // check location and address is alreay exists or not
              var form = $('#add_item_detail_form')[0];
            var formData = new FormData(form);
             // end check already existis
            
                 $('.attribute_data tr.old_location').each(function(index, tr) {
                 var address_data = $(tr).attr('data-address');
                 var loc_type = $(tr).attr('data-loc');
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
             // console.log(status);
             if(status == false){ 
                return false;
            }else {


            if (item_location != '' && item_price != '' && item_quantity != '' && item_select != '' && item_location_type != '' &&  item_address != ''){
                $("#error_item_name").hide();
                $("#error_item_price").hide();
                $("#error_item_qty").hide();
                $("#error_location").hide();
                $("#error_item_address").hide();
                $("#error_item_location").hide();
                $(".ajax-loader").fadeIn("slow");
            $.ajax({

                url: hiddenurl + "Dashboard_Controller/insertitem",

                method: "POST",

                data: formData,

                contentType: false,

                processData: false,

                cache: false,

                dataType: 'JSON',

                success: function(response) {

                        // console.log(response);
                        placetrdata($('.attribute_data'), response.head, response.body,response.checkbox);

                        var price_array = [];
                        var totalPrice = 0;
                          $('.attribute_data td.itm-price').each(function() {
                            var sum = $(this).text();   
                            var price = sum.trim();
                            var sum_price = price.split('$');
                            totalPrice += parseFloat(sum_price[1]); 
                            price_array.push(price);
                         });
                          if(totalPrice) {
                            $("#total_price").text(totalPrice.toFixed(2));
                          }
                            // console.log(price_array,totalPrice);
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
                        $(".ajax-loader").fadeOut("slow");
                        $("#result_message").fadeIn("slow").html("Item Saved Successfully");
                        setTimeout(function() {
                            $("#result_message").fadeOut("slow");

                        }, 2000);
                    // }

                    if (response.error != "") {
                        $(".image_gellery_show").empty();
                        $("#gallery-photo-add").val(null);
                        var error = response.error;
                        var display = error.replace("/<[\/]{0,1}(p)[^><]*>/ig", " ");
                        $(".ajax-loader").fadeOut("slow");
                        $("#result_error_message").fadeIn("slow").html(display);
                        setTimeout(function() {
                            $("#result_error_message").fadeOut("slow");

                        }, 2000);

                    }

                }

            });
        }else {
             $("#error_item_address").show();
            $("#error_item_location").show();
            $("#error_item_name").show();
            $("#error_item_price").show();
            $("#error_item_qty").show();
            $("#error_location").show();
            // return false;
        }
       }
    
    });




    // $(".gallery").on("click",".removeImage1", function(e){



    //         e.preventDefault();

    //         $(this).parent('div').remove(); k--;

    //     });

//$("p").on("click", ".edit_attribute_of_copy", function() {

// $(document).delegate('.edit_attribute_of_copy', 'click', function() {

//     console.log('enter');

// //$( document ).delegate('.remove_attribute', 'click', function(){

//   alert('fjgfjhgfhg');

// });



    //edit model (fetch item and display in edit modal)

    $(document).delegate('.edit_attribute', 'click', function(event) {
        $("#exampleModal").modal('show');

        var item_id = $(this).data('id');
        console.log(item_id);
        // var address_ary = [];
        // var location_ary = [];
       // $('.attribute_data tr.old_location').each(function(index, tr) {
       //           var address_data = $(tr).attr('data-address');
       //           var location_data = $(tr).attr('data-loc');
       //           address_ary.push(address_data);
       //           location_ary.push(location_data);
       //           // console.log(item_address,address_data,item_address == address_data && item_location_type == loc_type,item_location_type,loc_type);
       //      });

         var old = $(this).parent().parent()[0].outerHTML

         $('#old_val').val(old);

         // console.log(old);

        // var newitem_id = $(this).data('newitem_id');

        // var newimage_id = $(this).data('newimage_id');

        var table_row_att = $('#table_row_att').val();

        var tr = $(this);

        var rowid = tr.parent().parent().attr("id");

        $.ajax({

            url: hiddenurl + "Dashboard_Controller/edititem",

            method: "POST",

            data: {

                item_id: item_id,

                table_row: rowid,
                // json_address: address_ary,
                // json_loc: location_ary,

                // copyitem_id: newitem_id,

                // newimage_id: newimage_id

            },

             dataType: 'HTML',

            success: function(response) {

                // console.log(response)

                $(".modal-body").html(response);



            }

        });

    });



    // copy of above script  of edit attribute

    $(document).delegate('.edit_attribute_of_copy', 'click', function(event) {

        // alert("kjdsf");

        $("#exampleModal").modal('show');

        var newitem_id = $(this).data('id');

        // var newitem_id = $(this).data('newitem_id');

        // alert(newitem_id);

        var newimage_id = $(this).data('newimage_id');

        var table_row_att = $('#table_row_att').val();

        var tr = $(this);

        var rowid = tr.parent().parent().attr("id");



        $.ajax({

            url: hiddenurl + "Dashboard_Controller/edit_newitem",

            method: "POST",

            data: {

                // item_id: item_id,

                table_row: rowid,

                copyitem_id: newitem_id,

                newimage_id: newimage_id

            },



            success: function(response) {

                // console.log(response)
                $(".modal-body").html(response);

            }

        });

    });



    // Delete Confirmation in orderlist
    // edit address location js
    $(document).delegate('.edit_attribute_group', 'click', function(event) {
        // alert("dfdfg");
        $("#small").modal('show');
        var id = $(this).data('id');
        $.ajax({

            url: hiddenurl + "Dashboard_Controller/edit_tr",

            method: "POST",

            data: {
                item_id: id
            },

            success: function(response) {

                // console.log(response)

                $(".small_edit").html(response);



            }

        });
    });
    // edit address location js

    $(document).delegate('.delete_order', 'click', function() {

        var result = confirm("Want to delete?");

        if (result) {

            return true;

        } else {

            return false;

        }

    });



    //delete itme in order

    $(document).delegate('.remove_attribute', 'click', function() {
        
         var result = confirm("Want to delete?");
         var main = $('#main_order_id').val();
         // alert(result);

        if (result == true) {

           // $(document).delegate('.remove_attribute', 'click', function() {



        var item_id = $(this).attr('id');

        var table_row_att = $('#table_row_att').val();



        var tr = $(this);

        $.ajax({

            url: hiddenurl + "Dashboard_Controller/deleteitem",

            method: "POST",

            data: {

                item_id: item_id,

            },

            dataType: 'JSON',

            success: function(response) {



                if (response.success != "" && response.item_id != "") {



                    if ($("#table_row_att").val() == 0) {

                        $("#error").html("Please enter at least one item");

                    }



                    $("#gallrey").html("")

                    tr.closest("tr").remove();

                    table_row_att = parseInt(table_row_att) - parseInt(1);

                    $('#table_row_att').val(table_row_att);



                    $("#result_message").fadeIn("slow").html("Item Deleted Successfully");

                    setTimeout(function() {

                        $("#result_message").fadeOut("slow");

                    }, 2000);
                    if ($(this).hasClass("remove_attribute_place")) { } 
                    else{

                        if (window.location.href.indexOf("edit") > -1) {
                                var newurl = window.location;
                            } else {
                                 var newurl = hiddenurl+ "duplicate_order/"+main;
                            }
                             window.location = newurl;
                    } 

                    var size = $(".attribute_data > tr").size();

                    if (size == 0) {

                        $('.display-attribute').hide();

                    } else {

                        $('.display-attribute').show();

                    }

                } else {



                    $("#result_error").fadeIn("slow").html("Something went wrong..");

                    setTimeout(function() {

                        $("#result_error").fadeOut("slow");



                    }, 2000);

                }

            }



        });

    // });



        } else {

            return false;

        }

    });



 //delete itme in order

 $(document).delegate('.remove_attribute_place', 'click', function() {
        
    var result = confirm("Want to delete?");
    var main = $('#main_order_id').val();
    // alert(result);

   if (result == true) {

   var item_id = $(this).attr('id');

   var table_row_att = $('#table_row_att').val();

   var tr = $(this);

   $.ajax({

       url: hiddenurl + "Dashboard_Controller/deleteitem",

       method: "POST",

       data: {

           item_id: item_id,

       },

       dataType: 'JSON',

       success: function(response) {



           if (response.success != "" && response.item_id != "") {



               if ($("#table_row_att").val() == 0) {

                   $("#error").html("Please enter at least one item");

               }



               $("#gallrey").html("")

               var addVal = tr.closest("tr").data('address');
               var locVal = tr.closest("tr").data('loc');
               tr.closest("tr").parent().parent().find("[data-oldaddress='" + addVal + "'][data-oldloc='" + locVal + "']").remove();
               // tr.closest("tr").html('test12');
               tr.closest("tr").remove();

               table_row_att = parseInt(table_row_att) - parseInt(1);

               $('#table_row_att').val(table_row_att);



               $("#result_message").fadeIn("slow").html("Item Deleted Successfully");

               setTimeout(function() {

                   $("#result_message").fadeOut("slow");

               }, 2000);
           
               var size = $(".attribute_data > tr").size();

               if (size == 0) {

                   $('.display-attribute').hide();

               } else {

                   $('.display-attribute').show();

               }

           } else {



               $("#result_error").fadeIn("slow").html("Something went wrong..");

               setTimeout(function() {

                   $("#result_error").fadeOut("slow");



               }, 2000);

           }

       }



   });

// });



   } else {

       return false;

   }

});



    // Signature plugin  code started

     var contract_sts = $('#contract_sts').val();
      if(contract_sts == 'yes') {
        var contract_status = true;
      }else {
        var contract_status = false;
      }
      // alert(contract_status);
    var option = {

        defaultAction: 'drawIt',

        drawOnly: true,

        lineTop: 70,

        lineMargin: 20,

        penColour: '#FFF'

    }





    $('#smoothed_attrony').signaturePad({

        drawOnly: true,

        drawBezierCurves: true,

        lineTop: 200,
        validateFields : false

    });



    // signature plugin end here





     // Signature plugin  code started

    var option = {

        defaultAction: 'drawIt',

        drawOnly: true,

        lineTop: 70,

        lineMargin: 20,

        penColour: '#FFF'

    }





    $('#smoothed_contact').signaturePad({

        drawOnly: true,

        drawBezierCurves: true,

        lineTop: 200,
        validateFields : contract_status

    });



    // signature plugin end here



     // Signature plugin  code started

    var option = {

        defaultAction: 'drawIt',

        drawOnly: true,

        lineTop: 70,

        lineMargin: 20,

        penColour: '#FFF'

    }





    $('#smoothed').signaturePad({

        drawOnly: true,

        drawBezierCurves: true,

        lineTop: 200

    });



    // signature plugin end here



     // Signature plugin  code started

    /*var option = {

        defaultAction: 'drawIt',

        drawOnly: true,

        lineTop: 70,

        lineMargin: 20,

        penColour: '#FFF'

    }





    $('#main').signaturePad({

        drawOnly: true,

        drawBezierCurves: true,

        lineTop: 200

    });*/



    $(document).delegate('#send_otp', 'click', function() {



        var email = $("#email").val();

        if (email != "") {

            $.ajax({

                url: hiddenurl + "Home_Controller/sendotp",

                method: "POST",

                data: {

                    email: email,

                },

                dataType: 'JSON',

                success: function(response) {



                    if (response.success != "" && response.otp != "") {



                        $("#otp_word").val(response.otp);

                        $("#send_otp").html("Resend Otp");



                        $("#result_message").fadeIn("slow").html("Otp Send Successfully");

                        setTimeout(function() {

                            $("#result_message").fadeOut("slow");



                        }, 2000);





                    } else {

                        $("#result_error_message").fadeIn("slow").html("Something Went Wrong.");

                        setTimeout(function() {

                            $("#result_error_message").fadeOut("slow");

                            // location.reload();

                        }, 2000);

                    }

                }

            });

        } else {

            $('#emai').parent().parent().parent().find('span.error').html('');

            $('#email').parent().find('span.error').html('Please Enter Email to get OTP');

            $('#email').focus();

            return false;

        }



    });



   // Duplicate order disable link
    // get page url on load

/* $(document).ready(function(){
    // $(".cpy-order").click(function(){

        var pageURL = $(location).attr("href");
        var dis = "duplicate_order";
        // console.log(pageURL.indexOf(dis) != -1);
        if(pageURL.indexOf(dis) != -1){
            console.log("fdg");
            $('a').css('pointer-events','none');
            $('a').css('cursor','wait');

         // $(".disaable").addClass("overlay");
    }
    // });
});*/

// Contract on off for user

     $(document).delegate('.contract_req', 'click', function(event) {

        var contract_val = $(this).val();
        var userid = $(this).data('userid');
        console.log(contract_val);
        // alert(contract_val);

        if (contract_val != "") {

            $.ajax({

                url: hiddenurl + "Dashboard_Controller/update_user_contract",

                method: "POST",

                data: {

                    'contract_val': contract_val,
                    'userid': userid
                },

                dataType: 'JSON',

                success: function(response) {



                    if (response.success != "") {



                        $("#result_message").fadeIn("slow").html("Status Update Successfully");

                        setTimeout(function() {

                            $("#result_message").fadeOut("slow");



                        }, 2000);

                    } else {

                        $("#result_error_message").fadeIn("slow").html("Something Went Wrong.");

                        setTimeout(function() {

                            $("#result_error_message").fadeOut("slow");

                        }, 2000);

                        // location.reload();

                    }

                }



            });

        }



    });

    //datatable view order

    var table = $("#order_table").DataTable({
        "serverSide": true,

        "ajax": {
            // "data": {"sts": get_id},
            "url": hiddenurl + 'Dashboard_Controller/loadorder',
             "data": function(d) {
                console.log($('#order_table').data('dt_params'));
                return $.extend(d, $('#order_table').data('dt_params'));
            },
        },

        "language": {

            "infoFiltered": "",

        },

        "columnDefs": [{

            "targets": [5],

            "orderable": false,

        }],

    });

// $(document).ready(function(){
//     // Redraw the table
//     table.draw();

    // Redraw the table based on the custom input
    $('#sortBy').bind("keyup change", function(){
        // alert($(this).val());
        var get_id = $(this).val();
        table.draw(get_id);
    });
// });

$('#sortBy').on('change', function(){
        // Set dynamic parameters for the data table
        let drop_id = $(this).val();
        drop_id = (drop_id.length > 0) ? drop_id : -1;
        /*if(drop_id.length > 0) {
            drop_id = $(this).val()
        }*/
        // console.log(drop_id)
        $("#order_table").data('dt_params', { order_status: drop_id });
        // Redraw data table, causes data to be reloaded
        $("#order_table").DataTable().draw();
    });

// filter by year
$('#sortby_year').on('change', function(){
        // Set dynamic parameters for the data table
        let year = $(this).val();
        year = (year.length > 0) ? year : -1;
        // console.log(drop_id)
        $("#order_table").data('dt_params', { order_year: year });
        // Redraw data table, causes data to be reloaded
        $("#order_table").DataTable().draw();
    });

    //update order status ajax

    $(document).delegate('.status', 'change', function(event) {

        var id = $(this).attr('id');

        var dd = $(this).val();

        if (dd != "") {

            $.ajax({

                url: hiddenurl + "Dashboard_Controller/updatestatus",

                method: "POST",

                data: {

                    'order_id': id,

                    'status': dd

                },

                dataType: 'JSON',

                success: function(response) {



                    if (response.success != "") {



                        $("#result_message").fadeIn("slow").html("Status Update Successfully");

                        setTimeout(function() {

                            $("#result_message").fadeOut("slow");



                        }, 2000);



                        // location.reload();



                    } else {

                        $("#result_error_message").fadeIn("slow").html("Something Went Wrong.");

                        setTimeout(function() {

                            $("#result_error_message").fadeOut("slow");

                        }, 2000);

                        // location.reload();

                    }

                }



            });

        }



    });



    // Duplicate order

  /*    $( document ).ready(function() {

        alert("sd");

    var status = 0;

    $('.display-attribute tr').each(function(index, tr) {

// // $('table > tbody  > tr').each(function(index, tr) {

       console.log(index);

       console.log(tr);

       console.log($(tr).find('td:eq(0)').text());

//        var location_new = $(tr).find('td:eq(0)').text();

//        return json_encode(location_new);

//     //    if(location == item_location){

//     //     status = 1;

//     // }

})

})

*/
// // dupicate
// $(document).click(function() {
// 	$(".portlet-title").click(function(e) {
//     	alert("me");
// 	});
// 	var pageURL = $(location).attr("href");
// 	// console.log(pageURL);
//     var dis = "duplicate_order";
//     if((pageURL.indexOf(dis) != -1)){

//     	$('button').click(function(event, wasTriggered) {
//     if (wasTriggered) {
//         alert('triggered in code');
//     } else {
//         alert('triggered by mouse');
//     }
// });

// $('button').trigger('click', true);
//     }

// });


    //reset preview image oreder creation

    $(document).delegate('#place_order_reset_btn', 'click', function(event) {

        $("#gallrey").html("");

    });



    //word wrap list oreder

    function wordwrap(str, width, brk, cut) {

        brk = brk || '\n';

        width = width || 75;

        cut = cut || false;



        if (!str) { return str; }



        var regex = '.{1,' + width + '}(\\s|$)' + (cut ? '|.{' + width + '}|.+$' : '|\\S+?(\\s|$)');



        return str.match(RegExp(regex, 'g')).join(brk);

    }



});

//    $("#add_items").on('click',function() {
// });
