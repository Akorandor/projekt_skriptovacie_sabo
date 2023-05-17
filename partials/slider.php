 <?php include 'inc/database.php'; ?>

 <div class="projects section" id="projects">
    <div class="container">
      <div class="row">
        <div class="col-lg-6">
          <div class="section-heading">
            <h2>Discover Our <em>Work</em> &amp; <span>Projects</span></h2>
            <div class="line-dec"></div>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed doers eiusmod.</p>
          </div>
        </div>
      </div> 
    </div>
    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-12">
          <div class="owl-features owl-carousel">
            


<?php
    // Získanie zoznamu projektov z databázy
    $sql = "SELECT * FROM projekty ORDER BY datum_vytvorenia DESC LIMIT 5"; 
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="item">';
         echo '<img src="' . $row["obrazok"] . '" alt="">';
         echo '<div class="down-content">';
            echo '<h4>' . $row["nazov"] . '</h4>';
            echo '<a href="' . $row["link"] . '"><i class="fa fa-link"></i></a>';
            echo '</div>';
            echo '</div>';
        }
    } else {
        echo "Žiadne projekty sa nenašli.";
    }

    $conn->close();
?>



       
           
           
           
          </div>
        </div>
      </div>
    </div>
  </div>