<?php 
// connecting to DB
$servername = "localhost";
$username = "root";
$pass = "";
$database = "noteApp";
$insert = false;
$update = false;
$delete = false;

$conn = mysqli_connect($servername, $username, $pass, $database);
if(!$conn){
    die("The Database didn't connect" . mysqli_query_error());
}
else{
    // echo "The Database has been connected successfully..!";
};


// CRUD Operations:

// 1. Delete 
// we used GET for Delete and Select query 
// And we used POST for Insert and Update query
if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
  $deleteData = "DELETE FROM `notes` WHERE `sno` = $sno";
  $result = mysqli_query($conn, $deleteData);
  if($result){
    $delete = true; 
  }

}
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
  // 1. Update: 
  if(isset($_POST['snoEdit'])){
    
    //  echo "yes" ; 
    // update the record
    
    $sno = $_POST["snoEdit"];
    $title = $_POST["titleEdit"];
    $desc = $_POST["descEdit"];
    // SQL Query for update insertion 
    //  $updateData = "UPDATE `notes` SET `title` = '$title' AND `desc` = '$desc'  WHERE `notes`.`sno` = $sno";
    $updateData = "UPDATE `notes` SET `title` = '$title', `desc` = '$desc' WHERE `notes`.`sno` = $sno";
    $result = mysqli_query($conn, $updateData);
    
     if($result){
    $update = true; 
    }
      //  else {
  //    echo "the record couldn't update " . mysqli_error($conn);
  // }
  
  
}
  
else{
  // 2. Create: 
  $title = $_POST["title"];
  $desc = $_POST["desc"];
  
  
  // SQL Query for insertion 
  $insertData = "INSERT INTO `notes` (`title`, `desc`) VALUES ('$title', '$desc')";
  $contactData = mysqli_query($conn, $insertData);
    
    if($contactData){
    $insert = true; //on inserted data
    }
    else {
      echo "the record couldn't saved in Database " . mysqli_error($conn);
    }
  }

}

// 2.Read:


// 4. Delete: 

?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

    <!-- Data Table CSS   -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css">
  
    
    
    <title>Project 1 - iNotes</title>

    
  </head>
  <body>
    

<!-- Modal for Edit Action  -->
<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Edit your Note</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <form action="/natu/CRUDAPP/index.php" method="POST">
      <div class="modal-body"> 
      <input type="hidden" name="snoEdit" id="snoEdit">
      <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control" id="titleEdit" name="titleEdit" required="required">
    </div>
  <div class="mb-3">
    <label for="description" class="form-label">Description</label>
    <textarea name="descEdit" id="descEdit" cols="30" rows="5" class="form-control" required="required"></textarea>
  </div>
  </div>
  <div class="modal-footer d-block mr-auto">
  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
  <button type="submit" class="btn btn-primary">Save changes</button>
  </div> 
  </form>
  </div>
  </div>
  </div>



  <!-- Navbar  -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">iNotes</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="#">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact Us</a>
        </li>
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>


<!-- after nav Alert  -->
<!-- For Insertion  -->
<?php 
if($insert){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
     <strong>Congrats!</strong> your note has been saved. Successfully!.. 
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>';
        }
?>
<!-- For Updation -->
<?php 
if($update){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
     <strong>Congrats!</strong> your note has been updated. Successfully!.. 
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>';
        }
?>
<!-- For Delete  -->
<?php 
if($delete){
  echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
     <strong>Congrats!</strong> your note has been deleted. Successfully!.. 
     <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>';
        }
?>


<!-- Form of Add Note  -->
<div class="container" style="margin:4rem auto">
  <h2>Add a Note</h2>
<form action="/natu/CRUDAPP/index.php" method="post">
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control" id="title" name="title" required="required">
  <div class="mb-3">
    <label for="desc" class="form-label">Description</label>
    <!-- <input type="password" class="form-control" id="exampleInputPassword1"> -->
    <textarea name="desc" id="desc" cols="30" rows="5" class="form-control" required="required"></textarea>
  </div>
  <button type="submit" class="btn btn-primary">Save</button>
</form>
</div>



<div class="container" style="margin-top:4rem">
    <?php 

    // for inserting data into SQL 
    // $sql = "INSERT INTO `notes` (`sno`, `title`, `description`, `date`) VALUES (NULL, 'Buy Books', 'Hey Ahad,  i bought some interesting books for you. ', current_timestamp());";
    // $result = mysqli_query($conn, $sql);

    ?>

<table class="table" id="myTable">
  <thead>
    <tr>
      <th scope="col">S.No</th>
      <th scope="col">Title</th>
      <th scope="col">Description</th>
      <th scope="col">Time</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
      <!-- For Reading data by SELECT Query  -->
      <?php 
      $sql = "SELECT * FROM `notes`" ;
      $result = mysqli_query($conn, $sql);
      $sno = 0;
      //yeh var "sno" isliye kiya hai kyunke hum jab bhi data delete krengy toh table mie serial num mei farq nhi aega 
      // or woh dhang se serial mei rahega
      while($row = mysqli_fetch_assoc($result)){
        $sno = $sno +1;
        echo "  <tr>
            <th scope='row'>" . $sno . "</th>
            <td>" . $row['title'] . "</td>
            <td>" . $row['desc'] . "</td> 
            <td>" . $row['date'] . "</td> 
            <td> <button class='edit btn btn-sm btn-primary m-2' id=". $row['sno'].">Edit</button> / <button class='delete btn btn-sm btn-primary' id=d". $row['sno'].">Delete</button></td> 
          </tr> ";
      }
      ?>
    
  </tbody>
</table>
</div>
<hr>


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-U1DAWAznBHeqEIlVSCgzq+c9gqGAJn5c/t99JyeKa9xxaYpSvHU5awsuZVVFIhvj" crossorigin="anonymous"></script>

  

    <!-- Jquerry cdn  -->
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
    
    <!-- Data Table Jquery -->
    <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
    <!-- by Data Table  -->
    <script>
      $(document).ready( function () {
      $('#myTable').DataTable();
      } );
    </script>  





</body>

<!-- JS for Edit Modal  -->
  <script src="app.js"></script>


</html>