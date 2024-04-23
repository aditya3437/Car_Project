<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Header</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="header-panel">
  <img src="Header.png" alt="">
</div>
<div class="header-panel">
  <img src="subImage.png" alt="">
</div>
<div class="header">
  <img src="subHedaer.png" alt="">
</div>
<div class="coursel">
  <img src="cover.jpg" alt="">
</div>

<div class="containers">
  <p class="para">SELECT VEHICLE<br><img src="line.png" alt="" class="center"></p>
  <!-- form field -->

  <form action="" method="post">
    <div class="formstable">
      <div class="col-md-2">
        <label for="Years">Year</label>
        <select name="Years" id="site-year-list" class="form-select">
          <option value="">Year</option>
          <?php
          include('dbconn.php'); 
          $yearsQuery = "SELECT DISTINCT `Year` FROM `cars`"; 
          $yearsResult = mysqli_query($connection, $yearsQuery);

          if ($yearsResult) {
            while ($yearRow = mysqli_fetch_assoc($yearsResult)) {
              ?>
              <option value="<?php echo $yearRow['Year']; ?>"><?php echo $yearRow['Year']; ?></option>
              <?php
            }
            mysqli_free_result($yearsResult);
          } else {
            echo "Error: " . mysqli_error($connection);
          }
          ?>
        </select>
      </div>
      <div class="col-md-2">
        <label for="Makes">Make</label>
        <select name="Makes" id="site-make-list" class="form-select">
          <option value="">Make</option>
          <?php
          include('dbconn.php'); 
          $makesQuery = "SELECT DISTINCT make FROM cars"; 
          $makesResult = mysqli_query($connection, $makesQuery);

          if ($makesResult) {
            while ($makeRow = mysqli_fetch_assoc($makesResult)) {
              ?>
              <option value="<?php echo $makeRow['make']; ?>"><?php echo $makeRow['make']; ?></option>
              <?php
            }
            mysqli_free_result($makesResult);
          } else {
            echo "Error: " . mysqli_error($connection);
          }
          ?>
        </select>
      </div>
      <div class="col-md-2">
        <label for="Models">Model</label>
        <select name="Models" id="site-model-list" class="form-select">
          <option value="">Model</option>
        </select>
      </div>
      <br>
      <div class="col-md-1 class-button-visble-find">
        <button name="filtered" type="submit" class="btn btn-primary">Find</button>
        <button name="resetbtn" type="reset" class="btn btn-primary custom-btn">reset</button>
      </div>
    </div>
  </form>

</div>
<p class="para">NEW ARRIVALS<br><img src="line.png" alt="" class="center"></p>
<div class="box-contain">
  <?php
  if (isset($_POST['filtered'])) {
    include('dbconn.php'); 
    $year = $_POST['Years'];
    $make = $_POST['Makes'];
    $model = $_POST['Models'];
    if(!empty($model) && !empty($make) && !empty($year)) {
      $query = "SELECT * FROM `cars` WHERE Year = '$year' AND make = '$make' AND model = '$model'"; 
    }else{
      $query = "SELECT * FROM `cars`"; 
    }
  }else{
    $query = "SELECT * FROM `cars`"; 
   }
   
      $result = mysqli_query($connection, $query);
      while ($row = mysqli_fetch_assoc($result)) {
       $id =  $row['id'];
       $Name =  $row['Name'];
       $make =  $row['make'];
       $Year =  $row['Year'];
       $Model =  $row['Model'];
       $Price =  $row['Price'];
       $image =  $row['Image'];
      
      ?>
            <div class="box">
            <img src="<?php echo $image; ?>" alt="">
            <div class="hover">
            <p><?php echo $Year.' - '.$make .'-'. $Model .', '. $Name;?></p>
            <p><?php echo $Price;?></p>
            </div>
          </div>
          <?php 
          }
         
           ?>
               
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){

  $(".class-button-visble-find").hide();

  $("#site-make-list").change(function(){
    var make = $(this).val();
    var year = $("#site-year-list").val();
    $.ajax({
      url: "getmodel.php", 
      method: "POST",
      data: {make: make, year: year},
      success: function(data) {
        $("#site-model-list").html(data);
      }
    });
  });

  $("#site-model-list").change(function(){
        $(".class-button-visble-find").show();
    });

    $('.hover').hover(
        function() {
            var hoverImage = $('<img src="hover.png" alt="Hover Image">');
            $(this).append(hoverImage);
        },
        function() {
            $(this).find('img').remove();
        }
    );

});
</script>

</body>
</html>
