<?php
  $cNIK_session = $this->session->userdata('cNIK_session');
  $cNmPegawai_session = $this->session->userdata('cNmPegawai_session');
  $cIDBag_session = $this->session->userdata('cIDBag_session');
  $cNmBag_session = $this->session->userdata('cNmBag_session');
  $cIDDept_session = $this->session->userdata('cIDDept_session');
  $cNmDept_session = $this->session->userdata('cNmDept_session');
  $cIDJbtn_session = $this->session->userdata('cIDJbtn_session');
  $cNmJbtn_session = $this->session->userdata('cNmJbtn_session');
  $cGroupID_session = $this->session->userdata('cGroupID_session');
  $cGroupNm_session = $this->session->userdata('cGroupNm_session');
  $company_id_session = $this->session->userdata('company_id_session');
  $photo_session = $this->session->userdata('photo_session');
  $key_session = $this->session->userdata('key_session');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title><?php echo $title; ?></title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/corona/template/assets/vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/corona/template/assets/vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/corona/template/assets/vendors/jvectormap/jquery-jvectormap.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/corona/template/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/corona/template/assets/vendors/owl-carousel-2/owl.carousel.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/corona/template/assets/vendors/owl-carousel-2/owl.theme.default.min.css">

    <link rel="stylesheet" href="<?php echo base_url(); ?>style/datatables/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/datatables/dataTables.bootstrap5.min.css">

    <link href="<?php echo base_url(); ?>style/multiple-selector/select2.min.css" rel="stylesheet" />

    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="<?php echo base_url(); ?>style/corona/template/assets/css/style.css">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="<?php echo base_url(); ?>style/corona/template/assets/images/favicon.png" />
  </head>
  <body>
    <div class="container-scroller">
      <!-- partial:partials/_sidebar.html -->
      <?php $this->load->view($menu); ?>
      <!-- partial -->
      <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->

        <?php $this->load->view($header); ?>

        <!-- partial -->
        <div class="main-panel">

          <?php $this->load->view($page); ?>

          <!-- partial:../../partials/_footer.html -->
          <footer class="footer">
            <div class="d-sm-flex justify-content-center justify-content-sm-between">
              <span class="text-muted d-block text-center text-sm-left d-sm-inline-block">Copyright © bootstrapdash.com 2021</span>
              <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center"> Free <a href="https://www.bootstrapdash.com/bootstrap-admin-template/" target="_blank">Bootstrap admin template</a> from Bootstrapdash.com</span>
            </div>
          </footer>
          <!-- partial -->
        </div>

        <!-- main-panel ends -->
      </div>
      <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->

    <!-- plugins:js -->
    <script src="<?php echo base_url(); ?>style/corona/template/assets/vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="<?php echo base_url(); ?>style/corona/template/assets/vendors/chart.js/Chart.min.js"></script>
    <script src="<?php echo base_url(); ?>style/corona/template/assets/vendors/progressbar.js/progressbar.min.js"></script>
    <script src="<?php echo base_url(); ?>style/corona/template/assets/vendors/jvectormap/jquery-jvectormap.min.js"></script>
    <script src="<?php echo base_url(); ?>style/corona/template/assets/vendors/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="<?php echo base_url(); ?>style/corona/template/assets/vendors/owl-carousel-2/owl.carousel.min.js"></script>
    <script src="<?php echo base_url(); ?>style/corona/template/assets/js/jquery.cookie.js" type="text/javascript"></script>
    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="<?php echo base_url(); ?>style/corona/template/assets/js/off-canvas.js"></script>
    <script src="<?php echo base_url(); ?>style/corona/template/assets/js/hoverable-collapse.js"></script>
    <!-- <script src="<?php echo base_url(); ?>style/corona/template/assets/js/misc.js"></script> -->
    <script src="<?php echo base_url(); ?>style/corona/template/assets/js/settings.js"></script>
    <script src="<?php echo base_url(); ?>style/corona/template/assets/js/todolist.js"></script>
    <!-- endinject -->


    <script src="<?php echo base_url(); ?>style/jquery/jquery-3.5.1.js"></script>
    <script src="<?php echo base_url(); ?>style/datatables/jquery.dataTables.min.js"></script>
    <script src="<?php echo base_url(); ?>style/datatables/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/fixedcolumns/4.1.0/js/dataTables.fixedColumns.min.js"></script>
    
    <script src="<?php echo base_url(); ?>style/select2/select2.min.js"></script>
    
    <script type="text/javascript">
      var base_url = '<?php echo base_url(); ?>';
      var key_session = '<?php echo $key_session; ?>';
      var company_id_session = '<?php echo $company_id_session; ?>';
      console.log(key_session);
    </script>
    <script src="<?php echo base_url(); ?>assets/js/<?php echo $page; ?>.js"></script>
  </body>
</html>