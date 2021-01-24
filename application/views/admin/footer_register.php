
<!-- jQuery -->
<script src="<?php echo base_url('assets/'); ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/'); ?>js/adminlte.min.js"></script>
<script>
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

      var inputBox = document.getElementById('email');
      var inputusr = document.getElementById('username');

	  inputBox.onkeyup = function(){
		if(inputBox.value)
		{
		$.ajax({
        url: "<?php echo base_url('admin/cek/email') ?>",
        type:"post",
        data:{query:inputBox.value},
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
        url: "<?php echo base_url('admin/cek/username') ?>",
        type:"post",
        data:{query:inputusr.value},
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

    });
</script>
</body>
</html>