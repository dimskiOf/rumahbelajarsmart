
<!-- jQuery -->
<script src="<?php echo base_url('assets/'); ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url('assets/'); ?>plugins/select2/js/select2.full.min.js"></script>
<!-- Bootstrap4 Duallistbox -->
<script src="<?php echo base_url('assets/'); ?>plugins/bootstrap4-duallistbox/jquery.bootstrap-duallistbox.min.js"></script>
<!-- InputMask -->
<script src="<?php echo base_url('assets/'); ?>plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/inputmask/jquery.inputmask.min.js"></script>
<!-- BS-Stepper -->
<script src="<?php echo base_url('assets/'); ?>plugins/bs-stepper/js/bs-stepper.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/'); ?>js/adminlte.min.js"></script>

<script>
$('#datemask').inputmask('yyyy-mm-dd', { 'placeholder': 'yyyy-mm-dd' })

    // BS-Stepper Init
  document.addEventListener('DOMContentLoaded', function (event) {
     event.preventDefault();
    window.stepper = new Stepper(document.querySelector('.bs-stepper'))
  });
        $(document).ready(function () {
          $(".tes").click(function (event) {
              event.preventDefault(); 
          })
      })

	$(document).ready(function(){
		$('#agreeTerms').change(function() {
            if ($(this).is(":checked")) {
            	var a = 'agree';
            	$(this).val(a);
            }else{
            	var a = '';
            	$(this).val(a);
            }
        })
/*
      var inputBox = document.getElementById('email');
      var inputusr = document.getElementById('username');

	  inputBox.onkeyup = function(){
		if(inputBox.value)
		{
		$.ajax({
        url: "<?php echo base_url('member/cek/email') ?>",
        type:"post",
        data:{query:inputBox.value,<?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo
$this->security->get_csrf_hash(); ?>'},
        dataType:"json",
        success:function(data)
        {
        	$.each(data,function(pesan){
        		$('#message').html(data.pesan);
        	})
        }
            })
		}
	}

	inputusr.onkeyup = function(){
		if(inputusr.value)
		{
		$.ajax({
        url: "<?php echo base_url('member/cek/username') ?>",
        type:"post",
        data:{query:inputusr.value,<?php echo $this->security->get_csrf_token_name(); ?>: '<?php echo
$this->security->get_csrf_hash(); ?>'},
        dataType:"json",
        success:function(data)
        {
        	$.each(data,function(pesan){
        		$('#message').html(data.pesan);
        	})
        }
            })
		}
	}
*/
    });
</script>
</body>
</html>