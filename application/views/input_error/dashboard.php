<style>
.main .col-lg-6 col-md-6.kiri{
    padding-left:0px!important;
    
}
.main .col-lg-6 col-md-6.kanan{
    padding-right:0px!important;
    
    
}
.panel{
    border-radius: 0px
}
.kanan a,.kiri a{
    color:#fff;
}
.kiri .glyphicon ,.kanan .glyphicon {
    margin-right:10px;
}
.well{
    border-radius: 0px;
    background: #fff;
    border: 1px solid #fff
}

.biru{
    color:#3b5998!important
}
.merah{
    color: #cd201f!important
}
.putih,.info-box .info-box-stats span.info-box-title{
    color: #fff!important
}
.biru-muda{
    color: #1da1f2!important
}
body{
    background: #f5f5f5!important
}
.panel{
    box-shadow: none!important;
    border: 0px!important
}
.info2{
    min-height: 140px;
    text-align: center;
    font-size: 16px;
    padding: 15px 10px 
}
.info2 h4{
    font-weight: bold;
    color: #388e3c;
    font-size: 28px
}
.info2 small{
    color: #388e3c
}
.info-kanan{
    border-right: 1px solid #ccc;
}
.info-bawah{
    border-bottom:  1px solid #ccc;
}
.form-control{
    border-radius: 0px
}

.header-tile{
    background:#388e3c!important;color:#fff!important;
}

.header-tile .form-control{
    box-shadow: none!important;
    border-top:0px;
    border-bottom: 0px;
}
.load2{
    display: none
}
.form-control{
    width: 100%!important
}

.nav-tabs>li.active>a, .nav-tabs>li.active>a:focus, .nav-tabs>li.active>a:hover,.nav-tabs>li>a{
  color: #FFF
}
</style>
<?php
$ci =  get_instance();
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.1.4/Chart.min.js"></script>
    <div class="container-fluid background">
        <section class="container content">
		
			<div class="contspacing">
			
			
			<h3>Dashboard Dinas Pertanian</h3>

			<p>&nbsp;</p>
			<div class="row">
                     
   <div class="col-lg-3 col-md-6" style="">
                        <a href="<?php echo base_url();?>kelompok_tani/hibah">
                            <div class="panel info-box panelgrey" style="background: #03a9f5">
                                <div class="panel-body">
                                    <div class="info-box-stats col-xs-6">
                                        <p class="counter putih"><?php echo $stat_gapoktan; ?></p>
                                        <span class="info-box-title putih">Gapoktan</span>
                                    </div>
                                    <div class="col-xs-6 kotak">

                                    <div class="glyph-icon flaticon-farmer-2 putih"></div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                              <div class="col-lg-3 col-md-6">
                        <a href="<?php echo base_url();?>kelompok_tani/hibah">
                            <div class="panel info-box panelgrey " style="background: #e74c3c">
                                <div class="panel-body">
                                    <div class="info-box-stats col-xs-6">
                                        <p class="counter putih"><?php echo $estat1; ?></p>
                                        <span class="info-box-title">Kelompok tani</span>
                                    </div>
                                    <div class="col-xs-6 kotak putih">

                                    <div class="glyph-icon flaticon-farmer-2 putih"></div>
                                    </div>
                                </div>
                            </div>
                            </a>
                        </div>
                        <div class="col-lg-3 col-md-6">
                            <div class="panel info-box panelgrey" style="background: #388e3c">
                                <div class="panel-body">
                                    
                                       
                                    <div class="info-box-stats col-xs-6">
                                         <p class="counter putih"><?php echo $stat_aktivitas;?></p>
                                        <span class="info-box-title putih">Aktivitas</span>
                                    
                                    </div>
                                    <div class="col-xs-6 kotak">

                                    <div class="glyph-icon  flaticon-newspaper putih"></div>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                        </div>


                             <div class="col-lg-3 col-md-6">
                            <div class="panel info-box panelgrey">
                                <div class="panel-body">
                                    
                                       
                                    <div class="info-box-stats col-xs-6">
                                         <p class="counter biru-muda"><?php echo $stat_hibah;?></p>
                                        <span class="info-box-title biru-muda" style="color: #1da1f2!important">Aset petani</span>
                                    
                                    </div>
                                    <div class="col-xs-6 kotak">

                                    <div class="glyph-icon  flaticon-village biru-muda"></div>
                                    </div>
                                    
                                    
                                </div>
                            </div>
                        </div>



                        
                        
        </div>

       



        <p>&nbsp;</p>

</div>


<div class="col-lg-6 col-md-6 kiri" style="margin-bottom:30px;padding: 0px;padding-right: 15px" >

<div class="header-tile" style="background: #fff;height:40px;padding:7px 20px;margin-top:0px;">
<b>Ringkasan Pertanian di Kabupaten Jombang</b>



 
</div>
<article style="height:300px!important;width:100%;border-radius: 0px;border-top: 1px solid #ccc" class="col-md-12  well">





  <table class="table" style="margin-top: 10px">
    <thead class="">
      <tr>
        <th>Jenis lahan</th>
        <th>Luas (Ha)</th>
    
      </tr>
    </thead>
    <tbody>
      
   
     

      <tr>
        <td>Tegal</td>
        <td><?php echo number_format($luas_tegal,0,",",".");?> </td>
    
      </tr>
       <tr>
        <td>Sawah</td>
        <td><?php echo number_format($luas_sawah,0,",",".");?> </td>
    
      </tr>
       <tr>
        <td>Pekarangan</td>
        <td><?php echo number_format($luas_pekarangan,0,",",".");?> </td>
    
      </tr>
      </tbody>
      </table>





</article>
</div>

<div class="col-lg-6 col-md-6 kanan" style="margin-bottom:30px;padding-right: 0px;padding-left: 15px" >
<div class="header-tile" style="background: #fff;height:40px;color:#388e3c;padding:7px 20px;margin-top:0px;font-weight: bold">
Ringkasan Poktan dan Gapoktan



 
</div>
<article style="height:300px!important;overflow: scroll;overflow-x:hidden;border-top:1px solid #ccc;width:100%" class="col-md-12 well">


<table class="table" >
<thead>
<tr>
<th>
<span class="sc_highlight sc_highlight_style_2">#</span>
</th>
<th>Kecamatan</th>
<th>Poktan</th>
<th>Gapoktan</th>
</tr>
</thead>
<tbody >
<?php 

$x=1;
foreach($kecamatan as $camat){?>
<tr>
<td>
<span class="sc_highlight sc_highlight_style_2"><?php echo $x;?></span>
</td>
<td><?php echo $camat['nama'];?></td>
<td>

<?php 
echo $ci->dashboard_model->count_kelompok_tani($camat['id']);?>

</td>
<td>

<?php 
echo $ci->dashboard_model->count_gapoktan($camat['id']);?>

</td>

</tr>
<?php $x++;} ?>








</tbody>
</table>

</article>
</div>






<div class="col-md-12 col-xs-12 " style="background: #fff;margin-bottom: 50px">


  <div class="header-tile row" style="background: #;margin-top: px;min-height: 70px;padding: 2px 20px;margin-bottom: 0px">
  
    <div class="col-lg-7"><h4 id="judul-aset2" style="color: #fff;text-transform: none;font-size: 18px;font-weight: 300;margin-top: 7px">
Gapoktan pemilik <?php echo $barang_hibah[0]['nama'];?>
</h4></div>
    <div class="col-lg-5" style="padding:0px">
         <form class="form-inline ">
      <div class="form-group col-lg-6" style="">
      <div >Nama barang</div>
      <select class="form-control " id="select-barang">
     
        <?php
        foreach ($barang_hibah as $barang) {
          ?>
          <option nama-barang="<?php echo $barang['nama'];?>" value="<?php echo $barang['id'];?>" ><?php echo $barang['nama'];?></option>
          <?php
        } ?>
        </select>
      </div>

        <div class="form-group col-lg-6" style="">
      <div >Tingkatan</div>
      <select class="form-control " id="select-tingkatan">
        <option value="1">Gapoktan</option>
          <option value="2">Poktan</option>
        
        </select>
      </div>

    </form>
    </div>
</div>
<div style="background:#fff;min-height: 300px;max-height:300px;margin-bottom: 40px;overflow-y: scroll;padding:10px 20px">

  <div class="load2">
<div class="blob blob-0"></div>
<div class="blob blob-1"></div>
<div class="blob blob-2"></div>
<div class="blob blob-3"></div>
<div class="blob blob-4"></div>
<div class="blob blob-5"></div>
</div>


  <?php

  $datax = $ci->dashboard_model->detail_hibah_by_barang($barang_hibah[0]['id']);

  ?>
<div id="datax">
  <table class="table" >
    <thead>
      <tr>
        <th>Nama gapoktan</th>
        <th>Jumlah</th>
        <th>Tahun</th>
            <th>Sumber</th>
      </tr>
    </thead>
    <tbody>
      <?php
      foreach ($datax as $key => $value) {
        $gapoktan = $ci->dashboard_model->gapoktan_by_user_id($value['user_id']);
      ?>
 <tr>
        <td><?php echo $gapoktan[0]['nama'];?></td>
        <td><?php  echo $value['jumlah'];?></td>
        <td><?php  echo $value['tahun'];?></td>
          <td><?php  echo $value['sumber'];?></td>
      </tr>
      <?php
      }
      ?>
     
      

    </tbody>
  </table>
  </div>
  </div>
<div>

</div>



</div>

<div class="col-md-12 col-xs-12 " style="background: #fff;-webkit-box-shadow: 0px 0px 5px -35px rgba(0,0,0,0.11);
-moz-box-shadow: 0px 0px 5px -35px rgba(0,0,0,0.11);
box-shadow: 0px 0px 5px -35px rgba(0,0,0,0.11);">
<div>
<div class="header-tile row" style="background: #;margin-top: px;min-height: 70px;padding: 3px 20px;margin-bottom: 40px">
<div class="col-md-5 col-xs-12"><h4 id="judul-aset" style="color: #fff;text-transform: none;font-size: 18px;font-weight: 300">
Data Aset petani di Kabupaten Jombang
</h4>
</div>
<div class="col-md-7 col-xs-12" style="padding:0px;padding-top: 5px">
<form class="form-inline ">
    <div class="form-group col-lg-4" style="">
      <div >Nama kecamatan</div>
      <select class="form-control" id="select-kecamatan">
          <option>Semua kecamatan</option>
          <?php foreach($kecamatan as $camat){
if($camat['id']==$id_kecamatan){ ?>
    <option class="kecamatan" nama-kecamatan="semua" selected="selected" target="<?php echo $camat['id'];?>" value="<?php echo $camat['id'];?>"><?php echo $camat['nama'];?></option>
<?php } else { ?>
    <option nama-kecamatan="<?php echo $camat['nama'];?>" class="kecamatan" target="<?php echo $camat['id'];?>" value="<?php echo $camat['id'];?>"><?php echo $camat['nama'];?></option>
<?php }

 } ?>
      </select>
       
    </div>
    <div class="form-group col-lg-4" style="">
         <div >Nama gapoktan</div>
     <select class="form-control" id="select-gapoktan">
          <option nama-gapoktan="semua" >Semua gapoktan</option>
          <?php foreach($gapoktan as $camat){

if($camat['id']==$id_desa){?>
    <option nama-gapoktan="<?php echo $camat['nama'];?>"style="display: block!important;" selected="selected" class="gapoktan gapoktan-<?php echo $camat['kecamatan'];?>" value="<?php echo $camat['id'];?>"><?php echo $camat['nama'];?></option>
<?php } else { ?>
    <option nama-gapoktan="<?php echo $camat['nama'];?>" class="gapoktan  gapoktan-<?php echo $camat['kecamatan'];?>" value="<?php echo $camat['id'];?>"><?php echo $camat['nama'];?></option>
<?php }

 } ?>
      </select>
       
    </div>
    
    <div class="form-group col-lg-4">
         <div >Nama kelompok tani</div>
          <select class="form-control" id="select-poktan">
          <option value="semua" nama-poktan="semua" >Semua poktan</option>
          <?php foreach($poktan as $camat){

if($camat['id']==$id_desa){?>
    <option style="display: block!important;" nama-poktan="<?php echo $camat['nama'];?>" selected="selected" class="poktan poktan-<?php echo $camat['gapoktan'];?>" value="<?php echo $camat['id'];?>"><?php echo $camat['nama'];?></option>
<?php } else { ?>
    <option nama-poktan="<?php echo $camat['nama'];?>" class="poktan  poktan-<?php echo $camat['gapoktan'];?>" value="<?php echo $camat['id'];?>"><?php echo $camat['nama'];?></option>
<?php }

 } ?>
      </select>
       
    </div>
</form>
</div>
</div>
</div>


<div class="load">
<div class="blob blob-0"></div>
<div class="blob blob-1"></div>
<div class="blob blob-2"></div>
<div class="blob blob-3"></div>
<div class="blob blob-4"></div>
<div class="blob blob-5"></div>
</div>

<div id="data-aset">
<div class="col-lg-6 col-md-6 kiri col-xs-12" style="margin-bottom:0px;padding: 0px" >


<article style="height:300px!important;width:100%;border-radius: 0px;border: 0px solid #ccc;padding: 0px" class="col-md-12  ">
<div class="col-lg-3 col-xs-6 info2 info-kanan info-bawah">
<?php
$jumlah = $ci->dashboard_model->hibah_by_barang($barang_hibah[0]['id']);?>
<h4><?php echo $jumlah;?> <small>unit</small></h4>
<p><?php echo $barang_hibah[0]['nama'];?></p>
</div>

<div class="col-lg-3 col-xs-6 info2 info-kanan info-bawah">
<?php
$jumlah = $ci->dashboard_model->hibah_by_barang($barang_hibah[1]['id']);?>
<h4><?php echo $jumlah;?> <small>unit</small></h4>
<p><?php echo $barang_hibah[1]['nama'];?></p>
</div>

<div class="col-lg-3 col-xs-6 info2 info-kanan info-bawah">
<?php
$jumlah = $ci->dashboard_model->hibah_by_barang($barang_hibah[2]['id']);?>
<h4><?php echo $jumlah;?> <small>unit</small></h4>
<p><?php echo $barang_hibah[2]['nama'];?></p>
</div>
<div class="col-lg-3 col-xs-6 info2 info-kanan info-bawah">
<?php
$jumlah = $ci->dashboard_model->hibah_by_barang($barang_hibah[3]['id']);?>
<h4><?php echo $jumlah;?> <small>unit</small></h4>
<p><?php echo $barang_hibah[3]['nama'];?></p>
</div>
<div class="col-lg-3 col-xs-6  info2 info-kanan">
<?php
$jumlah = $ci->dashboard_model->hibah_by_barang($barang_hibah[4]['id']);?>
<h4><?php echo $jumlah;?> <small>unit</small></h4>
<p><?php echo $barang_hibah[4]['nama'];?></p>
</div>
<div class="col-lg-3 col-xs-6  info2 info-kanan">
<?php
$jumlah = $ci->dashboard_model->hibah_by_barang($barang_hibah[5]['id']);?>
<h4><?php echo $jumlah;?> <small>unit</small></h4>
<p><?php echo $barang_hibah[5]['nama'];?></p>
</div>
<div class="col-lg-3 col-xs-6  info2 info-kanan">
<?php
$jumlah = $ci->dashboard_model->hibah_by_barang($barang_hibah[6]['id']);?>
<h4><?php echo $jumlah;?> <small>unit</small></h4>
<p><?php echo $barang_hibah[6]['nama'];?></p>
</div>
<div class="col-lg-3 col-xs-6  info2 info-kanan">
<?php
$jumlah = $ci->dashboard_model->hibah_by_barang($barang_hibah[7]['id']);?>
<h4><?php echo $jumlah;?> <small>unit</small></h4>
<p><?php echo $barang_hibah[7]['nama'];?></p>
</div>






</article>
</div>

<div class="col-lg-6 col-md-6 kiri col-xs-12 " style="margin-bottom:0px;padding: 0px" >


<article style="height:300px!important;width:100%;border-radius: 0px;border: 0px solid #ccc;padding: 0px" class="col-md-12  ">
<div class="col-lg-3 col-xs-6  info2 info-kanan info-bawah">
<?php
$jumlah = $ci->dashboard_model->hibah_by_barang($barang_hibah[8]['id']);?>
<h4><?php echo $jumlah;?> <small>unit</small></h4>
<p><?php echo $barang_hibah[8]['nama'];?></p>
</div>
<div class="col-lg-3 col-xs-6  info2 info-kanan info-bawah">
<?php
$jumlah = $ci->dashboard_model->hibah_by_barang($barang_hibah[9]['id']);?>
<h4><?php echo $jumlah;?> <small>unit</small></h4>
<p><?php echo $barang_hibah[9]['nama'];?></p>
</div>
<div class="col-lg-3 info2 col-xs-6 info-kanan info-bawah">
<?php
$jumlah = $ci->dashboard_model->hibah_by_barang($barang_hibah[10]['id']);?>
<h4><?php echo $jumlah;?> <small>unit</small></h4>
<p><?php echo $barang_hibah[10]['nama'];?></p>
</div>
<div class="col-lg-3 info2 col-xs-6 info-bawah">
<?php
$jumlah = $ci->dashboard_model->hibah_by_barang($barang_hibah[11]['id']);?>
<h4><?php echo $jumlah;?> <small>unit</small></h4>
<p><?php echo $barang_hibah[11]['nama'];?></p>
</div>
<div class="col-lg-3 info2 col-xs-6 info-kanan">
<?php
$jumlah = $ci->dashboard_model->hibah_by_barang($barang_hibah[12]['id']);?>
<h4><?php echo $jumlah;?> <small>unit</small></h4>
<p><?php echo $barang_hibah[12]['nama'];?></p>
</div>
<div class="col-lg-3 info2 col-xs-6 info-kanan">
<?php
$jumlah = $ci->dashboard_model->hibah_by_barang($barang_hibah[13]['id']);?>
<h4><?php echo $jumlah;?> <small>unit</small></h4>
<p><?php echo $barang_hibah[13]['nama'];?></p>
</div>
<div class="col-lg-3 info2 col-xs-6 info-kanan">
<?php
$jumlah = $ci->dashboard_model->hibah_by_barang($barang_hibah[14]['id']);?>
<h4><?php echo $jumlah;?> <small>unit</small></h4>
<p><?php echo $barang_hibah[14]['nama'];?></p>
</div>
<div class="col-lg-3 col-xs-6 info2">
<?php
$jumlah = $ci->dashboard_model->hibah_by_barang($barang_hibah[15]['id']);?>
<h4><?php echo $jumlah;?> <small>unit</small></h4>
<p><?php echo $barang_hibah[15]['nama'];?></p>
</div>






</article>
</div>
</div>
</div>
</div>


 
<div class="container">
<div class="col-md-12 header-tile" style="background: #fff;min-height:40px;color:#388e3c;padding:7px 20px;margin-top:0px;font-weight: bold;margin-bottom: 0px">
<div class="col-lg-8" style="padding-top: 15px">Sebaran aset petani di Kabupaten Jombang </div>
  <div class=" col-lg-4">  <center><ul class="nav nav-tabs tab-tile pull-right" role="tablist" style="border: 0px;margin-bottom: -7px;margin-top: 10px">
   <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Kecamatan</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Desa</a></li>

  </ul>
</center>
</div>


 
</div>


<div class="tab-content" style="min-height: 540px; margin-bottom: 50px; border: 3px solid  #fff;-webkit-box-shadow: 0px 0px 5px -35px rgba(0,0,0,0.11);
-moz-box-shadow: 0px 0px 5px -35px rgba(0,0,0,0.11);
box-shadow: 0px 0px 5px -35px rgba(0,0,0,0.11);
            border-top: 0px">
    <div role="tabpanel" class="tab-pane active" id="home" style="">
        <iframe id="peta-kecamatan" src="<?php echo base_url();?>dashboard/peta_kecamatan" style="width:100%;height:490px"></iframe>

        <script src="https://files.codepedia.info/files/uploads/iScripts/html2canvas.js"></script>

<div class="hide">
    <input id="btn-Preview-Image" type="button" value="Preview"/>
    <a id="btn-Convert-Html2Image" href="#">Download</a>
    <br/>
    <h3>Preview :</h3>
    <div id="previewImage">
    </div>
</div>

<script>
$(document).ready(function(){

  
var element = $("#peta-kecamatan"); // global variable
var getCanvas =  ; // global variable
 
    $("#btn-Preview-Image").on('click', function () {
         html2canvas(element, {
         onrendered: function (canvas) {
                $("#previewImage").append(canvas);
                getCanvas = canvas;
             }
         });
    });

  $("#btn-Convert-Html2Image").on('click', function () {
    var imgageData = getCanvas.toDataURL("image/png");
    // Now browser starts downloading it instead of just showing it
    var newData = imgageData.replace(/^data:image\/png/, "data:application/octet-stream");
    $("#btn-Convert-Html2Image").attr("download", "your_pic_name.png").attr("href", newData);
  });

});

</script>

    </div>
    <div role="tabpanel" class="tab-pane" id="profile">
        <iframe src="<?php echo base_url();?>dashboard/peta_desa" style="width:100%;height:540px"></iframe></div>
 
  </div>
  </div>





</section>
<script type="text/javascript">
    $( "#select-kecamatan" ).change(function () {
        var url = "<?php echo base_url();?>dashboard/hibah_by_kecamatan/"+$(this).val(); // the script 
        $(".load").show();
        $(".info2").hide();
        $.ajax({
           type: "GET",
           url: url,
                contentType: false,  
                cache: false,  
                processData:false, 
                success: function(data) {
                var kecamatan   = $("#select-kecamatan").val();
                var nama        = $("#select-kecamatan option:checked" ).attr('nama-kecamatan');
                if(nama != "semua") {
                    $("#judul-aset").html("Data Aset petani di Kecamatan "+nama);
                } else {
                    $("#judul-aset").html("Data Aset petani di Kabupaten Jombang");
                }

                $( "#select-gapoktan option" ).hide();
                $( "#select-gapoktan .gapoktan-"+ kecamatan).show();
                $('#data-aset').html(data);
                $(".load").hide();
                 $(".info2").show();
            }
        });
    });




 $( "#select-barang" ).change(function () {
  var barang   = $("#select-barang").val();
  var tingkatan   = $("#select-tingkatan").val();
  
  if(tingkatan==1) {
    var url = "<?php echo base_url();?>dashboard/barang_by_gapoktan/"+barang ; // the script 
  } else {
    var url = "<?php echo base_url();?>dashboard/barang_by_poktan/"+barang ; // the script 
  }
        
        $(".load2").show();
        $("#datax").hide();
        $.ajax({
           type: "GET",
           url: url,
                contentType: false,  
                cache: false,  
                processData:false, 
                success: function(data) {
                var barang   = $("#select-barang").val();
                var nama        = $("#select-barang option:checked" ).attr('nama-barang');
                               
if(tingkatan==2) {
     $("#judul-aset2").html("kelompok tani pemilik "+nama);
  } else {
     $("#judul-aset2").html("Gapoktan pemilik "+nama);
  }

              
                $('#datax').html(data);
                $(".load2").hide();
                 $("#datax").show();
            }
        });
    });

$( "#select-tingkatan" ).change(function () {
  var barang   = $("#select-barang").val();
  var tingkatan   = $("#select-tingkatan").val();
  
  if(tingkatan==1) {
    var url = "<?php echo base_url();?>dashboard/barang_by_gapoktan/"+barang ; // the script 
  } else {
    var url = "<?php echo base_url();?>dashboard/barang_by_poktan/"+barang ; // the script 
  }
        
        $(".load2").show();
        $("#datax").hide();
        $.ajax({
           type: "GET",
           url: url,
                contentType: false,  
                cache: false,  
                processData:false, 
                success: function(data) {
                var barang   = $("#select-barang").val();
                var nama        = $("#select-barang option:checked" ).attr('nama-barang');
               
if(tingkatan==2) {
     $("#judul-aset2").html("kelompok tani pemilik "+nama);
  } else {
     $("#judul-aset2").html("Gapoktan pemilik "+nama);
  }
              
                $('#datax').html(data);
                $(".load2").hide();
                 $("#datax").show();
            }
        });
    });




$( "#select-gapoktan" ).change(function () {
  
    var url = "<?php echo base_url();?>dashboard/hibah_by_gapoktan/"+$(this).val(); // the script 
  $(".load").show();
        $(".info2").hide();
    $.ajax({
           type: "GET",
           url: url,
          
                     contentType: false,  
                     cache: false,  
                     processData:false, // serializes the form's elements.
           success: function(data)
           {
              $(".load").hide();
        $(".info2").show();
           var nama = $( "#select-gapoktan option:checked " ).attr('nama-gapoktan');
           var kecamatan   = $("#select-gapoktan").val();
             //alert(kecamatan);
              if(nama != "semua") {
$("#judul-aset").html("Data Aset petani di Gapoktan "+nama);
              } else {
                $("#judul-aset").html("Data Aset petani di Kabupaten Jombang");
              }
            $('#data-aset').html(data);
            $( "#select-poktan option" ).hide();
            $( "#select-poktan .poktan-"+ kecamatan).show();
           }

         });

   
  });


$( "#select-poktan" ).change(function () {
  
    var url = "<?php echo base_url();?>dashboard/hibah_by_poktan/"+$(this).val(); // the script 
  $(".load").show();
        $(".info2").hide();
    $.ajax({
           type: "GET",
           url: url,
          
                     contentType: false,  
                     cache: false,  
                     processData:false, // serializes the form's elements.
           success: function(data)
           {
           var nama = $( "#select-poktan option:checked " ).attr('nama-poktan');
        
               $(".load").hide();
        $(".info2").show();
              if(nama != "semua") {
$("#judul-aset").html("Data Aset petani di Poktan "+nama);
              } else {
                $("#judul-aset").html("Data Aset petani di Kabupaten Jombang");
              }
            $('#data-aset').html(data);
            
           }
         });

   
  });
</script>
 
<div class="container" style="background: #fff">
<?php
include "simple_html_dom.php";
//$html = file_get_html('http://pertanian.jombangkab.go.id/database/pola-tanaman');




      
//foreach($html->find('#ja-mainbody') as $e)
    //echo str_replace('6699CC', '388e3c', $e->innertext);
 


?>


 
</div>