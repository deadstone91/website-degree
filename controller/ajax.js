function loadBlog (week) {
  console.log('Hello There')
  go(week)
}

function go (week) {
  console.log('GO')

  var xhr = new XMLHttpRequest()
  xhr.open('GET', '../controller/riaCrud.php?id=' + week, true)

  // If specified, responseType must be empty string or "text"
  xhr.responseType = 'text'

  xhr.onload = function () {
    if (xhr.readyState === xhr.DONE) {
      if (xhr.status === 200) {
        console.log(xhr.response)
        console.log(xhr.responseText)
        var blog = JSON.parse(xhr.responseText)
        try {
          blog = blog[0]
          document.getElementById('test').innerHTML = blog.blogTitle
          getFile(blog)
        } catch (error) {
          document.getElementById('test').innerHTML =
            "<h3 class='text-center'><br>This is not the Blogpost you are looking for.</h3>"
          document.getElementById('blogText').innerHTML = ''
        }
      }
    }
  }
  xhr.send(null)
}

function getFile (blog) {
  var file = new XMLHttpRequest()
  // console.log(blog.theBlog);
  file.open('GET', '../model/media/' + blog.theBlog)
  file.onload = function () {
    if (file.readyState === file.DONE) {
      if (file.status === 200) {
        // console.log(file.responseText);
        document.getElementById('blogText').innerHTML = file.responseText
      }
    }
  }

  file.send()
}

$(document).ready(function () {
  var counter = 0;
  
  $(".navBtn").click(function (params) {
    if(this.id != "week2" ){
      $(".pic").remove();
    }

  })


  $('#week2').click(function () {
    
    if(counter == 0){
    $(".parent").append('<img id="image1" class="pic img-fluid " src="../model/media/thatTrainBridge.jpg"/>');
    $(".parent").append('<img id="image2" class="pic img-fluid " src="../model/media/edinburgh.jpg"/>');
    $(".parent").append('<img id="image3" class="pic img-fluid " src="../model/media/castle.jpg"/>');
    
    InfiniteRotator.init();



    }
    
    counter++;
   });
});


var InfiniteRotator =
  {
      init: function()
      {
          //initial fade-in time (in milliseconds)
          var initialFadeIn = 1000;

          //interval between items (in milliseconds)
          var itemInterval = 5000;

          //cross-fade time (in milliseconds)
          var fadeTime = 0;

          //count number of items
          var numberOfItems = $('.pic').length;

          //set current item
          var currentItem = 0;

          //show first item
          $('.pic').eq(currentItem).fadeIn(initialFadeIn);

          //loop through the items
          var infiniteLoop = setInterval(function(){
              $('.pic').eq(currentItem).fadeOut(fadeTime);

              if(currentItem == numberOfItems -1){
                  currentItem = 0;
              }else{
                  currentItem++;
              }
              $('.pic').eq(currentItem).fadeIn(fadeTime);

          }, itemInterval);
      }
  };
 
 
  
 
  
  
  
  
  
  
  
  
  
  
  
//   $('#week1,#week2,#week3,#week4,#week5,#week6,#week7,#week8,#week9,#week10,#week11,#week12').click(function () {
//     if (this.id == 'week2') {
//       // alert(this.id);
//       $("#content").append('<img id="image1" class="img-fluid pic" src="../model/media/thatTrainBridge.jpg"/>');
//       $("#content").append('<img id="image2" class="img-fluid pic" src="../model/media/edinburgh.jpg"/>');
//       $("#content").append('<img id="image3" class="img-fluid pic" src="../model/media/castle.jpg"/>');
//       $("#image2").hide();
//       $("#image3").hide();
//       $("#content").append('<button class="btn btn-primary float-left" id="back">BACK');
//       $("#content").append('<button class="btn btn-primary float-right" id="next">NEXT');
//     }
//   });
//   var counter = 0;
//   $(document).on('click',"#next", function (counter) {
    
//    if ($(".pic").is("#image1")) {
//      counter = 1
//      console.log(counter);
     
//      theSwitch();
//    }else if (($(".pic").is("#image2"))) {
//      counter = 2
//      console.log(counter);

//      theSwitch();

//    } else if (($(".pic").is("#image3")))  {
//      counter = 3
//      console.log(counter);

//      theSwitch();

//    }
       
//   });

  





//   $(document).on('click',"#back", function () {
//     if($(".pic").is("#image1")){
//       $("#image1").remove();
//       $("#content").prepend('<img id="image3" class="img-fluid pic" src="../model/media/castle.jpg"/>');
//     }
//   });

//   $(document).on('click',"#back", function () {
//     if($(".pic").is("#image3")){
//        $("#image3").remove();
//        $("#content").prepend('<img id="image2" class="img-fluid pic" src="../model/media/edinburgh.jpg"/>');
//      }
//   });

//   $(document).on('click',"#back", function () {
//     if($(".pic").is("#image2")){
//        $("#image2").remove();
//        $("#content").prepend('<img id="image1" class="img-fluid pic" src="../model/media/thatTrainBridge.jpg"/>');
//      }
//   });
     
  
  
  
  
//   $('#back, #next').click(function () {
    
//     })
  
// });  

// function theSwitch (counter) {
  
//   switch (counter) {
//     case 1:

//       $(document).on("hide","#image1");
//       $('#image2').show();
      

//       break
//     case 2:
//       $('#image2').hide();
//       $('#image3').show();
      

//       break
//     case 3:
//       $('#image3').hide();
//       $('#image1').show();
      

//       break
//     default:
//       break
//   }
// }
  
  
//   //$("#content").append('<img id="image2" class="img-fluid pic" src="../model/media/edinburgh.jpg"/>');
//   //$("#content").append('<img id="image3" class="img-fluid pic" src="../model/media/castle.jpg"/>');
    
        
//     $("#image2").hide();
//     $("#image3").hide();
    


 
