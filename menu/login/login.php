<?php 
// session_start();
// error_reporting(0);
// include "config/koneksi.php"; 
// include "psb/config/fungsi_indotgl.php"; 
// include "psb/config/library.php"; 
// include "psb/config/class_paging.php"; 
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>Sistem Penerimaan Siswa Baru - Dedukasi Edukasi Kualiva (DEK) Padang</title>
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="psb/asset/css/style.css" rel="stylesheet">
    <link href="psb/asset/css/datepicker.css" rel="stylesheet">
    <script src="psb/asset/js/jquery.js"></script>
    <script type="text/javascript">
      $(document).on("click", ".open-AddBookDialog", function () {
           var myBookId = $(this).data('id');
           var myBookId1 = $(this).data('id1');
           var myBookId2 = $(this).data('id2');
           var myBookId3 = $(this).data('id3');
           var myBookId4 = $(this).data('id4');
           var myBookId5 = $(this).data('id5');
           var myBookId6 = $(this).data('id6');
           $(".modal-body #bookId").val( myBookId );
           $(".modal-body #bookId1").val( myBookId1 );
           $(".modal-body #bookId2").val( myBookId2 );
           $(".modal-body #bookId3").val( myBookId3 );
           $(".modal-body #bookId4").val( myBookId4 );
           $(".modal-body #bookId5").val( myBookId5 );
           $(".modal-body #bookId6").val( myBookId6 );
      });
    </script>
  </head>

<body>
  <div class="container-fluid">

      <nav class="navbar navbar-default">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>

          <div id="navbar" class="navbar-collapse collapse">
            <?php 
              include "psb/menu.php"; 
            ?>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </nav>

  <div class="post text">

<?php 
  if (isset($_GET['kode'])){ 
      echo "<div class='col-md-12'>";
         include "psb/content.php";
      echo "</div>";
  }else{
      echo "<div class='col-md-2'>";
          include "psb/sidebar.php";
      echo "</div>";

      echo "<div class='col-md-10'>";
      include "psb/content.php";
      echo "</div>";
  }
?>
  
      <?php include "psb/modal.php"; ?>
    </div>
</div>
 <!-- /container -->





    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="psb/asset/js/prettify.js"></script>
    <script src="psb/asset/js/bootstrap.min.js"></script>
    <script src="psb/asset/js/jquery.validate.js"></script>
    <script> $(document).ready(function(){ $("#formku").validate(); }); </script>
    <script src="psb/asset/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript">
        // When the document is ready
        $(document).ready(function () {
          $('#datepicker1').datepicker({
              format: "dd-mm-yyyy"
          });  
        });

        $(document).ready(function () {
          $('#datepicker2').datepicker({
              format: "dd-mm-yyyy"
          });  
        });

        $(document).ready(function () {
          $('#datepicker3').datepicker({
              format: "dd-mm-yyyy"
          });  
        });

        $(document).ready(function () {
          $('#datepicker4').datepicker({
              format: "dd-mm-yyyy"
          });  
        });

        $(document).ready(function () {
          $('#datepicker5').datepicker({
              format: "dd-mm-yyyy"
          });  
        });

        $(document).ready(function () {
          $('#datepicker6').datepicker({
              format: "dd-mm-yyyy"
          });  
        });

        $(document).ready(function () {
          $('#datepicker7').datepicker({
              format: "dd-mm-yyyy"
          });  
        });

        $(document).ready(function () {
          $('#datepicker8').datepicker({
              format: "dd-mm-yyyy"
          });  
        });

        $(document).ready(function () {
          $('#datepicker2').datepicker({
              viewMode: 'years',
              format: "mm-yyyy"
          });  
        });
      </script>
  </body>
</html>
