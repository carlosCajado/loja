
  <footer class="main-footer">
    <div class="footer-left">
      <a href="templateshub.net">Templateshub</a></a>
      </div>
    <div class="footer-right"></div>
  </footer>
        </div>
   </div>
  <!-- General JS Scripts -->
  <script src="<?php echo base_url('public/assets/js/app.min.js'); ?>"></script>
  <!-- JS Libraies -->
  <!-- Page Specific JS File -->
  <!-- Template JS File -->
  <script src="<?php echo base_url('public/assets/js/scripts.js'); ?>"></script>

  <?php if(isset($scripts)) :?>
        <?php foreach($scripts as $script) :?>
            
          <script src="<?php echo base_url('public/assets/'.$script); ?>"></script>
        <?php endforeach;?>
  <?php endif; ?>
  
  <script src="<?php echo base_url('public/assets/js/util.js'); ?>"></script>
<!-- Custom JS File -->
<script src="<?php echo base_url('public/assets/js/custom.js'); ?>"></script>
    </body>


<!-- blank.html  21 Nov 2019 03:54:41 GMT -->
</html>