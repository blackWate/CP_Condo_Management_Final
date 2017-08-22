

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
                    var temp = arrGuest.slice();
                    temp.push($(this).datepicker().val());
                    temp.sort();
                    var nextDate = temp[temp.indexOf($('#startDate').val())+1];
                    var s1 = new Date($(this).datepicker().val());
                    var s2 = new Date(nextDate);
                    var diff = (s2-s1)/1000/60/60/24;
                    if(diff<7){
                        max.setDate(max.getDate()+diff);
                    }else{
                        max.setDate(max.getDate()+7);
                    }
					/*if(diff ==1){
						arrGuest.splice(arrGuest.indexOf(nextDate),1);
					}*/
					min.setDate(min.getDate()+1);
					//max.setDate(max.getDate()+7);
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
					
				} ,
                onClose: function(selectedDate) {
                    if(selectedDate ==""){
                        //$("#endDate").val(getEndDate($("#endDate").val()));
						var temp2 = arrGuest.slice();
                        temp2.push($('#startDate').val());
                        temp2.sort();
                        var nextDate = temp2[temp2.indexOf($('#startDate').val())+1];
                        $("#endDate").val(nextDate);
                        var duration = 	getDuration($("#startDate").val(),$("#endDate").val());
                        $("#duration").val(duration);
                        $("#fee").val((duration*85).toFixed(2));
                        $("#deposit").val("200.00");
                    }
                }
			   
            });
			
		
			$("#requestDate").val(getRequestDate());

			
			
         });
		
function getRequestDate(){
	
	var fullDate = new Date();
		
	//Thu May 19 2011 17:25:38 GMT+1000 {}
	 
	//convert month to 2 digits
	var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);
	 
	var currentDate =  fullDate.getFullYear()+ "-" + twoDigitMonth + "-" + fullDate.getDate();
	
	return currentDate;
}
function getEndDate(date){

    var fullDate = new Date(date);
    fullDate.setDate(fullDate.getDate() + 2);

    //Thu May 19 2011 17:25:38 GMT+1000 {}

    //convert month to 2 digits
    var twoDigitMonth = ((fullDate.getMonth().length+1) === 1)? (fullDate.getMonth()+1) : '0' + (fullDate.getMonth()+1);

    var currentDate =  fullDate.getFullYear()+ "-" + twoDigitMonth + "-" + fullDate.getDate();

    return currentDate;
}

function getDuration(x,y){
	
	var old_date = x;//"2010-11-15 07:30:40";
	var new_date = y;//"2010-11-11 08:03:22";

	var old_date_obj = new Date(Date.parse(old_date));
	var new_date_obj = new Date(Date.parse(new_date));

	var diffMs = Math.abs(new_date_obj - old_date_obj);
	var diffDays = Math.round(diffMs / 86400000); // days
	var diffHrs = Math.round((diffMs % 86400000) / 3600000); // hours

	return (diffDays);

}