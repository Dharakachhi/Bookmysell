$(document).ready(function() {

     

    var hiddenurl = $('#hiddenURL').val();

    var url_email = hiddenurl+"Home_Controller/check_duplicate_email";





     // Registration form validation    

	$("#registrationform").validate({

 		rules: {

            name: "required",

            email: {

                required: true,

                 remote: {

                    url: url_email,

                    type: "post"

                },

                email: true

            },

            password: {

                required: true,

                minlength: 6

            },

            confirm_password: {

                required: true,

                minlength: 6,

                equalTo: '#password'

            },

            captcha :{

                required : true,

                equalTo :'#captcha_word',

            },

             otp:{

                required: true,

                equalTo: '#otp_word'

            },

            phone: {

                required : true,

                digits: true,

                minlength: 10,

                maxlength: 15



            }

        },

        messages: {

            name: "Please Enter Your Name",

            

            email: {

                required: "Please enter Email",

                remote: "Email already exists!"

            },

            password: {

                required: "Please enter Password",

                minlength: "Your password must be at least 6 characters long"

            },

            captcha:{

                required : "Please Enter Captcha",

                equalTo : "Captcha Wrong"

            },

            confirm_password: {

                required: "Please enter Confirm Password",

                minlength: "Your confirm password must be at least 6 characters long",

                equalTo: "Password Not mach!"

            },

            otp: {

                required: "Please enter Otp",

                equalTo: " Otp is not Matching.. !!"

            },

            phone: {

                required : "Please enter Phone Number",

                digits: "Please enter Valid Phone Number",

                minlength : "Please enter Valid Phone Number"

            }

        },

        submitHandler: function(form) {

          form.submit();

          // $("#accountbtn").attr("disabled", true);

        }

    });	



    //reset form validatoins

    $("#reset_pwd_form").validate({

        rules:{

            password:{

                 required: true,

                minlength: 6

            }

             

        },

        messages:{

            password: {

                required: "Please enter Password",

                minlength: "Your password must be at least 6 characters long"

            }

        },

    });



    $("#loginform").validate({

        rules: {

            email: {

                required: true, 

            },

            password: {

                required: true,

                minlength: 6

            },

        },

        messages: {       

            email: {

                required: "Please enter Email", 

            },

            password: {

                required: "Please enter Password",

                minlength: "Your password must be at least 6 characters long"

            },

        },

        submitHandler: function(form) {

            // return event.key != "Enter";

            form.submit();

          // $("#accountbtn").attr("disabled", true);

        }

 }); 



    // login page back button code

    $("#register-back-btn").click(function(event) {

     window.location.href = hiddenurl + "login";

 });



// if user contract status yes check using method and call in validate function

var contract_sts = $('#contract_sts').val();
$.validator.addMethod("conrtact", function(value, element) {
  if(contract_sts == 'yes' && value != '1'){
    return false;
  } else{
    return true;
  }

}, "This Field is required");


// location validation rule
var item_location_type = $('#item_location_type').val();
 $.validator.addMethod("valueNotEquals", function(value, element, arg){
  return item_location_type !== value;
 });
 // end validation rule 

    //if user not add 1 item validation

   $("#add_item_detail_form").validate({

    ignore: "",

        rules: {

            requesttitle:{

                required :true,

                minlength : 5,

                maxlength: 55

            },

            location: {

                required: true,

                // minlength : 2,

                // maxlength : 30



            },

            
             phone: {

                required: true,

                minlength : 10,

                // maxlength : 30

            },

             contact_chk: {

                conrtact: true

            },



            // attrny_chk: {

            //     required: true

            // },

            item_location_type: {
                valueNotEquals: "default"
            },

            item_category: {
                required: true
            },

          /*  item_name:{

                required: function(element) {

                    if ($("#table_row_att").val()==0) {

                        return true;

                    } else {

                        return false;

                    }

                },

            },

            item_price:{

                required: function(element) {

                    if ($("#table_row_att").val()==0) {

                        return true;

                    } else {

                        return false;

                    }

                },

                min:1,



            },

            item_quantity:{

                required: function(element) {

                    if ($("#table_row_att").val()==0) {

                        return true;

                    } else {

                        return false;

                    }

                },

                min:1,



            },

            item_description:{

                required: function(element) {

                    if ($("#table_row_att").val()==0) {

                        return true;

                    } else {

                        return false;

                    }

                },

            },

            item_location:{

                required: function(element) {

                    if ($("#table_row_att").val()==0) {

                        return true;

                    } else {

                        return false;

                    }

                },

            },*/

        },

        messages: {

            requesttitle: {

                required  : "Please Enter Title Of Order",

                minlength : "Title must be at least 5 character long"

            },

            

            location: {

                required: "Please enter Location",

                // minlength: "Location atleast 2 character long"

            },

            phone: {

                required: "Please enter Phone Number",

                minlength: "Phone Number atleast 10 Digit"

            },

            

            

        },

        submitHandler: function(form) {

                //console.log($("#table_row_att").val());

                

            /*if ($("#table_row_att").val()==0){



             $("button[name=additems]").focus();

             $("#error").html("Please enter at least one item");



                  $("#result_error_message").fadeIn("slow").html("Please enter at least one item");

                    setTimeout(function() {

                        $("#result_error_message").fadeOut("slow");

                        

                    }, 2000); 



                return false;

            }

            else

            {*/

                form.submit();

           /* }*/

        },

 });



   // Copy above script for validation in new order 

   $("#new_order_form").validate({

    ignore: "",

        rules: {

            requesttitle:{

                required :true,

                minlength : 5,

                maxlength: 55

            },

            location: {

                required: true,

                // minlength : 2,

                // maxlength : 30



            },


             phone: {

                required: true,

                minlength : 10,

                // maxlength : 30

            },

            

            contact_chk: {

                conrtact: true

            },



            /*attrny_chk: {

                conrtact: true

            },*/

          

          /*  item_name:{

                required: function(element) {

                    if ($("#table_row_att").val()==0) {

                        return true;

                    } else {

                        return false;

                    }

                },

            },

            item_price:{

                required: function(element) {

                    if ($("#table_row_att").val()==0) {

                        return true;

                    } else {

                        return false;

                    }

                },

                min:1,



            },

            item_quantity:{

                required: function(element) {

                    if ($("#table_row_att").val()==0) {

                        return true;

                    } else {

                        return false;

                    }

                },

                min:1,



            },

            item_description:{

                required: function(element) {

                    if ($("#table_row_att").val()==0) {

                        return true;

                    } else {

                        return false;

                    }

                },

                maxlength:100,

            },

             item_location:{

                required: function(element) {

                    if ($("#table_row_att").val()==0) {

                        return true;

                    } else {

                        return false;

                    }

                },

            },
*/
        },

        resetForm: function() {

            if ( $.fn.resetForm )

                $( this.currentForm ).resetForm();

            this.submitted = {};

            this.prepareForm();

            this.hideErrors();

            this.elements().removeClass( this.settings.errorClass );

        },

        messages: {

            requesttitle: {

                required  : "Please Enter Title Of Order",

                minlength : "Title must be at least 5 character long"

            },

            

            location: {

                required: "Please Enter Location",

                // minlength: "Location atleast 2 character long"

            },


            location: {

                required: "Please Enter Phone Number",

                minlength: "Phone Number atleast 10 Digits"

            },

            

            

        },

        submitHandler: function(form) {

                console.log($("#table_row_att").val());

                

           /* if ($("#table_row_att").val()==0){



             $("button[name=additems]").focus();

             $("#error").html("Please enter at least one item");



                  $("#result_error_message").fadeIn("slow").html("Please enter at least one item");

                    setTimeout(function() {

                        $("#result_error_message").fadeOut("slow");

                        

                    }, 2000); 



                return false;

            }

            else

            {*/

                form.submit();

            // }

        }

 });




   // cancel button remove jquery msg

   $('#place_order_reset_btn').click(function() {

        $(".error").empty();

        var canvas = document.getElementById('main_can');

        var context = canvas.getContext('2d');

        context.clearRect(0, 0, canvas.width, canvas.height);



        var c2 = document.getElementById("attrony_can");

        var ctx2 = c2.getContext("2d");

        ctx2.clearRect(0, 0, c2.width, c2.height);



        var c3 = document.getElementById("contact_can");

        var ctx3 = c3.getContext("2d");

        ctx3.clearRect(0, 0, c3.width, c3.height);

       /* ctx2.beginPath();

        ctx2.arc(100,75,50,1.7*Math.PI,-0.1*Math.PI);

        ctx2.lineWidth = 15;

        ctx2.strokeStyle = "#a9a9a9";

        ctx2.stroke();*/

     });

   // add item validation on button click
   // checkbox validation 
     $( "#item_cat" ).keyup(function() {
       if($(this).val().length >= 1) {
         $("#error_item_address").hide();
          $("#error_item_all").hide();
          $('#add_items').prop('disabled', false);
        } else {
             $("#error_item_all").show();
              $('#add_items').prop('disabled', true);
        }
    });
   $( "#item_location_type" ).change(function() {
         if($('#item_location_type').find(":selected").text() != 'default') {
            $("#error_item_location").hide();
            $("#error_item_all").hide();
            $('#add_items').prop('disabled', false);
        } else {
             $("#error_item_all").show();
              $('#add_items').prop('disabled', true);
        }
    });
   $("#item_name,#item_select").on('keyup change', function (){
        if($('#item_name').val().length >= 1 || $('#item_select').val().length >= 1) {
         $("#error_item_name").hide();
          $("#error_item_all").hide();
          $('#add_items').prop('disabled', false);
        } else {
             $("#error_item_all").show();
              $('#add_items').prop('disabled', true);
        }
    });
     $( "#item_price" ).keyup(function() {
         if($(this).val().length >= 1) {
           $("#error_item_price").hide();
            $("#error_item_all").hide();
            $('#add_items').prop('disabled', false);
        } else {
             $("#error_item_all").show();
              $('#add_items').prop('disabled', true);
        }
    });
      $( "#item_location" ).keyup(function() {
        if($(this).val().length >= 1) {
            $("#error_location").hide();
             $("#error_item_all").hide();
             $('#add_items').prop('disabled', false);
        } else {
             $("#error_item_all").show();
              $('#add_items').prop('disabled', true);
        }
    });
       $( "#item_quantity" ).keyup(function() {
         if($(this).val().length >= 1) {
           $("#error_item_qty").hide();
            $("#error_item_all").hide();
            $('#add_items').prop('disabled', false);
        } else {
             $("#error_item_all").show();
              $('#add_items').prop('disabled', true);
        }
    });
       /* $( "#item_description" ).keyup(function() {
            if($(this).val().length >= 1) {
               $("#error_item_desc").hide();
                $("#error_item_all").hide();
                $('#add_items').prop('disabled', false);
            } else {
             $("#error_item_all").show();
              $('#add_items').prop('disabled', true);
        }

            // $('#add_items').prop('disabled', false);
    });*/
       $("#add_items,#add_items_edit").on('keyup change click', function (){
      if ($('input#item_name').val() == ""  &&  $('input#item_price').val() == ""  &&  $('input#item_location').val() == ""  &&  $('input#item_quantity').val() == ""  ||  $('input#item_description').val() == ""){
            $("#error_item_all").show();
             $("#error_item_address").show();
         $("#error_item_location").show();
         $("#error_item_name").show();
         $("#error_item_price").show();
        $("#error_location").show();
         $("#error_item_qty").show();
         $("#error_item_desc").show();
          $('#add_items').prop('disabled', true);
      } else if($('input#item_name').val() == "" || $('input#item_select').val() == ""){
         if($('#item_name').val().length >= 1 || $('#item_select').val().length >= 1) {
         $("#error_item_name").hide();
          $("#error_item_all").hide();
          $('#add_items').prop('disabled', false);
      }
    }else if($('input#item_price').val() == "") {
         if($(this).val().length >= 1) {
           $("#error_item_price").hide();
            $("#error_item_all").hide();
            $('#add_items').prop('disabled', false);
        } 
    } else if($('input#item_location').val() == ""){
         if($(this).val().length >= 1) {
            $("#error_location").hide();
             $("#error_item_all").hide();
             $('#add_items').prop('disabled', false);
        } 
    } else {
        if($(this).val().length >= 1) {
           $("#error_item_qty").hide();
            $("#error_item_all").hide();
            $('#add_items').prop('disabled', false);
        } 
    } 
   /* else {
         if($(this).val().length >= 1) {
               $("#error_item_desc").hide();
                $("#error_item_all").hide();
                $('#add_items').prop('disabled', false);
            } 
    }*/
  });


   // checkbox validation
   /*  $("#bitn-submit").click(function () {
                var checked = $("#add_item_detail_form input[type=checkbox]:checked").length;
                var chk2 = $("#defaultCheck2 input[type=checkbox]:checked").length;
                var chk = $("#defaultCheck1 input[type=checkbox]:checked").length;
                var isChecked = chk2 > 0;
                var isChecked2 = chk > 0;
                if (isChecked && isChecked2) {
                    var selectedHobbies = $("#defaultCheck2 input[type=checkbox]:checked").val();
                    // alert("your hobbies is " + selectedHobbies);
                      $("#errortoshow").hide();
                      $("#errortochk").hide();
                       // $('#bitn-submit').prop('disabled', false);
                }
                else {
                    // error.appendTo("#errortoshow");
                    $("#errortoshow").show();
                    $("#errortochk").show();
                   // $("#result_error_message").fadeIn("slow").html("Please Select Checkbox");
                   //  setTimeout(function() {
                   //      $("#result_error_message").fadeOut("slow");
                        
                   //  }, 2000);
                     // $('#bitn-submit').prop('disabled', true);
                }
            });
            $("#defaultCheck1").click(function() {
            var chk = $(this).length;
            if(chk > 0) {
                  $("#errortoshow").hide();
            }
            // alert(chk);
        });
            $("#defaultCheck2").click(function() {
            var chk = $(this).length;
            if(chk > 0) {
                  $("#errortochk").hide();
            }
            // alert(chk);
        });
        // });*/

})