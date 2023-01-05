<!-- ======= Footer ======= -->
<footer id="footer" class="footer">
  <div class="copyright">
    &copy; Copyright <strong><span><?= WEBSITE_NAME ?></span></strong>. All Rights Reserved
  </div>
</footer><!-- End Footer -->

<a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

<!-- Vendor JS Files -->
<script src="<?= WEBSITE ?>assets/vendor/apexcharts/apexcharts.min.js"></script>
<script src="<?= WEBSITE ?>assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= WEBSITE ?>assets/vendor/chart.js/chart.min.js"></script>
<script src="<?= WEBSITE ?>assets/vendor/echarts/echarts.min.js"></script>
<script src="<?= WEBSITE ?>assets/vendor/quill/quill.min.js"></script>
<script src="<?= WEBSITE ?>assets/vendor/simple-datatables/simple-datatables.js"></script>
<script src="<?= WEBSITE ?>assets/vendor/tinymce/tinymce.min.js"></script>
<script src="<?= WEBSITE ?>assets/vendor/php-email-form/validate.js"></script>

<!-- Template Main JS File -->
<script src="<?= WEBSITE ?>assets/js/main.js"></script>
<script>
  const navLink = document.querySelectorAll('.nav-link')
  navLink.forEach((item) => {
    if (item.href == window.location.href) {
      item.classList.remove('collapsed')
    }
  })
</script>

</body>

</html>