<!DOCTYPE HTML>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title><?= $title; ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
        <meta name="robots" content="index, follow"/>
        <meta name="keywords" content=""/>
        <meta name="description" content=""/>
        <!--=============== css  ===============-->	
        <link type="text/css" rel="stylesheet" href="<?= base_url('frontend/css/reset.css'); ?>">
        <link type="text/css" rel="stylesheet" href="<?= base_url('frontend/css/plugins.css'); ?>">
        <link type="text/css" rel="stylesheet" href="<?= base_url('frontend/css/style.css'); ?>">
        <link type="text/css" rel="stylesheet" href="<?= base_url('frontend/css/color.css'); ?>">
        <link rel="stylesheet" href="<?= base_url('template/vendors/sweetalert2/sweetalert2.min.css');?>">
        <link rel="stylesheet" href="<?= base_url('template/vendors/toastr/toastr.min.css');?>">
        <!--=============== favicons ===============-->
        <link rel="shortcut icon" href="<?php echo base_url('favicon.ico'); ?>" />
        <?php 
        foreach($css_files as $file) { ?>
        <link type="text/css" rel="stylesheet" href="<?= $file; ?>" />
        <?php } ?>
        
        <?php foreach($js_files as $file) { ?>
        <script type="text/javascript" src="<?= $file; ?>"></script>
        <?php } ?>
        <script type="text/javascript" src="<?= base_url('template/vendors/popper.js/dist/umd/popper.min.js');?>"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.0.0/jquery.min.js"></script>
        <script type="text/javascript" src="<?= base_url('template/vendors/bootstrap/dist/js/bootstrap.min.js');?>"></script>
        <style>
            .logo-text{
                height: 30px;
                top: 22px;
                color: #fff;
                font-weight: bold;
                font-size: large;
            }
        </style>
    </head>
    <body>
        <!--loader-->
        <div class="loader-wrap">
            <div class="loader-inner">
                <div class="loader-inner-cirle"></div>
            </div>
        </div>
        <!--loader end-->
        <!-- main start  -->
        <div id="main">
            <!-- header -->
            <header class="main-header">
                <!-- logo-->
                <a href="<?= base_url(); ?>" class="logo-holder logo-text"><img src="<?= base_url('template/logo.png'); ?>" alt=""> (SIGAB) SISTEM INFORMASI GENDER DAN ANAK BANTEN</a>
                <!-- logo end-->                            
                <!-- nav-button-wrap--> 
                <div class="nav-button-wrap color-bg">
                    <div class="nav-button">
                        <span></span><span></span><span></span>
                    </div>
                </div>
                <!-- nav-button-wrap end-->
                <!--  navigation --> 
                <div class="show-reg-form modal-open avatar-img" data-srcav="images/avatar/3.jpg"><i class="fal fa-user"></i>Sign In</div>
                <div class="nav-holder main-menu">
                    <nav>
                        <ul class="no-list-style">
                            <?php
                                $menus = json_decode($menus);
                                foreach ($menus as $row) :
                                  if ($row->numsub > 0){?>
                                    <li>
                                        <a href="<?= $row->uri; ?>"><i class="<?= $row->icon;?>"></i> <?= $row->title; ?></a>
                                         <ul>
                                          <?php foreach ($row->submenu as $sub) :?>
                                          <li>
                                              <a href="<?= base_url($sub->uri);?>"><?= $sub->title;?></a>
                                          </li>
                                          <?php endforeach; ?>
                                        </ul>
                                    </li>
                                <?php }else{ ?>
                                <li>
                                    <a href="<?= $row->uri; ?>"><i class="<?= $row->icon;?>"></i> <?= $row->title; ?></a>
                                </li>
                                <?php } endforeach;?>
                        </ul>
                    </nav>
                </div>
                <!--wishlist-wrap end --> 
            </header>
        <div id="wrapper">
            <?= $content; ?>
            <!--footer -->
            <footer class="main-footer fl-wrap">
                <div class="footer-inner fl-wrap" style="text-align: center;">
                    <div class="container">
                        <div class="row">
                            <!-- footer-widget-->
                            <div class="col-md-4">
                                <div class="footer-widget fl-wrap">
                                    <h3>Tentang SIGAB</h3>
                                    <div class="footer-contacts-widget fl-wrap">
                                        <p align="justify">
                                            Dalam rangka ketersediaan data dan informasi gender dan anak maka diperlukan Sistem Informasi Gender dan Anak Banten (SIGAB) yang dapat mendukung penyediaan informasi dalam proses pengambilan keputusan pimpinan, proses perencanaan, pelaksanaan, pemantauan dan evaluasi kebijakan program / kegiatan pemberdayaan perempuan dan perlindungan anak, serta sekaligus sebagai sarana yang menjembatani proses pengumpulan data gender dan anak dari kabupaten, Provinsi dan Kementerian secara berkelanjutan
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- footer-widget end-->
                            <!-- footer-widget-->
                            <div class="col-md-4">
                                <div class="footer-widget fl-wrap">
                                    <h3>Kontak</h3>
                                    <div class="footer-widget-posts fl-wrap">
                                        <ul class="no-list-style">
                                            <li class="clearfix">
                                                <div class="widget-posts-descr">
                                                    <a href="#" title="Bawaslu">DISKOMSANTIK</a>
                                                </div>
                                            </li>
                                            <li class="clearfix">
                                                <div class="widget-posts-descr">
                                                    <a href="#" title="Alamat"> Pandeglang, Pandeglang Sub-District, Pandeglang Regency, Banten 42211</a> 
                                                </div>
                                            </li>
                                            <li class="clearfix">
                                                <div class="widget-posts-descr">
                                                    <a href="#" title="">0253 - 4021212</a>
                                                </div>
                                            </li>
                                            <li class="clearfix">
                                                <div class="widget-posts-descr">
                                                    <a href="#" title="">Pandeglang - Indonesia</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <!-- footer-widget end-->
                            <!-- footer-widget  -->
                            <div class="col-md-4">
                                <div class="footer-widget fl-wrap ">
                                    <h3>Logo</h3>
                                    <div class="fl-wrap">
                                        <img src="<?= base_url('template/logo.png'); ?>" width="70%">
                                    </div>
                                </div>
                            </div>
                            <!-- footer-widget end-->
                        </div>
                    </div>
                    <!-- footer bg-->
                    <div class="footer-bg" data-ran="4"></div>
                    <div class="footer-wave">
                        <svg viewbox="0 0 100 25">
                            <path fill="#fff" d="M0 30 V12 Q30 17 55 12 T100 11 V30z" />
                        </svg>
                    </div>
                    <!-- footer bg  end-->
                </div>
                <!--sub-footer-->
                <div class="sub-footer fl-wrap">
                    <div class="container">
                        <div class="copyright"> &#169; SISTEM INFORMASI GENDER DAN ANAK BANTEN <?= date('Y'); ?> .  All rights reserved.</div>
                    </div>
                </div>
                <!--sub-footer end -->
            </footer>
            <!--footer end -->  
            <!--map-modal end -->                
            <!--register form -->
            <div class="main-register-wrap modal">
                <div class="reg-overlay"></div>
                <div class="main-register-holder tabs-act">
                    <div class="main-register fl-wrap  modal_main">
                        <div class="main-register_title">Welcome to <span><strong>SIG</strong>AB<strong>.</strong></span></div>
                        <div class="close-reg"><i class="fal fa-times"></i></div>
                        <ul class="tabs-menu fl-wrap no-list-style">
                            <li class="current"><a href="#tab-1"><i class="fal fa-sign-in-alt"></i> Login</a></li>
                        </ul>
                        <!--tabs -->                       
                        <div class="tabs-container">
                            <div class="tab">
                                <!--tab -->
                                <div id="tab-1" class="tab-content first-tab">
                                    <div class="custom-form">
                                        <form class="text-center" id="login-form" action="javascript:;" method="post">
                                            <label>Username or Email Address <span>*</span> </label>
                                            <input type="email" name="email" placeholder="Email" autocomplete="off">
                                            <label >Password <span>*</span> </label>
                                            <input type="password" name="password" placeholder="Password" >
                                            <button type="submit"  class="btn float-btn color2-bg" id="login"> Log In <i class="fas fa-caret-right"></i></button>
                                            <div class="clearfix"></div>
                                            <div class="filter-tags">
                                                <input id="check-a3" type="checkbox" name="check">
                                                <label for="check-a3">Remember me</label>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <!--tabs end -->
                        </div>
                    </div>
                </div>
            </div>
            <a class="to-top"><i class="fas fa-caret-up"></i></a>     
        </div>
        <!-- Main end -->
        <!--=============== scripts  ===============-->
        <script src="<?= base_url('frontend/js/jquery.min.js'); ?>"></script>
        <script src="<?= base_url('frontend/js/plugins.js'); ?>"></script>
        <script src="<?= base_url('frontend/js/scripts.js'); ?>"></script> 
        <script type="text/javascript" src="<?= base_url('template/vendors/toastr/toastr.min.js');?>"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script> 
        <script type="text/javascript" src="<?= base_url('template/vendors/metisMenu/dist/metisMenu.js');?>"></script>
        <script type="text/javascript" src="<?= base_url('template/vendors/jquery-validation/dist/jquery.validate.min.js');?>"></script>
        <script type="text/javascript" src="<?= base_url('template/vendors/jquery.maskedinput/dist/jquery.maskedinput.min.js');?>"></script>
        <!-- SweetAlert2 -->
        <script type="text/javascript" src="<?= base_url('template/vendors/sweetalert2/sweetalert2.min.js');?>"></script>

        <script src="<?= base_url('template/loaderajax/jm.spinner.js');?>" type="text/javascript"></script>
        <script type="text/javascript">
        $(document).ready(function (){
            const Toast = Swal.mixin({
              toast: true,
              position: 'top-end',
              showConfirmButton: false,
              timer: 3000
            });
        
        $(function() {
            $('#login-form').validate({
                errorClass: "help-block",
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true
                    }
                },
                messages:{
                    email:{
                        required : 'Email tidak boleh kosong',
                        email: 'Format Email salah, isi dengan format email@domain.com'
                    },
                    password:'Password tidak boleh kosong.'
                },
                highlight: function(e) {
                    $(e).closest(".form-group").addClass("has-error")
                },
                unhighlight: function(e) {
                    $(e).closest(".form-group").removeClass("has-error")
                },
                submitHandler: function(form) {
                      var user = $('input[name=email]').val();
                      var pass = $('input[name=password]').val();
                      $.ajax({
                          type: "POST",
                          url : "<?= base_url('auth/check')?>",
                          dataType:'json',
                          data: {<?= csrf_token() ?>:'<?= csrf_hash() ?>', username:user, password:pass},
                          beforeSend:function(){
                                $('.box').jmspinner('large');       
                            },
                          success: function(msg){
                            var jsondata= JSON.parse(JSON.stringify(msg));
                            $('.box').jmspinner(false);
                            
                            var val = jsondata.map(function(e) {
                                return e.value;
                            });
                            var message = jsondata.map(function(e) {
                                return e.message;
                            });
                            var token = jsondata.map(function(e) {
                                return e.token;
                            });
                            console.log(token);
                            if (val == 0){
                              Toast.fire({
                                type: 'error',
                                title: ''+message+''
                                })
                              window.setTimeout(function(){
                                window.location.href="<?= base_url('login')?>";
                              },1000);
                            }else{
                              Toast.fire({
                                type: 'success',
                                title: ''+message+''
                              });
                               window.setTimeout(function(){
                                window.location.href="<?= base_url('admin')?>";
                              },1000);
                            }
                        },
                        complete: function (XMLHttpRequest, textStatus) {
                            var headers = XMLHttpRequest;
                            if (headers.status != 200){
                                Toast.fire({
                                    type: 'error',
                                    title: 'Hayooo.. Mau ngapain yaa.....'
                                })   
                             }
                        }

                      }); 
                      return false;
                }
            });
        });
        
    });
    </script>                       
    </body>
</html>