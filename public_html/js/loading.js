
var emails;
var senderunitno ='';
var reserveid ='';
var type ='';
$(window).ready(function () {
    $('#loading').hide();

//masked 
$(function($){
   $("#date").mask("99/99/9999",{placeholder:"mm/dd/yyyy"});
   $(".phone").mask("(999) 999-9999");
   $("#tin").mask("99-9999999");
   $("#ssn").mask("999-99-9999");
});

$('.printm').unbind('click').click(function() {

    window.print();
    return false;
});

//toggle of the noticeboard
$(".toggle-sidebar").click(function () {
        $("#sidebar").toggleClass("collapseed");
        $("#content").toggleClass("col-md-12 col-md-9");
        
        return false;
      });

//weather
 $.simpleWeather({
    location: 'Toronto, ON',
    woeid: '',
    unit: 'c',
    success: function(weather) {
      html = '<h2 text-primary><i class="icon-'+weather.code+'"></i> '+weather.temp+'&deg;'+weather.units.temp+'</h2>';
      html += '<ul><li>'+weather.city+', '+weather.region+'</li>';
      html += '<li class="currently">'+weather.currently+'</li>';
      html += '<li>'+weather.wind.direction+' '+weather.wind.speed+' '+weather.units.speed+'</li></ul>';
  
      $("#weather").html(html);
    },
    error: function(error) {
      $("#weather").html('<p>'+error+'</p>');
    }
  });

//realtime chat

$('#sendMessage').click(function() {
 insertChatMessage();
});

//news rss feeder
$('#news').FeedEk({
  FeedUrl:'http://news.google.com/news?q=toronto&output=rss',
  MaxCount: 5,
  ShowDesc: false,
  DateFormat: 'lll',
  DateFormatLang:'en'
});

//sidebar hide and seek
 $(".sidebar-toggle").click(function(){
            $(this).hide();
            
           $("#user-profil").show();
            
           $("#hide-btn").show();
            
            
            $(".dash").removeClass('col-lg-12','col-md-12');
             $(".dash").addClass('col-lg-9','col-md-9');
              $(".dash1").removeClass('col-lg-12','col-md-12');
             $(".dash1").addClass('col-lg-10','col-md-10');
        });
        
        $("#hide-btn").click(function(){
            $(this).hide();
            
           $("#user-profil").hide();
            
           $(".sidebar-toggle").show();
            
              $(".dash").removeClass('col-lg-9','col-md-9');
             $(".dash").addClass('col-lg-12','col-md-12');
              $(".dash1").removeClass('col-lg-10','col-md-10');
             $(".dash1").addClass('col-lg-12','col-md-12');
        });





 

// $('#resichart').click(function() {
//   // alert('clicked');
var ctresidents = $("#resichart");
var ctreservgroom=$("#reservgroom");
var ctreservproom=$("#reservproom");
var ctreservelevator=$("#reservelevator");


    $.ajax({
        type:'GET',
        data:{resident:'residents',reservation:'reservation'},
        dataType: "json",
        url:"staticscon",
            success:function(data){
              // alert(data);
              // console.log(data);
             //residents graph
              var dataResidents = {
                          labels: data.resident[0],
                          datasets: [
                              {
                                  data: data.resident[1],
                                  backgroundColor: [
                                      "#FF6384",
                                      "#36A2EB",
                                      "#FFCE56"
                                  ],
                                  hoverBackgroundColor: [
                                      "#FF6384",
                                      "#36A2EB",
                                      "#FFCE56"
                                  ]
                              }]
                      };
              var myPieChart = new Chart(ctresidents,{
              type: 'pie',
              data: dataResidents,
              options: {
                      legend: {
                                  display: true,
                                  labels: {
                                      fontColor: '#fff'
                                  }
                              }
                        }
              });
              //end of the residents' graph


               var dataGroom = {
                          labels: data.groom[0],
                          datasets: [
                              {
                                  data: data.groom[1],
                                  backgroundColor: [
                                      "#FF6384",
                                      "#36A2EB",
                                      "#FFCE56"
                                  ],
                                  hoverBackgroundColor: [
                                      "#FF6384",
                                      "#36A2EB",
                                      "#FFCE56"
                                  ]
                              }]
                      };
              var myPieChart = new Chart(ctreservgroom ,{
              type: 'doughnut',
              data: dataGroom,
              options: {
                      legend: {
                                  display: true,
                                  labels: {
                                      fontColor: '#fff'
                                  }
                              }
                        
                        // pieceLabel: {
                        //             mode: 'percentage',
                        //             precision: 2
                        //            }


                                 }
              });
              //end of the groom' graph

var dataProom = {
                          labels: data.proom[0],
                          datasets: [
                              {
                                  data: data.proom[1],
                                  backgroundColor: [
                                      "#FF6384",
                                      "#36A2EB",
                                      "#FFCE56"
                                  ],
                                  hoverBackgroundColor: [
                                      "#FF6384",
                                      "#36A2EB",
                                      "#FFCE56"
                                  ]
                              }]
                      };
              var myPieChart = new Chart(ctreservproom ,{
              type: 'doughnut',
              data: dataProom,
              options: {
                      legend: {
                                  display: true,
                                  labels: {
                                      fontColor: '#fff'
                                  }
                              }
                        
                        // pieceLabel: {
                        //             mode: 'percentage',
                        //             precision: 2
                        //            }


                                 }
              });
              //end of the proom' graph

var dataElevator = {
                          labels: data.elevator[0],
                          datasets: [
                              {
                                  data: data.elevator[1],
                                  backgroundColor: [
                                      "#FF6384",
                                      "#36A2EB",
                                      "#FFCE56"
                                  ],
                                  hoverBackgroundColor: [
                                      "#FF6384",
                                      "#36A2EB",
                                      "#FFCE56"
                                  ]
                              }]
                      };
              var myPieChart = new Chart(ctreservelevator ,{
              type: 'doughnut',
              data: dataElevator,
              options: {
                      legend: {
                                  display: true,
                                  labels: {
                                      fontColor: '#fff'
                                  }
                              }
                        
                        // pieceLabel: {
                        //             mode: 'percentage',
                        //             precision: 2
                        //            }


                                 }
              });
              //end of the elevator' graph

            }//end of the succes function
    }); 



$('#status_message').keypress(function(e){
  if(e.which==13)
  insertChatMessage();
});


 setInterval(function(){
     if(reserveid!='' && type!='' && senderunitno!='' )
     getChatMessages(reserveid,type,senderunitno);
}, 1000);  


//dashboard calender
$('#calendar').fullCalendar({
      header: {
            left: 'prev,next today',
            center: 'title',
            right: 'month,agendaWeek,agendaDay,listWeek'
          },

      defaultDate: $.now(),
      editable: false,
      eventLimit: true, // allow "more" link when too many events
      events: 'dashboardCal',
      
    });


//upload picture for residents
$( "#picUpload" ).change(function() {
  if (this.files && this.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('#resPhoto')
                    .attr('src', e.target.result)
            };
          
$( "#pic" ).attr( "value", this.files[0].name);
            reader.readAsDataURL(this.files[0]);
        }
});


//select picture from picturebox
$(function(){
$('#photos li').on('click',function(){
  var res = this.title.split("/");
  $('.img').attr('src', this.title);
  $('#pic').val(res[res.length-1]);
  });

});






//add bootstrap class
$('li.feedEkList').addClass('list-group');


//message notifier
var message=$('#message').val();
if(message){
var res = message.split('/');
if(res[1]=='s')
   type='success';
 else if(res[1]=='i')
    type='info';
  else
    type='danger'

$.notify({
  // options
  message:res[0] 
},{
  // settings
  type: type
});
}

 


// $('input[type=file]').fileValidator({
//   onValidation: function(files){      $(this).attr('class','');          },
//   onInvalid:    function(type, file){ $(this).addClass('invalid '+type); },
//   maxSize:      '4m'
// });

// $.validate({
//     modules : 'custom, file',
//     // onModulesLoaded : function() {
//     //   $('#country').suggestCountry();
//     // }
//   });


//email search
$("#sEmail").on("change paste keyup", function() {
  $('ul li').each(function(i)
{
   $(this).css('display','block'); 
});
    var sText=$.trim($(this).val());
$('#people li,#photos li')
  .filter(function() {
   //li is object
    var thtext=$.text([this]).toLowerCase().indexOf(sText);
      var sthtitle=$(this).attr('title');
      sthtitle=sthtitle.toLowerCase().indexOf(sText);
      var result=true;
     if(sthtitle>=0)
     {   result=false;
     }else if(thtext>=0)
     result=false;

      return result;
        
  })
    .css( "display", "none" );
});

//autosize textareas
$("#to").on("change paste keyup drop add", function() {
  autosize($(this));
});

//reservation facilities
$( 'li#g a').click(function(e) {
  $.cookie('active','g');
}); 
$( 'li#p a').click(function(e) {
  $.cookie('active','p');
}); 
$( 'li#e a').click(function(e) {
  $.cookie('active','e');
}); 

//sort list
$(".listitems li").sort(sort_li) // sort elements
                  .appendTo('.listitems'); // append again to the list


// sort function callback
function sort_li(a, b){
    return ($(b).data('position')) < ($(a).data('position')) ? 1 : -1;    
}



// setInterval(function() {
//   
// }, 1000);

//Emailbox 
 $(document).on('click', '.panel-heading', function(e){
    var $this = $(this);
  if(!$this.hasClass('panel-collapsed')) {
    $this.parents('.panel').find('.panel-body').slideUp();
    $this.addClass('panel-collapsed');
    $this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
  } else {
    $this.parents('.panel').find('.panel-body').slideDown();
    $this.removeClass('panel-collapsed');
    $this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
  }
});
 
//notifications drag and drop emailbox to email-input
$("#groups li,#people li,#photos li").draggable({helper: 'clone',cursor: "move",snap:true });
  $("#to,#resPhoto").droppable({
    accept: "#groups li,#people li,#photos li",
    drop: function(ev, ui) {
      if(this.value.indexOf(ui.draggable.attr('title'))<0){
    var $this = $(this);
    this.focus();
    if(this.value!='')
    this.value =this.value+','+ui.draggable.attr('title');
    else
      this.value=ui.draggable.attr('title');
          
          this.focus();
    }
    if(this.hasClass('img'))
    {
      this.attr('src', ui.draggable.attr('title'));
    }

  }
  });

$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})


} );
//end of widow ready

//textarea clear
$(function(){
$('#clear').on('click',function(){
    $('.clearable').val('');
}); 
});

//chatbox pop up
 $(function(){
          
            $("#removeClass").click(function () {
          $('#qnimate').css('display', 'none');
            });
  })

//notifications click and insert email to email-input
$(function(){
$('#groups li,#people li').on('click',function(){
   if($('#to').val().indexOf($(this).attr('title'))<0){
if($('#to').val()!='')
var content=$('#to').val()+','+$(this).attr('title');
else
var content=$(this).attr('title');
$('#to').val(content);
}
  });


});

// //validation
// $.validator.addMethod('sendTo', function (value) { 
//     return /^[\W]*([\w+\-.%]+@[\w\-.]+\.[A-Za-z]{2,4}[\W]*,{1}[\W]*)*([\w+\-.%]+@[\w\-.]+\.[A-Za-z]{2,4})[\W]*$/.test(value); 
// }, 'Please enter a valid email address.');

// $('#po').load('reservation', function() {
//   /* When load is done */
// });

function insertChatMessage(){

 var message=$('#status_message').val();
  senderunitno=$('#residentPic').attr('title');
  reserveid=$('#chatHeader').attr('title');
  var receiverunitno=$('#receiver').attr('title');
  type=$('#type').attr('title');
  var baseUrl = "sounds/sentmessage.mp3";

       
  $.ajax({
      type:'POST',
      data: { senderunitno:senderunitno, receiverunitno:receiverunitno,reserveid:reserveid,message:message,reservetype:type},
      url:"chatme",
      success:function(result){
        
        $('#status_message').val('');
       
         new Audio(baseUrl).play(); 

         getChatMessages(reserveid,type,senderunitno);
          
         
      }
  });


setTimeout(function(){
 var sHeight = document.getElementById("popmessages").scrollHeight;
$('#popmessages').scrollTop(sHeight);
}, 200);




}

function getStatics(){
  var ctx = $("#myChart");
    $.ajax({
        type:'GET',
        data:{},
        dataType: "json",
        url:"staticscon",
            success:function(data){
              // alert(data.length);
              // console.log(data);
              // var myPieChart = new Chart(ctx,{
              // type: 'pie',
              // data: data,
              // options: options
              // });

            }
    }); 
}


function getChatMessages(reserveid,reservetype,senderunitno){
 
 $.ajax({
       type:'GET',
       data:{reserveid:reserveid,reservetype:reservetype},
       dataType: "json",
       url:"chatter",
       success:function(data){
       // console.log(data);
       var strVar='';
       var newdate='';
       var olddate='';
                for (var i = 0; i < data.length; i++) {

  

                newdate=data[i].date;
                 if(newdate!=olddate){       
                strVar += "<div class=\"chat-box-single-line\">";
                strVar += "<abbr style=\"background-color: #dff0d8; padding-left: 6px; padding-right: 6px; border-radius: 4px;\" >"+data[i].date+"<\/abbr>";
                strVar += "<\/div>";
                }
                
                strVar += "<!-- Message. Default to the left -->";

                if(senderunitno==data[i].senderunitno){
                  // alert('from chatbox '+senderunitno);
                  // alert('from database '+data[i].senderunitno);
                strVar += "<div class=\"direct-chat-msg doted-border\">";
                strVar += "<div class=\"direct-chat-info clearfix\">";   
                strVar += "<span class=\"direct-chat-name pull-left\">"+data[i].senderfname+"<\/span>";
                strVar += "<\/div>";
                strVar += "<!-- \/.direct-chat-info -->";
                strVar += "<img alt=\"message user image\" src=\"photos/residents/"+data[i].senderphoto+"\" class=\"direct-chat-img\"><!-- \/.direct-chat-img -->";
                strVar += "<div class=\"direct-chat-text\">";
                strVar += ""+data[i].message+"";
                strVar += "<\/div>";
                strVar += "<span class=\"direct-chat-timestamp pull-right\">"+data[i].time+"<\/span>";
                strVar += "<\/div>";       
                strVar += "<\/span>";
                strVar += "<\/span>";
                strVar += "<\/div>";
                strVar += "<!-- \/.direct-chat-text -->";
                strVar += "<\/div>";
                strVar += "<!-- \/.direct-chat-msg -->";
                strVar += "<\/div>";
                console.log('sender');
                console.log(data[i]);
                }else{
                strVar += "<div class=\"direct-chat-msg doted-border\">";
                strVar += "<div class=\"direct-chat-info clearfix\">";   
                strVar += "<span class=\"direct-chat-name pull-left\">"+data[i].senderfname+"<\/span>";
                strVar += "<\/div>";
                strVar += "<!-- \/.direct-chat-info -->";
                strVar += "<img alt=\"message user image\" src=\"photos/residents/"+data[i].senderphoto+"\" class=\"direct-chat-img\"><!-- \/.direct-chat-img -->";
                strVar += "<div class=\"direct-chat-text\">";
                strVar += ""+data[i].message+"";
                strVar += "<\/div>";
                strVar += "<span class=\"direct-chat-timestamp pull-right\">"+data[i].time+"<\/span>";
                strVar += "<\/div>";       
                strVar += "<\/span>";
                strVar += "<\/span>";
                strVar += "<\/div>";
                strVar += "<!-- \/.direct-chat-text -->";
                strVar += "<\/div>";
                strVar += "<!-- \/.direct-chat-msg -->";
                strVar += "<\/div>";
                console.log('receiver');
                console.log(data[i]);
                }
                olddate=newdate;
              }
             $("#popmessages").html(strVar);
             // alert(strVar);

      }
  }); 
 
  }
// setInterval(function() {
//    sHeight = document.getElementById("popmessages").scrollHeight;
        
// }, 1);
