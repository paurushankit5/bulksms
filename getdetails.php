<!DOCTYPE html>
<html lang="en">
<head>
  <title>Find Your Details</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

  <style>
    /* Set height of the grid so .sidenav can be 100% (adjust if needed) */
    
     
   
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height: auto;} 
    }
  </style>
</head>
<body>

<div class="container">
  <div class="row content">
     <?php
      require_once __DIR__.'/config.php';
      //echo 1;
      if(isset($_GET['id']))
      {
        extract($_GET);
        //echo $id;
        mysqli_set_charset($con,'utf8');

        $row = mysqli_query($con,"select * from bjp3 where id= '$id'");
        $a = mysqli_fetch_assoc($row);
        ?>
          <br>
          <br>
          <div class="col-md-6 col-md-offset-3">
          <table class="table table-responsive table-bordered table-striped">
            <?php
              if(count($a))
              {
                ?>
                    <tr>
                      <th colspan="2"><h3 class="text text-center">Vote for 2019 Lok Sabha Elections</h3></th>
                    </tr>
                    <tr>
                      <th>Name</th>
                      <th><?= $a['fm_name_en'] ?></th>
                    </tr>
                    <tr>
                      <th>Father's Name</th>
                      <th><?= $a['rln_fm_nm_en'] ?></th>
                    </tr>
                    <tr>
                      <th>DOB</th>
                      <th><?= date('d-M-Y', strtotime($a['dob'])) ?></th>
                    </tr>
                    <tr>
                      <th>Mobile</th>
                      <th><?= $a['mobile'] ?></th>
                    </tr>
                    <tr>
                      <th>Booth No.</th>
                      <th>26</th>
                    </tr>
                    <tr>
                      <th>Booth No.</th>
                      <th>Rohtak Haryana</th>
                    </tr>

                <?php   
              }
            ?>
          </table>
        </div>
        <?php
        

      }
      else{
        ?>
          <h1>Invalid URL</h1>
        <?php
      }


     ?>
  </div>
</div>



</body>
</html>
