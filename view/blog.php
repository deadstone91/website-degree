<!DOCTYPE html>
<html lang="en">
<head>
    <title>Blog</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>
<!--<?php
  $get = $_GET['week'];
  if($get == 1){
    echo "<script>document.getElementById('tab'".$get.").focus()</script>";

      die();
}
?>-->
<div class="container mt-3">
    <h2>College Blog for Shona</h2>
    <br>
    <!-- Nav tabs -->
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a id="home_tab" class="nav-link active" data-toggle="tab" href="#home">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#blog1" id="week1">Week 1</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#blog2" id="week2">Week 2</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#blog3" id="week3">Week 3</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#blog4" id="week4">Week 4</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#blog5"  id="week5">Week 5</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#blog6"  id="week6">Week 6</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#blog7"  id="week7">Week 7</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#blog8"  id="week8">Week 8</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#blog9"  id="week9">Week 9</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#blog10"  id="week10">Week 10</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#blog11" id="week11">Week 11</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-toggle="tab" href="#blog12" id="week12">Week 12</a>
        </li>


    </ul>

    <!-- Tab panes -->
    <div class="tab-content">
        <div id="home" class="container tab-pane active"><br>
            <h3>HOME</h3>
            <p>Nothing to see here</p>
        </div>
        <div id="blog1"  class="container tab-pane fade"><br>
            <h3>Week 1</h3>
            <p> 1. On the news site i have used the grid system used in bootstrap 4 to create 3 columns, i hav used <i>class="col-sm-4"</i> to create a a column of width 4 out of 12 and done this three times in a row to create the columns.<br>
            2. <strong>a diagram will be added here</strong><br>
                3. Bootstrap makes it really easy to create a menu system as long as you know what class to call from the css-bootstrap document. With the blog i use <i>class="nav nav-tabs"</i> for the tab menu and add tabs to it using <i>class="nav-item"</i>.
            </p>
        </div>
        <div id="blog2" class="container tab-pane fade"><br>
            <h3>Week 2</h3>
            <p><strong>Normalisation</strong><br>As asked in the practical for this week i have normalised what i think are the attributes in the database that we would need for our news website.</p>
            <div class="container">
                <div class="row">
                    <div class="cm-sm-11">
                        <img src="../model/media/normalisation.JPG" class="img-fluid">
                    </div>
                </div>

            </div>

        </div>
        <div id="blog3" class="container tab-pane fade"><br>
            <h3>Week 3</h3>
            <p>
                <strong>Appraisal of API</strong><br>
                As asked for in this week's tasks i have implemented an api that sends json back to the view. It took me quite a bit of time to fathom how to integrate the api int my existing connection to my mysql database.<br> My database connection file was written procedurally but had to implement object orientation to get the api to connect to it smoothly. I personally preferred the website not using the api because it felt like an easier, simpler was to do it. But i can totally see the reason why it is used, it provides a quick and easy way to get what you need by just joining to a specific function in the api. I used the files provided through ilearn to base my API from and maanaged with a bit of work to get it too work. i originally had the sql written in php on the view and then sent it to the database, with the use of the api it removes the sql from the view into the api like in this code sample:
                <pre>
                    <code>
                        function getAllItems()
                        {
                            global $connection;
                            $sql = "SELECT * FROM items ORDER BY item_id DESC ";
                            $result = mysqli_query($connection,$sql);
                            //var_dump($result);

                            while($r = mysqli_fetch_assoc($result))
                            {
                            $count = 0;
                            $rows[] = $r;
                            $count++;
                            }
                            //var_dump(json_encode($rows));
                            return json_encode($rows);
                        }
                    </code>
                </pre>
            As seen in the code above, this is the API section for getting all items from the database, which then returns as asked the results in json using the rows variable.<br>Advantages of using an api, from what i can see is reuseablility, if an any point i need to get all the items again, it will be easy to do. same with needing to get a specific page at any point i can just connect using its id really easily.<br>Another advantage i can think of would be for safety reasons. keeping the database at arms length as to say means it would be harder to hack into rather than an easy direct join to it. I have enjoyed trying to code it for the fact it is helping me to learn some of the more complex sides of web design.
            </p>
        </div>
        <div id="blog4" class="container tab-pane fade"><br>
            <h3>Week 4</h3>
            <p><h6 class="text-center">Security</h6><br>
            This week we were to create the ability to register and login to the news site. Along with this we were asked to add security features to these. we will look at 4 i've added. <br><strong>1. </strong> The first form of security i have used is hashing. Hashing is where we take data, run it through a pre-defined algorithm which changed the data into a random defined length of text. I decided to use "sha512" for the algorithm. The reason that I chose this one over another was for the reason this one creates a line of text 128 characters long and felt this seemed a most safe method. To be honest though i dont really undertand the difference between one hashing algorithm over another but at least it does have the private data stored safely.<br>
            <strong>2. </strong> The data i hashed was the password, but this was not the only security i added  to the password. when saving the password i also salted it, not just once but twice. What is salting i hear you say? it is the method of creating adding random data to the data that is being secured. I decided that i would salt the front and the rear of the password. As long as a hacker cannot obtain these the data should be safe, but the issue being all users passwords are being salted with the same "random" data front and back. I think this is a good security feature.<br>
            <strong>3. </strong> Another security feature used is that of using prepared statements for the sql data that will be sent to the server. The art of using prepared statments is that you send the sql statement seprately to the server than the data it is sending, this is an interesting concept, making it harder for hackers to use sql injection. i personally dont fully understand how it works but obviously i do unstand that we want the data to be a secure as possible. <br>
            <strong>4. </strong> The forth security i used was using sessions, this would allow the user and only the user to be able to use the comments of the pages that they would be signed in for. i use the id of the user taken from the database as their unique session id, i should really also have a random token, but didn't feel that it was necessary. I haven't as of the point of writing this implimented logout but when i do i do plan to have the session be destroyed. </p>
        </div>
        <div id="blog5" class="container tab-pane fade"><br>
            <h3>Week 5</h3>
            <p>Security<br>1. I have implemented sessions into my news website, the impact that sessions have on the article creation section of the website is that if the user doesn't have an account the article creation button is not visible. it only appears when there is a session. Trying to access this feature is also not possible even if you put in into the url, this allows for a strong secure website.<br>
                2. Another security feature i ave implemented is a javaScript file that runs when the form is submitted, this checks the title,description and the article for greater than and less than symbols. The reason for this is to not allow html to be written into these boxes and mess with the website. I feel this is an easy to implement form of security that i hope to remember to use when i myself will be developing websites in the future.<br>
                3. Another safety feature used is in the php code in the background, here i have used prepared statements for the accessing of the database to insert the data. I, when first using prepared statements didn't understand the need for them, i found that there was "quicker" ways to insert the data to the database, but i have come to realise that more important than ease of coding is the safety of my user data.<br>
                4. A forth way that security has been implemented is when the image is to be uploaded i have the form itself validate that only images can be entered into it. This security feature is also present in the PHP file where i check if the images are of any of 4 different image file types. This should make sure that file types other than these can't be put into the file upload, this should stop people from adding other files that could harm the web server or the computers of those viewint the website.
            </p>
        </div>
        <div id="blog6" class="container tab-pane fade"><br>
            <h3>Week 6</h3>
            <p>MVC</p><br>
            <div class="col-sm-12">

                <img class="img-fluid" src="../model/media/MVC-teardown.png"><br>
            </div>


            <p>FRAMEWORKS</p><br>
            <p>A framework is a collection of code created to make the creation of software/websites easier. How easier? if you were to create something from the ground up you could take a long time trying to get complicated code to work. A framework allows the user to use code already written so you don't have to. An example that comes to mind it that of bootstrap a framework for CSS. Instead of writing complicated CSS script for the UI, a small class call in an element will style the element for you according to the styling built into the framework. There is many advantages. One is that of efficiency, Instead of possibly wasting time coding the same code over and over in the development process, the code will already be written an all one has to do is call that code into use. This had an advantage for both the developer and also the client. The more efficient, the shorter the time of development and then possible cost savings for the client. Disadvantages of using a framework is that you end up learning the nuances of the framework but don't actually learn the code itself, meaning in some fashion that you abilities might be compromised by the framework. With Bootstrap classes are used for implementing the framework. example of this is shown below.<br>
                <code>
                    class="col-sm-12"
                </code> <br>
This piece of code could be used with a div to control CSS grid and reactive screen size, but how does it work, tbh i dont really know because i've used it but never really invested time into learning the code, exactly the issue mentioned as a disadvantage.
            </p>
        </div>
        <div id="blog7" class="container tab-pane fade"><br>
            <h3>Week 7</h3>
            <p> Feedback week!!</p>
        </div>
        <div id="blog8" class="container tab-pane fade"><br>
            <h3>Week 8</h3>
            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
        </div>
        <div id="blog9" class="container tab-pane fade"><br>
            <h3>Week 9</h3>
            <p>Jquery mobile<br>
            After having a very unsuccessful time with jquery mobile, i have come to the conclusion that there is many better and easier ways to do the same thing. I feel that this mobile attempt was a waste of there time when simple html pages that can be viewed on a mobile can do the same thing with a lot less work than it seeems need to be put in to get jquery mobile working. I do have to admit that because of me missing some of the coourse i didn't get the time to dedicate as much time to this as maybe would of shown me that it was a worthwhile endevour. i do think that the developers themselves feel that it is a useless aplication for the fact that there has not been support in the design of this for some years now. I do underdtand that one of the reason that it was developed was to created a small application that could do quite a bit and true i did find that the file size was really small, which at least if i have anything positive to say is that it is efficent it what it can do for how much its size is.</p>
        </div>
        <div id="blog10" class="container tab-pane fade"><br>
            <h3>Week 10</h3>
            <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
        </div>
        <div id="blog11" class="container tab-pane fade"><br>
            <h3>Week 11</h3>
            <p>This week we were asked to develop some sort of RSS feed for our website, i quite enjoy using xml to write the feed data, this can nbe found in the rss sign at the bottom of my website. i didn't manage to write a dtt or xslt but i did manage to use some xpath for the use with the api that i will mention in the next part of this blog. I think the id of providing, or even picking up an rss feed for a website is good, it seems as though that information is concise and that it provides information. When i was doing this i came across rss feeds for stuff like google news, this of good interest because got to see that it provides information but doesn't need to be asin depth as the origal plave that it comes from. I think it thefuture it is something i may consider using in my own website. </p>
        </div>
        <div id="blog12" class="container tab-pane fade"><br>
            <h3>Week 12</h3>
            <p><strong>API</strong><br>Of all he things i have done it this website, this was one of the most interesting for me. I had never looked at an api before apart from the idea of making my own ones for making articles, customers and comments. I used a weather api and have it linked at the top of the website, i used xpath ti parse the data from the xml that was sent back from the api, i used a generic location, that of edinburgh ang choose to get the time and current temperature form it. Looking around the internet there is a lot of Apis, i am saddened though that a large amount of them do not have free versions for trying, the weather api i am using is free to use till february. i can see a great reason to use apis especially if they have something that correspond to what your website does, i personally couldn't find an adequate gaming one that i could use. i feel i would use an api on a personal one if i could find free ones.    </p>
        </div>
    </div>
</div>

</body>
</html>
