<?php include 'inc/database.php'; ?>
<?php include 'partials/loader.php'; ?>
<?php include 'partials/header.php'; ?>



<div class="infos section" id="infos">
    <div class="container">
      <div class="row">
        <div class="col-lg-12">
          <div class="main-content">
            <div class="row">
              <div class="col-lg-6">
                <div class="left-image">
                  <img src="assets/images/left-infos.jpg" alt="">
                </div>
              </div>
              <div class="col-lg-6">
                <div class="section-heading">
                
   
   <?php

$sql = "SELECT email, name FROM kontakt ORDER BY id DESC LIMIT 1"; // Získajte posledný riadok z databázy
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();
  $email = $row['email'];
  $name = $row['name'];


  echo "<h1>Ďakujem za váš email $name</h1>";}

  $conn->close();
?>
                  
                  
                  
                  
                  <div class="line-dec"></div>
                  <p>You are free to use this template for any purpose. You are not allowed to redistribute the downloadable ZIP file of Tale SEO Template on any other template website. Please contact us. Thank you.</p>
                </div>
           
              
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>









<?php include 'partials/footer.php';?>
<?php include 'partials/script.php';?>