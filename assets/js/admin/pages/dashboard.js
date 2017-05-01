/*
 * Author: Abdullah A Almsaeed
 * Date: 4 Jan 2014
 * Description:
 *      This is a demo file used only for the main dashboard (index.html)
 **/

(function (window) {

	var // Localise globals
        document = window.document,
        $ = window.$;

        $(document).ready(function($) {

        	var dt = JSON.parse(appointmentsData);	
        	
        	//DONUT CHART
	        var donut = new Morris.Donut({
	          element: 'sales-chart',
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
        


	        $(document).off('submit.emailform').on('submit.emailform', 'form[name="email_form"]', function(event) {
	        	event.preventDefault();
	        	
	        	CIS.Ajax.request($(this).attr('action'), {
	        			async : true,
                        type : "POST",
                        dataType : "JSON",
                        context: this,
                        data: $(this).serializeArray(),
                        beforeSend: function() {

                        	$('body').overlay();

                            if ($(this).data('disabled')) {
                                return false;
                            }
                            // Disable this form
                            $(this).data('disabled', true);
                            // Disable all submit buttons of this form
                            $(this).find('[type="submit"]').addClass('disabled');
                        },
                        success : function(data){
                        		$("#mes").html(data.mes);
                        },
                        complete: function() {
                            $(this).data('disabled', false);
                            $(this).find('[type="submit"]').removeClass('disabled');
                            this.reset();
                            $.overlayout(); 
                        }
                });

	        });




        });

        
        


})(window);
