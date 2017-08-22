var arrDisable=[];
var arrAble=[];
function sayHello(){

	alert('Hello');
}

function elevator(arrElevator){

         //arrDisable array is the date totally booked out 
            
       //arrAble array is the some period has booked out, but the date is still avaiable.
            
            //fill arrDisable and arrAble , if inputData[i].length == 4 is true, means that date\'s all periods is booked out
          for(var i = 0 ; i < arrElevator.length; i++){
      
             if (arrElevator[i][1].length == 3){
              arrDisable.push(arrElevator[i][0]);
            }else{
                arrAble.push(arrElevator[i]);
          
            }
          }

}


$(function() {
			
			//PHP get Booked Dates
		
			
			//Disable Dates
            $( "#ereservationDate" ).datepicker({
             
               dateFormat:"yy-mm-dd", 
			   minDate: new Date(),
			   beforeShowDay: function(date) {
				   // Disable date according to arrDisable array
					if($.inArray($.datepicker.formatDate('yy-mm-dd', date ), arrDisable ) > -1)
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
					//Make all periods can be selected.
					$("#period1").removeAttr("disabled");
					$("#period2").removeAttr("disabled");
					$("#period3").removeAttr("disabled");
					
					for(var i = 0; i < arrAble.length; i++){
						
						if(arrAble[i][0] == selectedDate){
							
								for(var j = 0; j < arrAble[i][1].length; j++){
									//Disable booked out period
									if(arrAble[i][1][j] == "10:00-13:00"){
										$("#period1").attr('disabled','disabled');
									}
									if(arrAble[i][1][j] == "13:00-16:00")
										$("#period2").attr('disabled','disabled');
									if(arrAble[i][1][j] == "16:00-19:00")
										$("#period3").attr('disabled','disabled');
									
								}
							
						}
						
					} 
					
					
					
				},

            });
		

			
		
			$("#requestDate").val(getRequestDate());

			
			
         });
		
function myValidation(){
				
				var submitForm = true;
				if($("#reservationDate").val()==""){
					submitForm = false;
					alert("Please enter Reservation Date!");
				}
					
				return submitForm;
			
			}