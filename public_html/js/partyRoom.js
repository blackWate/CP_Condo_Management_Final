$(function() {
			
			//PHP get Booked Dates
			//var arrGuest = 	["2017-01-22","2017-01-23","2017-01-24"];
			
			//Disable Dates
            $( "#reservationDate" ).datepicker({
             
               dateFormat:"yy-mm-dd", 
			   minDate: new Date(),
			   beforeShowDay: function(date) {
					if($.inArray($.datepicker.formatDate('yy-mm-dd', date ), arrParty) > -1)
					{
						return [false,"booked","Booked out"];
					}
					else
					{
						return [true,'',"available"];
					}
				},
				
				onClose: function(selectedDate) {
				if(selectedDate==""){
						
						alert("Please Enter the Reservation Date!");
					
					}
				}
            });
		

			
		
			$("#requestDate").val(getRequestDate());

			
			
         });
		
function myValidation(){
				
				var submitForm = true;
				if($("#reservationDate").val()==""){
					submitForm = false;
					alert("Please enter Reservation Date!");
				}
				else if($("#startTime").val()>=$("#endTime").val()){
					submitForm = false;
					alert("End time must be Later than start time!");
					}
					
				return submitForm;
			
			}