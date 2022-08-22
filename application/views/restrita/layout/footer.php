</div>
</div>
<!-- General JS Scripts -->
<script src="<?php echo base_url('public/assets/js/app.min.js'); ?>"></script>
<!-- JS Libraies -->
<!-- Page Specific JS File -->
<!-- Template JS File -->
<script src="<?php echo base_url('public/assets/js/scripts.js'); ?>"></script>


<script src="<?php echo base_url('public/assets/js/util.js'); ?>"></script>

<?php if(isset($scripts)) :?>
<?php foreach($scripts as $script) :?>

<script src="<?php echo base_url('public/assets/'.$script); ?>"></script>
<?php endforeach;?>
<?php endif; ?>


<!-- Custom JS File -->
<script src="<?php echo base_url('public/assets/js/custom.js'); ?>"></script>

<script>
$('.delete').on("click", function(event) {
    event.preventDefault();
    var choice = confirm($(this).attr('data-confirm'));
    if (choice) {
        window.location.href = $(this).attr('href');

    }

});
</script>
</body>


<!-- blank.html  21 Nov 2019 03:54:41 GMT -->

</html>