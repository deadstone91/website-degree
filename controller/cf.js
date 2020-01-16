 xhrRequest(); //call this function

/**
 * summary:AJAX request for film data. 
 * Description:Performs an AJAX request through PHP api that gets the film data from the mySql database. 
 */
  function xhrRequest()
{
   var xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function() {
         
    if (this.readyState == 4 && this.status == 200) {
          var data = JSON.parse(this.responseText);
    //console.log(data);
    
     DisplayFilmData(data);     
    }
  };
  xhttp.open("GET", "../controller/filmCrud.php?f=one", true);
  xhttp.send();
    
}

/**
 * Summary: data removal and AJAX request
 * Description: this function removes html data from the document and replaces with new data by calling the     * xhrRequest function.
 */
function xhrRequest2()
{
   $('#window').remove();
   $('#bg').after('<div class="container" id="window">\
   <div class="row movieWin" style="padding-bottom: 15px" id = "content0">\
   </div>');
   xhrRequest();
}

/**
 * summary: Passed data is displayed
 * Description: Data is passed from the xhrRequest function to be displayed.
 * it gets all the films basic data back so as to display all the films on the first screen.
 */
function DisplayFilmData(data)
{
   var counter = 0;
   var rowCounter = 0;
   var ifCheck = false;
   
   $(document).ready(function () {

      for (let i = 0; i < data.length; i++) 
      {
         
         if(counter == 3)
         {
            var newRow = rowCounter + 1;
            $('<div class="row movieWin" style="padding-bottom: 15px" id = "content' +newRow+'">').insertAfter('#content'+ rowCounter );
            ifCheck= true;
            counter = 0;
         }



         //console.log(data[i].f_title);
         
         var idVar;
         if(ifCheck == false)
         {
            //console.log("false");
            if(rowCounter == 0)
            {

            }
            idVar = "#content"+ String(rowCounter) ; 
         }else{
            //console.log("true");
            rowCounter++;
            idVar = "#content"+ String(rowCounter);
            //console.log(idVar);
            
            ifCheck = false;
            //ifCheck = false;
         }

         
         $(idVar).append('<div class="col-sm-4 d-flex">\
         <a id="here" href="#" onclick="moreInfo('+data[i].f_id+')">\
         <div class="card card-home bg-dark flex-fill mb-3" style="max-width: 540px;">\
    <div class="row no-gutters">\
      <div class="col-md-4">\
        <img src="/model/media/'+ data[i].f_poster +'" class="card-img" alt="...">\
      </div>\
      <div class="col-md-8">\
        <div class="card-body">\
          <h5 class="card-title">'+data[i].f_title+'</h5>\
          <p class="card-text">GENRE: '+ entrySplit(data[i].f_genre) +'</p>\
          <p class="card-text"><small class="text-muted">Avg. Review Score: '+ data[i].f_avg +'</small></p>\
        </div>\
      </div>\
    </div>\
  </div>\
        </a>');
      
         if(counter == 3)
         {
            $('</div>').insertAfter('#here');
         }
       counter++;
      
       
      }
   });
}

/**
 * summary: jQuery AJAX request retrieving a specific films data
 * description: This function sends the film id to the server to get the film with that ids data, once
 * returned it gets sent to the filmData function
 */
function moreInfo(id)
{
   //console.log("clicked link of id "+(id));
   $('.movieWin').remove();
   $.ajax({
      type: "GET",
      url: "../controller/filmCrud.php",
      data: {"id":id},
      dataType: "JSON"
   })
   .done(function (response) {
      //console.log("movie info return");
      var data = response;
      //console.log(data);
      filmData(data);
   })
   .fail(function(response){
     // console.log("movie info fail");
     // console.log(response);
      
   })
}

/**
 * summary: one films data is displayed
 * description: takes the data from one single film and using jQuery appends the data to the document.
 * It also then calls another function to display review data.
 */

function filmData(data) 
{

   $('#window').append('\
   <p style="color: white">Film no: #'+data[0].f_id+'</p>\
   <div id="fdwin" class="row">\
      <div class="col-sm-5">\
         <img class="img-fluid" style="box-shadow: 5px 5px 5px rgb(0,0,0,0.5)" src="\\model\\media\\'+ data[0].f_poster +'" alt="Film Poster">\
      </div>\
         <div class="col-sm-7" >\
            <div class="card"style="background-color: rgb(255,255,255,0.5)">\
               <div class="container">\
                  <h1 style="color: black" >Title:</h1>\
                  <h2 style="color: black">'+data[0].f_title+'</h2><br>\
                  <h3 style="color: black">Synopsis:</h3>\
                  <p  style="color: black">'+ data[0].f_blurb +'</p>\
                  <h3 style="color: black">Director:</h3>\
                  <p  style="color: black">'+ entrySplit(data[0].f_director) +'</p>\
                  <h3 style="color: black">lead Actor(s):</h3>\
                  <p  style="color: black">'+ entrySplit(data[0].f_lead_actors) +'</p>\
                  <h3 style="color: black">Genre:</h3>\
                  <p  style="color: black">'+ entrySplit(data[0].f_genre) +'</p>\
                  <h3 style="color: black">Average Review Score:</h3>\
                  <p  style="color: black">'+ data[0].f_avg +'</p>\
                  <h3 style="color: black">Date Of Release:</h3>\
                  <p  style="color: black">'+ data[0].f_release_date +'*</p>\
                  <a class="btn btn-success btn-lg" href="#" onclick="xhrRequest2()">Return</a>\
                  <a class="btn btn-warning btn-lg" href="#" onclick="returnReviews('+data[0].f_id+')">Reviews</a>\
                  <a class="btn btn-warning btn-lg" href="#" onclick="setFilm()">Add film</a>\
                  <a class="btn btn-danger btn-lg" href="#" onclick="writeReview('+data[0].f_id+')">Write Review</a>\
                  <small>*Date might differ by Region</small>\
                  </div>\
               </div>\
            </div>\
         </div>\
   </div>\
   <div id="revSection" class="container" style="padding:30px">\
      <div id="reviewArea" class="container card" style="background-color: rgb(255,255,255,0.5)">\
         <h2 id="reviewData" class="text-center" style="color: black">User Reviews</h2>\
         <h4 class="text-center">I Find The Lack Of Reviews Disturbing!<a class="btn" href="#" onclick="scrollToTop()"><img style="height:64px"src="\\model\\media\\uparrow.png" alt="to top"></a></h4>\
      </div>\
   </div>\
   '); 
   getReviews(data[0].f_id);
}
   
/**
 * summary: gets reviews
 * description: empties part of document and gets the reviews
 */
function returnReviews(id)
{
   $('.userReview').empty();
   getReviews(id);
}

/**
 * summary: scrolls the window down
 */
function scrollDown()
{
  window.scroll(0,1000);
}

/**
 * summary: scrolls the window up
 */
function scrollToTop()
{
  //window.scroll(0,0);
}

/**
 * summary: AJAX request
 * description: Uses the film id to get the reviews using jQuery AJAX and sends the data to be displayed
 * to the sortReview function.
 */
function getReviews(filmId)
{

   $.ajax({
      type: "GET",
      url: "../controller/filmCrud.php",
      data: {"film":filmId},
      dataType: "JSON"
   })
      .done(function (response) {
         //console.log("reviews retreived");
         var rData = response;
         //console.log(rData);
         sortReview(rData);
      })
      .fail(function(response){
        // console.log("review retreival failed");
        // console.log(response);
         
      })
      
}

/**
 * summary: displays reviews
 * description: Takes the data sent to it and using jQuery adds it to the Document.
 */
function sortReview(rData)
{
   if(rData != null){
      for (var i = 0; i < rData.length; i++)
         {
            $('#reviewData').after('<div class="userReview" style="color: black"><h4  style="color: black">"'+rData[i].r_title+'"<br>'+rData[i].r_star + getRating(rData[i].r_star)+'</h4>\
                  "'+rData[i].r_blurb+'"<br>\
                  <p style="color: black"><strong>'+rData[i].r_user+'</strong> on '+rData[i].r_date+'</p></div><br>'
            );
         }
      }
}

/**
 * summary: adds html to the document
 */
function review()
{
   //console.log("review btn pressed");
   $('#fdwin').remove();
   $('#window').append('<h1 style="color: white" >User Reviews</h1>\
   <div class="col-sm-12">\
   <div class="container">\
   <h2>the reviews</h2>\
   </div>\
   </div>');
}

/**
 * summary: splits data from database
 * description: Some of the data from the database is in list form seperated by semi-colons. this splits them and makes a string with commas in.
 */

function entrySplit(toSplit)
{
    var returnString = "";
    console.log(toSplit);
    
    var temp =  toSplit;
     var counter = 0;
  // console.log(temp);
  //var split = temp.includes(";");

  
  
      var genreString = temp.split(";");
      genreString.forEach(function (entry){
         
         
         if(counter == 0){
            returnString = returnString +" "+ entry;
         }else{
            returnString = returnString +", "+ entry;
         }
         counter++;
       
   });
   counter = 0;
  
  
   
   return returnString;
}


/**
 * summary: retrieves rating
 * description: All reviews have a rating, this function works out how each display is represented with ticket
 * pictures.
 */
function getRating(rating)
{
   //console.log("the rating is " + rating);
   
   switch (rating) {
      case "1":
         return '<img style="max-height:32px;max-width:32px"src="/model/media/CinemaTicket2.ico" alt="">\
         <img style="max-height:32px;max-width:32px"src="/model/media/CinemaTicket.ico" alt="">\
         <img style="max-height:32px;max-width:32px"src="/model/media/CinemaTicket.ico" alt="">\
         <img style="max-height:32px;max-width:32px"src="/model/media/CinemaTicket.ico" alt="">\
         <img style="max-height:32px;max-width:32px"src="/model/media/CinemaTicket.ico" alt="">\
         ';
         break;
      case "2":
         return '<img style="max-height:32px;max-width:32px"src="/model/media/CinemaTicket2.ico" alt="">\
         <img style="max-height:32px;max-width:32px"src="/model/media/CinemaTicket2.ico" alt="">\
         <img style="max-height:32px;max-width:32px"src="/model/media/CinemaTicket.ico" alt="">\
         <img style="max-height:32px;max-width:32px"src="/model/media/CinemaTicket.ico" alt="">\
         <img style="max-height:32px;max-width:32px"src="/model/media/CinemaTicket.ico" alt="">\
         ';
         break;
      case "3":
        // console.log("case 3");
          return '<img style="max-height:32px;max-width:32px"src="/model/media/CinemaTicket2.ico" alt="">\
         <img style="max-height:32px;max-width:32px"src="/model/media/CinemaTicket2.ico" alt="">\
         <img style="max-height:32px;max-width:32px"src="/model/media/CinemaTicket2.ico" alt="">\
         <img style="max-height:32px;max-width:32px"src="/model/media/CinemaTicket.ico" alt="">\
         <img style="max-height:32px;max-width:32px"src="/model/media/CinemaTicket.ico" alt="">\
         ';
         break;
      case "4":
         return'<img style="max-height:32px;max-width:32px"src="/model/media/CinemaTicket2.ico" alt="">\
         <img style="max-height:32px;max-width:32px"src="/model/media/CinemaTicket2.ico" alt="">\
         <img style="max-height:32px;max-width:32px"src="/model/media/CinemaTicket2.ico" alt="">\
         <img style="max-height:32px;max-width:32px"src="/model/media/CinemaTicket2.ico" alt="">\
         <img style="max-height:32px;max-width:32px"src="/model/media/CinemaTicket.ico" alt="">\
         ';
         break;
      case "5":
         return '<img style="max-height:32px;max-width:32px"src="/model/media/CinemaTicket2.ico" alt="">\
         <img style="max-height:32px;max-width:32px"src="/model/media/CinemaTicket2.ico" alt="">\
         <img style="max-height:32px;max-width:32px"src="/model/media/CinemaTicket2.ico" alt="">\
         <img style="max-height:32px;max-width:32px"src="/model/media/CinemaTicket2.ico" alt="">\
         <img style="max-height:32px;max-width:32px"src="/model/media/CinemaTicket2.ico" alt="">\
         ';
         break;

      default:
        // console.log("didnt work");
         break;
   }
}

/**
 * summary: creates write review section.
 * description: when the write a review button is clicked on the website, jQuery is used to remove the reviews
 * and display the write a review section. This function manipulates the html. This also has the workings of 
 * creating the rating buttons using jQuery to affect the css. It also contains the AJAX to add the form data
 * to the database.
 */
function writeReview(revFilmData)
{   
   $('#reviewArea').remove();
  
   $('#revSection').append(
   '<div id="reviewData">\
      <div   id="reviewArea" class="container userReview card" style="background-color: rgb(255,255,255,0.5)">\
         <div class="">\
            <h2 class="text-center">Your Review</h2>\
            <div class="ticketBox">\
               <h4 style="color: black">Your Rating</h4>\
               <img class="img-1" style="height:32px; width:32px position: absolute; top: 0; left: 0;" src="\\model\\media\\CinemaTicket2.ico" alt="">\
               <img class="img-2" style="height:32px; width:32px position: absolute; top: 0; left: 0;" src="\\model\\media\\CinemaTicket2.ico" alt="">\
               <img class="img-3" style="height:32px; width:32px position: absolute; top: 0; left: 0;" src="\\model\\media\\CinemaTicket2.ico" alt="">\
               <img class="img-4" style="height:32px; width:32px position: absolute; top: 0; left: 0;" src="\\model\\media\\CinemaTicket2.ico" alt="">\
               <img class="img-5" style=" opacity: 0.4; height:32px; width:32px position: absolute; top: 0; left: 0;" src="\\model\\media\\CinemaTicket2.ico" alt="">\
               <h2></h2>\
            </div>\
                  <form id="revForm" action="">\
                     <div>\
                        <label for="user" style="color: black"><strong>Username:</strong></label>\
                        <input class="form-control" name="user" type="text">\
                        <label for="title" style="color: black"><strong>Review Title:</strong></label>\
                        <input class="form-control" name="title" type="text">\
                        <label for="blurb" style="color: black"><strong>The Review:</strong></label>\
                        <textarea class="form-control" id="textArea" name="revblurb" type="text"></textarea>\
                     </div>\
                     <a id="subBtn" class="btn-lg btn-primary btn-block text-center" name="sub" onsubmit="return writeValidation()" type="submit">Upload Review</a>\
                  </form>\
         </div>\
      </div>\
      </div>');
     

      $(document).ready(function () {
        // console.log("doc ready");
         ticketRating = 0;
         window.scroll(0,500);
         


         $('.img-1').on({
            mouseenter: function (){
               $(this).css({'opacity': 1});
            }, mouseleave: function (){
               $(this).css({'opacity': 0.4});
            } 
         });
         
         $('.img-2').on({
            mouseenter: function (){
               $(this).css({'opacity': 1});
               $('.img-1').css({'opacity': 1});

            }, mouseleave: function (){
               $(this).css({'opacity': 0.4});
               $('.img-1').css({'opacity': 0.4});
            } 
         }); 

         $('.img-3').on({
            mouseenter: function (){
               $(this).css({'opacity': 1});
               $('.img-2').css({'opacity': 1});
               $('.img-1').css({'opacity': 1});
            }, mouseleave: function (){
               $(this).css({'opacity': 0.4});
               $('.img-2').css({'opacity': 0.4});
               $('.img-1').css({'opacity': 0.4});
            } 
         });         
         
         $('.img-4').on({
            mouseenter: function (){
               $(this).css({'opacity': 1});
               $('.img-3').css({'opacity': 1});
               $('.img-2').css({'opacity': 1});
               $('.img-1').css({'opacity': 1});
            }, mouseleave: function (){
               $(this).css({'opacity': 0.4});
               $('.img-3').css({'opacity': 0.4});
               $('.img-2').css({'opacity': 0.4});
               $('.img-1').css({'opacity': 0.4});
            } 
         });
         
         $('.img-5').on({
            mouseenter: function (){
               $(this).css({'opacity': 1});
               $('.img-4').css({'opacity': 1});
               $('.img-3').css({'opacity': 1});
               $('.img-2').css({'opacity': 1});
               $('.img-1').css({'opacity': 1});
            }, mouseleave: function (){
               $(this).css({'opacity': 0.4});
               $('.img-4').css({'opacity': 0.4});
               $('.img-3').css({'opacity': 0.4});
               $('.img-2').css({'opacity': 0.4});
               $('.img-1').css({'opacity': 0.4});
            }
         });
        
         $('.img-1').click(function () { 
            console.log("rating set as 1");
            ticketRating = 1;
            $('.youRate').empty();
            $('.ticketBox').after('<h3 class="youRate" style="color:black">You rate this '+ticketRating+' of 5</h3>');
         });
        
         $('.img-2').click(function () { 
            console.log("rating set as 2");
            ticketRating = 2;
            $('.youRate').empty();
            $('.ticketBox').after('<h3  class="youRate" style="color:black">You rate this '+ticketRating+' of 5</h3>');
         });

         $('.img-3').click(function () { 
            console.log("rating set as 3");
            ticketRating = 3;
            $('.youRate').empty();
            $('.ticketBox').after('<h3 class="youRate"  style="color:black">You rate this '+ticketRating+' of 5</h3>');
         });

         $('.img-4').click(function () { 
            console.log("rating set as 4");
            ticketRating = 4;
            $('.youRate').empty();
            $('.ticketBox').after('<h3  class="youRate" style="color:black">You rate this '+ticketRating+' of 5</h3>');
         });

         $('.img-5').click(function () { 
            console.log("rating set as 5");
            ticketRating = 5;
            $('.youRate').empty();
            $('.ticketBox').after('<h3 class="youRate"  style="color:black">You rate this '+ticketRating+' of 5</h3>');
         });
         

         $("#revSection").on("click","a", function (e) {
            //console.log("btn pressed");
            
            var valid = writeValidation();
               console.log(valid);
               if(valid === true)
               {
                  var formData = {
                     'rating' : ticketRating,
                     'filmid' :  revFilmData,
                     'user'   : $('input[name=user]').val(),
                     'title'  : $('input[name=title]').val(),
                     'blurb'  : $('#textArea').val()
                  };
                     
                  $.ajax({
                     type: "POST",
                     url: "/controller/filmCrud.php",
                     data: {"myData":formData}
                  })
                  .done(function (data) {  
                     //console.log(data);
                     
                  })
                  .fail(function (data) {
                   //  console.log(data);
                  })
                  e.preventDefault();
              // });     
              $('input[name=user]').val("");
              $('input[name=title]').val("");
              $('#textArea').val("");
                  
                  averageReview(revFilmData);
               }

                  
                 
         });
      });
}

/**
 * summary: gets avg reviews
 * description: Ajax call to get all reviews for a film and takes the ratings and calculates the average 
 */
function averageReview(filmId) {
   $.ajax({
      type: "POST",
      url: "/controller/filmCrud.php",
      data: {"filmId": filmId},
   })
   .done(function (data) {
     // console.log(data);
      var ratingData = JSON.parse(data);
      var total;
      var average;
      var counter = 1;
      for (var i = 0; i < ratingData.length; i++) {
         console.log(ratingData[i].r_star);
         total = total + parseInt(ratingData[i].r_star) ;
        //console.log(total);
      }
      average = total/ratingData.length;
      
      console.log("The average is: " + average);
      setAvg(average,filmId);

   });
} 


/**
 * summary: set the avg rating
 * description: takes average from the averageReview function and does an AJAX request to put that data into
 * the database with the film data. 
 */
function setAvg(avg,id) {

   var avgData = {
      'average' : avg,
      'id'  : id   
   };

   $.ajax({
      type: "POST",
      url: "/controller/filmCrud.php",
      data: {"averageData": avgData}
   })
   .done(function (data) {
      console.log("Average set");
   })
}

/**
 * summary: form validation.
 * description: from the input of the review form it is validated before it is sent to the server.
 */
function writeValidation()
{
   console.log("validation running");
   
   var user = $('input[name=user]').val();
   var title = $('input[name=title]').val();
   var blurb = $('#textArea').val();
   var missing = false;

   if(user.trim() == ""){
      alert("Missing data, please fill in all fields");
      missing = true;
   }

   if(title.trim() == ""){
      alert("Missing data, please fill in all fields");
      missing = true;
   }

   if(blurb.trim() == ""){
      alert("Missing data, please fill in all fields");
      missing = true;
   }
   
   if(ticketRating == 0){
      alert("Your have not given this title a rating");
      missing = true;
   }
   
   
   
   if(missing == true){
     
      return false;
   }else{
      return true;
   }
}

function setFilm()
{
   $('#window').remove();
   $('#bg').after('<div id="createFilm" class="container userReview card" style="background-color: rgb(255,255,255,0.5)">\
   <form id="filmForm" action="filmCrud.php enctype="multipart/form-data"">\
      <div>\
         <label for="filmTitle" style="color: black" ><strong>Title</strong></label>\
         <input class="form-control" name="filmTitle" type="text">\
         <label for="director" style="color: black"><strong>Director(s)</strong></label>\
         <input class="form-control" name="director" type="text">\
         <label for="actor" style="color: black"><strong>Lead Actor(s) - (Split each with ";")</strong></label>\
         <input class="form-control" name="actor" type="text">\
         <label for="genre" style="color: black"><strong>Genre(s) - (Split each with ";")</strong></label>\
         <input class="form-control" name="genre" type="text">\
         <label for="releaseDate" style="color: black"><strong>Date Of Release - (yyyy-mm-dd)</strong></label>\
         <input class="form-control" name="releaseDate" type="text">\
         <label for="synopsis" style="color: black"><strong>Synopsis</strong></label>\
         <textarea class="form-control" id="filmText" name="synopsis" type="text"></textarea>\
         <label for="fileUpload" style="color: black"><strong>Film Poster</strong></label>\
         <input id="filmPoster" name="fileUpload" type="file">\
      </div>\
      <a id="filmBtn" class="btn-lg btn-primary btn-block text-center" name="filmSumbit" onsubmit="return filmValidation()" type="submit">Upload Review</a>\
   </form>\
   </div>');

$("#createFilm").on("click","a", function (e) {
   console.log('film clicked');
   var valid =  true;//filmValidation()
   console.log(valid);

   if(valid == false)
   {
      alert('Missing Data');
   }else{
      console.log( $('#filmPoster').val());
    
    
     
         
         e.preventDefault();
      
         /* var formData = new FormData(this);
         console.log(formData);
         
         $.ajax({
            type: "POST",
            url: "/controller/filmCrud.php",
            data: formData,
            cache: false,
            contentType: false,
            processData: false
         })
         .done(function(data){
            console.log("sent");
         })
         .fail(function (data) {
            console.log("failed");
            
         }) */
      
       var val =  $('#filmPoster').val()
         var fArray = val.split("\\");
         
         
     
     
     
     
       var filmForm = {
         'filmTitle' : $('input[name=filmTitle]').val(),
         'filmDirector' : $('input[name=director]').val(),
         'filmActor'   : $('input[name=actor]').val(),
         'filmGenre'  : $('input[name=genre]').val(),
         'filmDate'  :$('input[name=releaseDate]').val(),
         'filmSynopsis' : $('#filmText').val(),
         'filmPoster' : fArray[2]
      };

      $.ajax({
         type: "POST",
         url: "/controller/filmCrud.php",
         data: {"filmUpload":filmForm}
      })
      .done(function (data) {  
         console.log('film upload success');
         
      })
      .fail(function (data) {
         console.log('film upload fail');
      })
      e.preventDefault();
      


      $.ajax({
         type: "POST",
         url: "/controller/filmCrud.php",
         data: $('#filmPoster').prop('files')[0] ,
         cache: false,
         contentType: false,
         processData: false,
         success: function (response) {
            console.log('file success');
            
         }
      });
      
   }
});


}

function filmValidation() {
   var filmTitle = $('input[name=filmTitle]').val();
   var filmDirector = $('input[name=director]').val();
   var filmActors = $('input[name=actor]').val();
   var filmGenre = $('input[name=genre]').val();
   var filmDate = $('input[name=releaseDate]').val();
   var filmSynopsis = $('#filmText').val();
   var filmPoster = $('#filmPoster').val();

   if(filmTitle || filmDirector || filmActors || filmGenre || filmData || filmSynopsis == ""){
      return false;   
   }else{
      return true;
   }
}

