$(function() {
			
			//PHP get Booked Dates
			//var arrGuest = 	["2017-01-22","2017-01-23","2017-01-24"];
			
			//Disable Dates
            $( "#startDate" ).datepicker({
             
               dateFormat:"yy-mm-dd", 
			   minDate: new Date(),
			   beforeShowDay: function(date) {
					if($.inArray($.datepicker.formatDate('yy-mm-dd', date ), arrGuest) > -1)
					{
						return [false,"booked","Booked out"];
					}
					else
					{
						return [true,'',"available"];
					}
				},
				
				onClose: function(selectedDate) {
				if(selectedDate!=""){
					var end = $('#endDate');
					var min = $(this).datepicker('getDate');
					var max = $(this).datepicker('getDate');
					min.setDate(min.getDate()+1);
					max.setDate(max.getDate()+7);
					end.datepicker('option', 'maxDate', max);
					end.datepicker('option', 'minDate', min);
					
					$("#endDate").datepicker("option", "minDate", min);
						return $("#endDate").datepicker("show");
					}
				}
            });
		
		
            $( "#endDate" ).datepicker({
            
               dateFormat:"yy-mm-dd",
			   minDate: new Date(),
			   beforeShowDay: function(date) {
					if($.inArray($.datepicker.formatDate('yy-mm-dd', date ), arrGuest) > -1)
					{
						return [false,"booked","Booked out"];
					}
					else
					{
						return [true,'',"available"];
					}
				},	
				//DatePicker fill duration
				onSelect: function () {
						var duration = 	getDuration($("#startDate").val(),$("#endDate").val());
						$("#duration").val(duration);
						$("#fee").val((duration*85).toFixed(2));
						$("#deposit").val("200.00");
					
				} 
			   
            });
			
		
			$("#requestDate").val(getRequestDate());

			
			
         });
		
