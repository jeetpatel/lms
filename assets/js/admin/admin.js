(function(window){

    'use strict';

    var // Localise globals
        document = window.document,
        $ = window.$,
        ADMIN = window.ADMIN = window.ADMIN || {'base_url' : $("base").attr('href')};


        ADMIN.createAppointment = {

                bindEvents : function(){
                    
                    $(document).off('change.test').on('change.test', '#test', function(event) {
                            
                            if($(this).val()){

                                var url = ADMIN.base_url+'admin/tests/getTestPrice';
                                CIS.Ajax.request(url,{
                                    type : 'POST',
                                    context : this,
                                    data : {'test_id' : $(this).val(), 'csrf_test_name' : $.cookie("csrf_cookie_name")},
                                    beforeSend : function(){
                                        $(this).find('[type="submit"]').addClass('disabled');
                                    },
                                    success : function(data){
                                        if(data.status == "SUCCESS"){

                                            $('#test_price').val(data.test_price);
                                            $('#total_price').val(data.final_price);
                                        }
                                    },
                                    complete : function(){
                                        $(this).find('[type="submit"]').removeClass('disabled');
                                    }
                                });

                            }else{
                                    $('#test_price').val('');
                                    $('#discount').val('');
                                    $('#total_price').val('');
                            }   
                            
                    });


                    $(document).off('focusout.discount').on('focusout.discount', '#discount', function(event) {
                            
                            var discountPercent = $(this).val();
                            var lastChar = $('#sing').val();
                            if(lastChar == '%'){
                            var price = parseInt($('#test_price').val());
                            var discountPercent = parseInt($(this).val());
                            if(discountPercent && Number.isInteger(discountPercent) && discountPercent <= 100){
                                    var discount_price = (discountPercent/100)*price,
                                        total_price = price-discount_price;
                                        
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
                            var priceRs = parseInt($('#test_price').val());
                            var discountRs = parseInt($(this).val());
                            var disRs= (discountRs/priceRs)*100;
                            var totalRs = priceRs-discountRs;
                            $('#discount_price').val((disRs).toFixed(2) + "%");
                            $('#total_price').val((totalRs).toFixed(2));
                        
                         
                        }
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



});
