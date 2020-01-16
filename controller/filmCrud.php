<?php
   require '../model/database.php';
   //var_dump(4);
   $db = new databaseCon();
   $connection = $db->connection();
   if(!$connection){
        echo "Lost Connection";
        var_dump(6);
   }
  
   if($_GET){
      if($_GET['f']){
         if ($_GET['f'] == 'one'){
            getAllFilmDetails();
         }
      }elseif ($_GET['id']) {
         getFilmById($_GET['id']);
      }elseif ($_GET['film']) {
         getReviewByFilmId($_GET['film']);
      }
   }

   if(isset($_POST['myData'])){
      
      
      $revData = $_POST['myData'];
      $r = $revData['rating'];
      $fid =  $revData["filmid"];
      $u = $revData["user"];
      $t = $revData["title"];
      $b = $revData["blurb"];
      
      //echo var_dump($_POST['myData']);
      setReview($fid,$t,$b,$u,$r);

   }

   if(isset($_POST['filmId'])){
      echo getAvgReview($_POST['filmId']);
      //echo "daft return";
   }

   if (isset($_POST['averageData'])) {

      $data = $_POST['averageData'];
      $average = $data['average'];
      $id = $data['id']; 

      setAvgReview($average,$id);
   }
   
   if(isset($_FILES)){
      error_log("file arrived");
      $target_dir = "../model/media/";
      $target_file = $target_dir . $_FILES;
      move_uploaded_file($_FILES, $target_file);
   }
   /* if(isset($_POST['filmUpload'])){
      error_log("formData happens");
   } */
   
    if(isset($_POST['filmUpload'])){
      error_log('GOT HERE');
      $data = $_POST['filmUpload'];
      $filmTitle = $data['filmTitle'];
      $filmDirector = $data['filmDirector'];
      $filmActors = $data['filmActor'];
      $filmGenre = $data['filmGenre'];
      $filmDate = $data['filmDate'];
      $filmSynopsis = $data['filmSynopsis'];
      $filmPoster = $data['filmPoster'];


      setFilm($filmTitle,$filmDirector, $filmActors,$filmGenre, $filmDate,$filmSynopsis,$filmPoster);
   } 

   function getAllFilmDetails()   //get all film details - returned as a Json file
   {
      global $connection;
      //echo "testing";
      $sql = "SELECT * FROM films ORDER BY f_id ASC";
      $result = mysqli_query($connection,$sql);
      while($r = mysqli_fetch_assoc($result))
      {
         $rows[] = $r;
      }
      echo json_encode($rows); 
   }

   function getFilmById($id)
   {
      global $connection;
      $sql = "SELECT * FROM films WHERE f_id =".$id;
      
      $result = mysqli_query($connection,$sql);
      while($r = mysqli_fetch_assoc($result))
      {
         $rows[] = $r;
      }
      echo json_encode($rows);
   }

   function getReviewByFilmId($film)
   {
      global $connection;
      $sql = "SELECT * FROM reviews WHERE f_id =".$film;
      
      $result = mysqli_query($connection,$sql);
      while($r = mysqli_fetch_assoc($result))
      {
         $rows[] = $r;
      }
      echo json_encode($rows);
   }

   function setReview($fid,$t,$b,$u,$r)
   {
      global $connection;
     

    $sql = "INSERT INTO reviews(f_id,r_title,r_blurb,r_date,r_star,r_user) values(?,?,?,?,?,?)";

    $stmt = $connection->prepare($sql);
    $date = date("Y-m-d");
    //var_dump($date);
    $stmt->bind_param("isssis",$fid,$t,$b,$date,$r,$u);
    If($stmt->execute())
    {
        error_log("Sql Sucess");
    }
   }

   function getAvgReview($film)
   {
      global $connection;
      $sql = "SELECT r_star FROM reviews WHERE f_id =".$film;
      
      $result = mysqli_query($connection,$sql);
      while($r = mysqli_fetch_assoc($result))
      {
         $rows[] = $r;
      }

      return json_encode($rows);
   }

   function  setAvgReview($avg, $id)
   {
      global $connection;

      $sql = "UPDATE films SET f_avg = ? WHERE f_id = ?" ;
      $stmt = $connection->prepare($sql);
      $stmt->bind_param("ii",$avg,$id);
      If($stmt->execute())
      {
          error_log("Sql Sucess");
      }
   }

   function setFilm($filmTitle,$filmDirector, $filmActors,$filmGenre, $filmDate,$filmSynopsis,$filmPoster)
   {
      global $connection;
      error_log("GOT HERE ALSO");

      $sql = "INSERT INTO films(f_title,f_release_date,f_director,f_lead_actors,f_genre,f_blurb,f_poster) VALUES(?,?,?,?,?,?,?)";

      $stmt = $connection->prepare($sql);
      $stmt->bind_param("sssssss",$filmTitle,$filmDate,$filmDirector, $filmActors,$filmGenre, $filmSynopsis,$filmPoster);
    
      If($stmt->execute())
    {
        error_log("Sql Success");
    }
   }
?>