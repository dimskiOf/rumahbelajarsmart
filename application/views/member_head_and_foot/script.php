<!-- jQuery -->
<script src="<?php echo base_url('assets/'); ?>plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url('assets/'); ?>plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url('assets/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url('assets/'); ?>plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url('assets/'); ?>plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?php echo base_url('assets/'); ?>plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url('assets/'); ?>plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url('assets/'); ?>plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url('assets/'); ?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url('assets/'); ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo base_url('assets/'); ?>plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url('assets/'); ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url('assets/'); ?>js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url('assets/'); ?>js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url('assets/'); ?>js/pages/dashboard.js"></script>
<script src="<?php echo base_url();?>assets/vendor/malihu-custom-scrollbar-plugin/jquery.mCustomScrollbar.concat.min.js"></script>
<script src="https://js.pusher.com/5.0/pusher.js"></script>
<script>
 var limit = 7;
    var start = 0;
    var action = 'inactive';

    function lazzy_loader(limit)
    {
      var output = '';
      for(var count=0; count<limit; count++)
      {
        output += '';
      }
      $('#load_data_message').html(output);
    }

   lazzy_loader(limit);

  function load_data(limit, start)
    {
    $.ajax({
      url:"<?php echo base_url(); ?>chater",
      method:"post",
      data:{limit:limit, start:start},
      cache: false,
      dataType: 'json',
    success: function(data){  
        var html = '';
        var html2 = '';
        if(data == '')
          {
            html2 += '<h3>Tidak Ada Pesan Lagi</h3>';
             $('#load_data_message').prepend(html2);
            action = 'active';

          }
          else
          {
            if(data.length > 0){
        for(var i = 0; i<data.length; i++){
        var idchat1 = data[i].token;
        var chatusr = data[i].chat_usr;

        var foto2 = (data[i].foto_profil == 'w') ? "<?php echo base_url('assets/img/avatar2.png'); ?>":  "<?php echo base_url('assets/img/foto-profil/'); ?>"+data[i].foto_profil;

        var foto = (data[i].foto_profil == 'l') ? "<?php echo base_url('assets/img/avatar5.png'); ?>":  foto2;

        var relativtime = moment(data[i].datetime, "YYYY-MM-DD h:mm:ss").fromNow();

        var idchat ='<?php echo $this->session->userdata('token'); ?>';
       // var stats = (idchat == idchat1) ? "You": data[i].nama_usr;

        var sideof = (idchat == idchat1) ? "<!-- Message to the right --> <div class='direct-chat-msg right'> <div class='direct-chat-infos clearfix'> <span class='direct-chat-name float-right'> "+data[i].nama_usr+"</span> <span class='direct-chat-timestamp float-left'>"+relativtime+"</span> </div> <!-- /.direct-chat-infos --> <img class='direct-chat-img' src='"+foto+"' alt='message user image'>  <!-- /.direct-chat-img --> <div class='direct-chat-text'> "+$('<div />').text(data[i].chat_usr).html()+" </div> <!-- /.direct-chat-text --> </div> <!-- /.direct-chat-msg -->": "<!-- Message. Default to the left --><div class='direct-chat-msg'><div class='direct-chat-infos clearfix'><span class='direct-chat-name float-left'>"+data[i].nama_usr+"</span><span class='direct-chat-timestamp float-right'>"+relativtime+"</span></div><!-- /.direct-chat-infos --><img class='direct-chat-img' src='"+foto+"' alt='message user image'><!-- /.direct-chat-img --><div class='direct-chat-text'>"+$('<div />').text(data[i].chat_usr).html()+"</div><!-- /.direct-chat-text --></div><!-- /.direct-chat-msg -->";

        html +=  sideof;
                }
              }
             // $('#load_data').replaceWith(html);
              $('#load_data').prepend(html);
              $('#load_data_message').html("");
              action = 'inactive';
            }   
     }   
  });
    }

if(action == 'inactive')
    {
      load_data(limit, start);
      action = 'active';

    }

$("#selector").mCustomScrollbar("scrollTo","bottom",{scrollInertia:0});

 $(function(){
    function getCaret(el) {
        if (el.selectionStart) {
            return el.selectionStart;
        } else if (document.selection) {
            el.focus();
            
            var r = document.selection.createRange();
            if (r == null) {
                return 0;
            }
            
            var re = el.createTextRange(),
                rc = re.duplicate();
            re.moveToBookmark(r.getBookmark());
            rc.setEndPoint('EndToStart', re);
            
            return rc.text.length;
        }  
        return 0;
    }
    $("#msgs").keyup(function(e){
        if (e.keyCode == 13 && e.ctrlKey) {
            var content = $(this).val();
            var caret = getCaret(this);
            $(this).val(content.substring(0,caret)+
                        "\n"+content.substring(caret,content.length));
            e.stopPropagation();
        } else if (e.keyCode == 13){
            $("#sendbtn").click();
        }
    });
});

        $(document).ready(function(){
         var jmlh = 0;
         var a = $('#jumlah').attr('title');
         $("#jumlah").attr("title",  +jmlh+" Pesan Baru");
         $('#jumlah').text(jmlh);
        });  

$(document).ready(function(){
    $('#sendbtn').on('click',function(event){
       event.preventDefault();
       
       var ppes = "<?php foreach ($datadiri as $data) { echo $data['foto_profil']; } ?>"; 
       var request_method = "POST"; //get form GET/POST methoh
       var dat = $('#msgs').val();
       var post_url = "<?php echo base_url(); ?>chater/send?"; //get form action url

    $.ajax({
          url : post_url,
          type: request_method,
          data: {ms: dat,pp:ppes}, // serializes the form's elements.
           success: function(data)
           {  
              $('#msgs').val('');
              $("#selector").mCustomScrollbar("update");
                setTimeout(function(){
                    $("#selector").mCustomScrollbar("scrollTo","bottom");
                },1000);
           }
         });
      
    });

})  

$("#selector").mCustomScrollbar({
     axis:'yx',
     setHeight: '400',
     theme:'dark',
     callbacks:{
          whileScrolling:function(){
            var scrollTop = $('#selector').find(".mCSB_dragger").position().top;
            if(scrollTop == 0 && action == 'inactive')
            {
              lazzy_loader(limit);
              start = start + limit;
              setTimeout(function(){
              load_data(limit,start);
              }, 1*1000);
              action = 'active';
              $("#selector").mCustomScrollbar("scrollTo",-93,{scrollInertia:0});
            }
          }
        }
    });

    var gowing = 1;
    function appending(gowing)
    {
    $.ajax({
      url:"<?php echo base_url(); ?>chater",
      method:"post",
      data:{limit:gowing},
      cache: false,
      dataType: 'json',
    success: function(data){  
        var html = '';
        var html2 = '';
    if(data.length > 0){
        for(var i = 0; i<data.length; i++){
        var idchat1 = data[i].token;
        var chatusr = data[i].chat_usr;

        var foto2 = (data[i].foto_profil == 'w') ? "<?php echo base_url('assets/img/avatar2.png'); ?>":  "<?php echo base_url('assets/img/foto-profil/'); ?>"+data[i].foto_profil;

        var foto = (data[i].foto_profil == 'l') ? "<?php echo base_url('assets/img/avatar5.png'); ?>":  foto2;

        var relativtime = moment(data[i].datetime, "YYYY-MM-DD h:mm:ss").fromNow();
        var idchat ='<?php echo $this->session->userdata('token'); ?>';
        //var stats = (idchat == idchat1) ? "You": data[i].nama_usr;

        var sideof = (idchat == idchat1) ? "<!-- Message to the right --> <div class='direct-chat-msg right'> <div class='direct-chat-infos clearfix'> <span class='direct-chat-name float-right'> "+data[i].nama_usr+"</span> <span class='direct-chat-timestamp float-left'>"+relativtime+"</span> </div> <!-- /.direct-chat-infos --> <img class='direct-chat-img' src='"+foto+"' alt='message user image'>  <!-- /.direct-chat-img --> <div class='direct-chat-text'> "+chatusr+" </div> <!-- /.direct-chat-text --> </div> <!-- /.direct-chat-msg -->": "<!-- Message. Default to the left --><div class='direct-chat-msg'><div class='direct-chat-infos clearfix'><span class='direct-chat-name float-left'>"+data[i].nama_usr+"</span><span class='direct-chat-timestamp float-right'>"+relativtime+"</span></div><!-- /.direct-chat-infos --><img class='direct-chat-img' src='"+foto+"' alt='message user image'><!-- /.direct-chat-img --><div class='direct-chat-text'>"+chatusr+"</div><!-- /.direct-chat-text --></div><!-- /.direct-chat-msg -->";

        html += sideof;
                }
              }
              $('#load_data').append(html);
              $('#load_data_message').html("");
              action = 'inactive';
            
        
     }   
  });
    }

	// Donut Chart
  var pieChartCanvas = $('#dakun-chart-canvas').get(0).getContext('2d')
  var pieData        = {
    labels: [
        <?php foreach ($jumlahber as $row) {
    	echo "'".$row['nama_paket']."',"; } ?> 
    ],
    datasets: [
      {
        data: [<?php foreach ($jumlahber as $row) {
    	echo $row['subtot'].","; } ?>],
        backgroundColor : [<?php foreach ($jumlahber as $row) { echo "'#".strtoupper(dechex(rand(0,10000000)))."',"; } ?>],
      }
    ]
  }
  var pieOptions = {
    legend: {
      display: true
    },
    maintainAspectRatio : false,
    responsive : true,
  }
  //Create pie or douhnut chart
  // You can switch between pie and douhnut using the method below.
  var pieChart = new Chart(pieChartCanvas, {
    type: 'doughnut',
    data: pieData,
    options: pieOptions      
  });

        var pusher = new Pusher('03390b8b7160498ec7dc', {
          cluster: 'ap1',
          forceTLS: true
      });

      var channel = pusher.subscribe('my-channel');
      
      channel.bind('my-event', function(data) {
          if(data.message === 'success'){
            appending(gowing);
            var untktitle = $('#jumlah').attr('title');
            var untluar = $('#jumlah').text();

            var temp1 = parseInt(untluar) + 1;

            $("#jumlah").attr("title",  +temp1+" Pesan Baru");
            $('#jumlah').text(temp1);

               $("#selector").mCustomScrollbar("update");
            setTimeout(function(){
                $("#selector").mCustomScrollbar("scrollTo","bottom");
            },2*1000);
          }

      });

function unsubscribechannel(){
      pusher.unsubscribe('my-channel');
     // pusher.disconnect();
}

</script>