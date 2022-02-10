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
        var third_split = head.split('loc"')
        if ($.isArray(third_split)) {
            var forth_split = third_split[1].split('" data-address')
            address_slug = forth_split[0]
        }
    }

	if ($.type(tr_object) == 'objecct') {
        tr_object.find('tr').each(function(index, element){
            var address_data = $(element).attr('data-address')
            var location_data = $(element).attr('data-loc')
            if (address_data == address_slug && location_data == location_slug && !checkbox_selection) {
                $(tr).after(body)
            }
            if (remove_tr) {
                $(element).remove();
            }
        })
        if (!checkbox_selection) {
            tr.object.append(head)
            tr.object.append(body)
        }
        if (checkbox_selection) {
            tr_object.append('<tr><td colspan="4" data-ent="' + checkbox_selection + '">Enitre Location</td></tr>')
        }
    }
}


    //add item and create table in
$(document).delegate('.add_attribute', 'click', function() {
         // $('.display-attribute tr').each(function(tr){

           /* $('.display-attribute tr').each(function(index, tr) {

         // $('table > tbody  > tr').each(function(index, tr) {

                           console.log(index);

                           console.log(tr);

                        });*/

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
        } else{
            html_location_type = '';
        }
        var item_address_slug = convertToSlug($.trim(item_address));
        var location = $('#request_location').val();

        if($('.ent-loc:checked').val() == 1) {
        	var chk = true;
        } else {
        	var chk = false;
        }

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



        // if(request_title != "" && location != "") {

        if ((item_name != "") || (item_select != '') && (item_price != "") && (item_quantity != "")  && (item_quantity > 0) && (item_price > 0) && (item_location != "")) {


            if (gallery_photo_add.files) {

                // alert

                var filesAmount = gallery_photo_add.files.length;

                // console.log(gallery_photo_add.files);



                for (i = 0; i < filesAmount; i++) {

                    var type = files[i].type.split('/').pop().toLowerCase();

                    // console.log(type);



                    return;

                    var reader = new FileReader();

                    reader.onload = function(event) {

                        result += ($.parseHTML('<img class="prev"  style="height:70px; width:70px;" alt="No Image">')).attr('src', event.target.files[i]);

                    }

                    reader.readAsDataURL(gallery_photo_add.files[i]);

                }

            }



            // handling insert item in database

            var form = $('#add_item_detail_form')[0];

            var formData = new FormData(form);

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

                            console.log(response);
                            placetrdata($('.attribute_data'), response.head, response.body);


                    if (response.success != "" && response.item_id != "") {



                        var item_id = response.item_name;
                        var itemname = ((item_name != '')) ? item_name : item_select;

                        // var gallrey_final = '';
                        var gallrey_final = gallrey.replace('<div class=""', '"');

                        table_row_att = parseInt(table_row_att) + parseInt(1);


                        // alert((parseFloat(item_price)).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,'));

                        var status = 0;

                      // $('.display-attribute tr').each(function(index, tr) {
         // $('table > tbody  > tr').each(function(index, tr) {

                           $('.attribute_data tr').each(function(index, tr) {
						    if($(tr).hasClass('old_location')) {
						        var tet = $(tr).find('td:eq(0)').text();
						        var data_address = $(tr).data('address');
						        var data_loc = $(tr).data('loc');
						        var arr = tet.split(':');
						        var location_type = arr[2];
						        var ad_text = arr[1].split('Location Type');
						        var address = ad_text[0].replace(/\s/g,  "-");//$.trim(ad_text[0]);
						        // console.log(location_type);
						        console.log("dta-adress",index,data_address,item_address_slug,data_address == item_address_slug,data_loc,location_type,item_location_type,data_loc == item_location_type);
						        // console.log(item_address_slug);
						    }

						// });
                           //console.log($(tr).find('td:eq(0)').text());

                           /*var location = $(tr).find('td:eq(0)').text();
                           var type = $(".locaton_type").text();
                           var ltype = type.split(':');
                            // console.log(ltype[1]);
                                $('tr td:nth-child(1) span').each(function(){
                                  var itm_cat = this.textContent;
                                  console.log(itm_cat);
                                });
                           //location = 'Location '+location;



                            var location = location.replace("Location ", "");*/

                           // console.log(location_type == item_location_type);
                           // console.log(data_address == item_address_slug);

                           if((data_loc == item_location_type) && (data_address == item_address_slug) && !chk){
                            status = 1;

                            // $("#temp_"+ltype[1]).after("<h1>HELO</h1>");
                            $(tr).after('<tr id="' + table_row_att + '"><td width="" style="text-align:center"><div class="form-group form-md-line-input form-md-floating-label"><p class="itm-name">' + itemname + '</p><input type="hidden" class="form-control item_name" name="item_name1[]" id="item_name_' + table_row_att + '" value="' + itemname + '"  /> <input type="hidden" name="item_ids[]" value="' + response.item_id + '"/></div></td><td  width="" style="text-align:center"><div class="form-group form-md-line-input form-md-floating-label"><p class="itm-price">$ ' + (parseFloat(item_price)).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + '</p><input type="hidden" class="form-control atribute_value" name="item_price1[]" id="item_price_' + table_row_att + '" value="' + item_price + '" readonly/></div></td><td  width="" style="text-align:center"><div class="form-group form-md-line-input form-md-floating-label"><p class="itm-qty">' + item_quantity + '</p><input type="hidden" class="form-control atribute_value" name="item_quantity1[]" id="item_quantity_' + table_row_att + '" value="' + item_quantity + '" readonly/></div></td><td  width="" style="text-align:center">' + gallrey_final + '</td><td  width="" style="text-align:center"><div id="get_location"  class="form-group form-md-line-input form-md-floating-label"><p class="itm-location">' + item_location + '</p><input type="hidden" class="form-control atribute_value" name="item_location1[]" id="item_location_' + table_row_att + '" value="' + item_location + '" readonly/></div></td><td style="text-align:center"><span class="remove_attribute" id="' + response.item_id + '"><i class="fa fa-minus-circle"></i></span><span class="edit_attribute" data-id="' + response.item_id + '"><i class="fa fa-pencil" aria-hidden="true"></i></span></td></tr>');

                           }

                        });


                        $("#table_row_att").val(table_row_att);

                        $("#error").html(" ");

                        $("tbody.attribute_data").append(response.item);

                        if(status == 0 && !chk){

                        $("tbody.attribute_data").append('<tr id="temp_'+ item_location_type +'" class="old_location" data-loc="'+item_location_type+'" data-address="'+item_address_slug +'"><td class="panel-heading" colspan="7"><span class="category">Address: '+  $.trim(item_address) +'</span><span class="locaton_type">Location Type:'+ html_location_type +'</span></td></tr><tr id="' + table_row_att + '"><td width="" style="text-align:center"><div class="form-group form-md-line-input form-md-floating-label"><p class="itm-name">' + itemname + '</p><input type="hidden" class="form-control item_name" name="item_name1[]" id="item_name_' + table_row_att + '" value="' + itemname + '"  /> <input type="hidden" name="item_ids[]" value="' + response.item_id + '"/></div></td><td  width="" style="text-align:center"><div class="form-group form-md-line-input form-md-floating-label"><p class="itm-price">$ ' + (parseFloat(item_price)).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,') + '</p><input type="hidden" class="form-control atribute_value" name="item_price1[]" id="item_price_' + table_row_att + '" value="' + item_price + '" readonly/></div></td><td  width="" style="text-align:center"><div class="form-group form-md-line-input form-md-floating-label"><p class="itm-qty">' + item_quantity + '</p><input type="hidden" class="form-control atribute_value" name="item_quantity1[]" id="item_quantity_' + table_row_att + '" value="' + item_quantity + '" readonly/></div></td><td  width="" style="text-align:center">' + gallrey_final + '</td><td  width="" style="text-align:center"><div id="get_location" class="form-group form-md-line-input form-md-floating-label"><p class="itm-location">' + item_location + '</p><input type="hidden" class="form-control atribute_value" name="item_location1[]" id="item_location_' + table_row_att + '" value="' + item_location + '" readonly/></div></td><td style="text-align:center"><span class="remove_attribute" id="' + response.item_id + '"><i class="fa fa-minus-circle"></i></span><span class="edit_attribute" data-id="' + response.item_id + '"><i class="fa fa-pencil" aria-hidden="true"></i></span></td></tr>');

                    } else if (chk){
                    	$("tbody.attribute_data").append('<tr><td colspan="4" data-ent="'+chk+'">Enitre Location</td></tr>');
                    }






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



                    }

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



        } else {

            // alert("Please Enter all the value");
             // $("#error_item_all").show();

        }

    // } else { alert("Please Enter Order Details");    }

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

        // debugger;

        $("#exampleModal").modal('show');

        var item_id = $(this).data('id');
        console.log(item_id);

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

                // copyitem_id: newitem_id,

                // newimage_id: newimage_id

            },



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