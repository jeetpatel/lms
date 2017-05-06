(function(window){

    'use strict';

    var // Localise globals
        document = window.document,
        $ = window.$,
        ADMIN = window.ADMIN = window.ADMIN || {'base_url' : $("base").attr('href')};


        ADMIN.createAppointment = {

                bindEvents : function(){
                    $(document).off('change.subtest').on('change.subtest', '#subtest', function(event) {
                            console.log($(this).val());
                            if($(this).val()){

                                var url = ADMIN.base_url+'admin/subtest/getSubTestPrice';
                                CIS.Ajax.request(url,{
                                    type : 'POST',
                                    context : this,
                                    data : {id: $(this).val(), 'csrf_test_name' : $.cookie("csrf_cookie_name")},
                                    beforeSend : function(){
                                        $(this).find('[type="submit"]').addClass('disabled');
                                    },
                                    success : function(data){
                                        if(data.status == "SUCCESS"){

                                            $('#test_price').val(parseFloat(data.test_price));
                                            $('#total_price').val(parseFloat(data.final_price));
                                            calculateDiscount();
                                        }
                                    },
                                    complete : function(){
                                        $(this).find('[type="submit"]').removeClass('disabled');
                                        calculateDiscount();
                                    }
                                });

                            }else{
                                    $('#test_price').val(0);
                                    $('#discount').val(0);
                                    $('#total_price').val(0);
                            }   
                            
                    });
                    
                    $(document).off('change.test').on('change.test', '#test', function(event) {
                            
                            if($(this).val()){
                                var url = ADMIN.base_url+'admin/subtest/getSubTest';
                                CIS.Ajax.request(url,{
                                    type : 'POST',
                                    context : this,
                                    dataType : 'HTML',
                                    data : {'test_id' : $(this).val(), 'csrf_test_name' : $.cookie("csrf_cookie_name")},
                                    beforeSend : function(){
                                        $(this).find('[type="submit"]').addClass('disabled');
                                    },
                                    success : function(data){
                                        $("#subtest").html(data);
                                    },
                                    complete : function(){
                                        $(this).find('[type="submit"]').removeClass('disabled');
                                    }
                                });

                            }else{
                                    $("#subtest").html('<option value="">SELECT SUBTEST</option>');
                            }   
                            
                    });


                    $(document).on('focusout.discount', '#discount', function(event) {
                        calculateDiscount();    
                    });

                    $('#sample_collection_time').ptTimeSelect();

                    $(document).off('change.doctor_ref_by').on('change.doctor_ref_by', '#doctor_ref_by', function(event) {
                        if($(this).val() == "others"){
                            $(this).attr('name','');
                            $("#other_doctor_ref_by").removeClass('hide');
                            $("#other_doctor_ref_by").attr('name','doctor_ref_by');
                        }else{
                            $(this).attr('name','doctor_ref_by');
                            $("#other_doctor_ref_by").addClass('hide');
                            $("#other_doctor_ref_by").attr('name','');
                        }
                    });

                },
                init : function(){
                    this.bindEvents();
                }

        }


        ADMIN.uploadReportsForm = {
            bindEvents : function(){
                $(document).off('click.uploadReportsForm').on('click.uploadReportsForm', '.uploadReportsForm', function(event) {
                        event.preventDefault();
                        CIS.Ajax.request($(this).attr('href'),{
                                    type : 'POST',
                                    context : this,
                                    data : {'refno' : $(this).data('refno'), 'csrf_test_name' : $.cookie("csrf_cookie_name")},
                                });
                });
            },
            init : function(){
                this.bindEvents();
            }
        }


        ADMIN.uploadReports = {
            bindEvents : function(){

                $(document).off('submit.sendReport').on('submit.sendReport', 'form[name="uploadreports_form"]', function(event) {
                    event.preventDefault();
                    
                    //grab all form data  
                    var formData = new FormData($(this)[0]);

                    CIS.Ajax.request($(this).attr('action'),{
                                    type : 'POST',
                                    dataType : 'JSON',
                                    context : this,
                                    data : formData,
                                    async : true,
                                    processData: false,
                                    contentType: false,
                                    beforeSend : function(){
                                        $(this).find('[type="submit"]').addClass('disabled');
                                        $('body').overlay();
                                    },
                                    success : function(data){

                                        if(data.status == "SUCCESS"){
                                            var ref = "tr#"+data.ref_no;
                                            $( ref+" td:nth-child(7)").html('<span class="label label-success">Generated</span>');
                                        }

                                        if(data.has_mail_id == "yes"){
                                            var ref = "tr#"+data.ref_no;
                                            $(ref+' td:last-child span').html(" | <a href='admin/appointments/sendMail' class='sendmail' data-refno='"+data.ref_no+"'>Send Mail</a>");
                                        }

                                        $("#mes").html(data.mes);
                                        $("#send_mail_mes").html(data.send_mail_mes);
                                        
                                    },
                                    complete : function(){
                                        $(this).find('[type="submit"]').removeClass('disabled');
                                        this.reset();
                                        $.overlayout();
                                    }
                                });
                });
            },
            init : function(){
                this.bindEvents();
            }   
        }

        ADMIN.sendMail = {
            bindEvents : function(){
                $(document).off('click.sendmail').on('click.sendmail', '.sendmail', function(event) {
                    event.preventDefault();
                    
                    CIS.Ajax.request($(this).attr('href'),{
                                    type : 'POST',
                                    dataType : 'JSON',
                                    context : this,
                                    data : {'ref_no' : $(this).data('refno'), 'csrf_test_name' : $.cookie("csrf_cookie_name")},
                                    async : true,
                                    beforeSend : function(){
                                        $('body').overlay();
                                    },
                                    success : function(data){
                                        $("#message_wrapper").html(data.mail_status_mes);
                                    },
                                    complete : function(){
                                        $.overlayout();
                                    }
                    });

                });
            },
            init : function(){
                this.bindEvents();
            }
        }

        ADMIN.getAppointmentsByDate = {
            bindEvents : function(){
                $("#from_date").datepicker({
                    format: "yyyy-mm-dd",
                    autoclose: true,
                    todayHighlight: true
                });

                $("#to_date").datepicker({
                    format: "yyyy-mm-dd",
                    autoclose: true,
                    todayHighlight: true
                });
            },
            init : function(){
                this.bindEvents();
            }
        }


        ADMIN.reports = {

            bindEvents : function(){
                    var dt = JSON.parse(appointmentsData);  
                    var ft = JSON.parse(financeData);  
                    
                    var donut = new Morris.Donut({
                      element: 'appointments-chart',
                      resize: true,
                      colors: ["#00A65A", "#00C0EF", "#f56954", "#F39C12"],
                       data: [
                            {'label': "Generated Appointments", 'value': dt.generated_appointments},
                            {'label': "Pending Appointments", 'value': dt.pending_appointments},
                            {'label': "Cancelled Appointments", 'value': dt.cancelled_appointments},
                            {'label': "Inprogress Appointments", 'value': dt.inprogress_appointments}
                          ],
                      hideHover: 'auto'
                    });

                    

                    var donut = new Morris.Donut({
                      element: 'finance-chart',
                      resize: true,
                      colors: ["#00A65A", "#f56954"],
                      data: [
                        {'label': "Received Amount", 'value': ft.received_amount},
                        {'label': "Pending Amount", 'value': ft.pending_amount}
                      ],
                      hideHover: 'auto'
                    });


            },
            init : function(){
                this.bindEvents();     
            }
        }


        ADMIN.createTest = {
            bindEvents : function(){
                $(document).off('focusout.test_name').on('focusout.test_name', '#test_name', function(event) {
                    event.preventDefault();
                    
                    if($(this).val()){
                        CIS.Ajax.request('admin/tests/checkTestExists',{
                            type : 'POST',
                            dataType : 'JSON',
                            context : this,
                            data : {'test_name' : $(this).val(), 'csrf_test_name' : $.cookie("csrf_cookie_name")},
                            async : true,
                            beforeSend : function(){
                                $('body').overlay();
                            },
                            success : function(data){
                                if(data.call_status == "SUCCESS"){
                                    
                                }else{
                                    alert(data.mes);
                                    $(this).val('');
                                }   
                            },
                            complete : function(){
                                $.overlayout();
                            }
                        });    
                    }
                    

                });
            },
            init : function(){
                this.bindEvents();
            }
        }

})(window);
$('document').ready(function(){

    (function( $ ){
      $.fn.investPage = function() {    
            $('#payment_status').change(function() {    
      var selectValp = $('#payment_status :selected').val();
      if(selectValp !='')
      {
         $(".btn-danger").attr("disabled","disabled");
      }
     });
    $('#appointment_status').change(function() {    
     var selectVala = $('#appointment_status :selected').val();
     
   }); 
            
      };
})( jQuery );
   
var page = $.fn.investPage();

//Add More sub test
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID
    
    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
           
        var moreFields = '<div class="row subtest_row">';
        moreFields+='<div class="col-md-6">';
        moreFields+='<div class="form-group">';
        moreFields+='<input type="text" placeholder="Sub Test Name" class="form-control" maxlength="50" name="subtest_name[]">';
        moreFields+='</div>';
        moreFields+='</div>';
        moreFields+='<div class="col-md-4">';
        moreFields+='<div class="form-group">';
        moreFields+='<input type="number" placeholder="Sub Test Price" class="form-control" maxlength="6" max="500000" name="subtest_price[]">';
        moreFields+='</div>';
        moreFields+='</div>';
        moreFields+='<div class="col-md-2">';
        moreFields+='<div class="form-group">';
        moreFields+='<a href="javascript:void(0)" class="remove_field">Remove</a></div>';
        moreFields+='</div>';
        moreFields+='</div>';
        moreFields+='</div>';
        $(wrapper).append(moreFields); //add input box
        x++; //text box increment
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); 
        $(this).parents(".subtest_row").remove(); x--;
    })
    
});
/**
 * Calculate Discount
 * @returns {undefined}
 */
function calculateDiscount() {
    var discountPercent = $("#discount").val();
    discountPercent = parseFloat(discountPercent);
    if (discountPercent<0 || isNaN(discountPercent)==true)
        discountPercent = 0;
    var lastChar = $('#sing').val();
    if(lastChar == '%'){
    var price = parseFloat($('#test_price').val());
    
    if(discountPercent && discountPercent <= 100){
        var discount_price = (discountPercent/100)*price,
        total_price = price-parseFloat(discount_price);
        $('#discount_price').val((discount_price).toFixed(2));
        $('#total_price').val((total_price).toFixed(2));

    }else{
        $('#discount_price').val('');
        $('#discount').val('');
        $('#total_price').val((price).toFixed(2));
    }
    }
    else
    {
        var priceRs = parseFloat($('#test_price').val());
        var disRs= (discountPercent/priceRs)*100;
        var totalRs = priceRs-discountPercent;
        $('#discount_price').val((disRs).toFixed(2) + "%");
        $('#total_price').val((totalRs).toFixed(2));


    }    
}

function openPopup(url,title) {
    var height = 900;
    var width = 800;
    //window.open(url,title);
    var leftPosition, topPosition;
    //Allow for borders.
    leftPosition = (window.screen.width / 2) - ((width / 2) + 10);
    //Allow for title and status bars.
    topPosition = (window.screen.height / 2) - ((height / 2) + 50);
    //Open the window.
    window.open(url, title, "status=no,height=" + height + ",width=" + width + ",resizable=yes,left=" + leftPosition + ",top=" + topPosition + ",screenX=" + leftPosition + ",screenY=" + topPosition + ",toolbar=no,menubar=no,scrollbars=no,location=no,directories=no");
}

