<div class="content">
    <section class="gray-bg no-top-padding-sec" id="sec1">
        <div class="container">
            <div class="breadcrumbs inline-breadcrumbs fl-wrap block-breadcrumbs">
                <a href="#">Detail Berita</a>
                <div  class="showshare brd-show-share color2-bg"> <i class="fas fa-share"></i> Share </div>
            </div>
            <div class="share-holder hid-share sing-page-share top_sing-page-share">
                <div class="share-container  isShare"></div>
            </div>
                <div class="post-container fl-wrap" style="text-align: center;">
                    <div class="row">
                        <!-- blog content-->
                        <div class="col-md-8">
                            <!-- article> --> 
                            <article class="post-article single-post-article">
                                <div class="list-single-main-media fl-wrap">
                                    <div class="single-slider-wrap">
                                        <div class="single-slider fl-wrap">
                                            <div class="swiper-container">
                                                <div class="swiper-wrapper lightgallery">
                                                    <div class="swiper-slide hov_zoom"><img src="<?= base_url('./uploads/berita/'.$detail->image); ?>" alt=""><a href="<?= base_url('./uploads/berita/'.$detail->image); ?>" class="box-media-zoom   popup-image"><i class="fal fa-search"></i></a></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="listing-carousel_pagination">
                                            <div class="listing-carousel_pagination-wrap">
                                                <div class="ss-slider-pagination"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-single-main-item fl-wrap block_box">
                                    <h2 class="post-opt-title"><a href="#"><?= $detail->title; ?></a></h2>
                                    <div class="post-author"><a href="#"><img src="<?= base_url('uploads/logo.png'); ?>" alt=""><span>By , Administrator</span></a></div>
                                    <div class="post-opt">
                                        <ul class="no-list-style">
                                            <li><i class="fal fa-calendar" style="color: #b71111;"></i> <span><?= tanggal($detail->created_at); ?></span></li>
                                        </ul>
                                    </div>
                                    <span class="fw-separator"></span> 
                                    <div class="clearfix"></div>
                                    <?= $detail->deskripsi; ?>
                                </div>
                            </article>
                            <!-- article end --> 
                            <!-- post nav -->                                           
                        </div>
                        <!-- blog conten end-->
                        <!-- blog sidebar -->
                        <div class="col-md-4">
                            <div class="box-widget-wrap fl-wrap fixed-bar">
                                <!--box-widget-item end -->  
                                <!--box-widget-item -->
                                <div class="box-widget-item fl-wrap block_box">
                                    <div class="box-widget-item-header">
                                        <h3>Popular Berita</h3>
                                    </div>
                                    <div class="box-widget  fl-wrap">
                                        <div class="box-widget-content">
                                            <!--widget-posts-->
                                            <div class="widget-posts  fl-wrap">
                                                <ul class="no-list-style">
                                                   <?php foreach($berita as $rows) : ?>
                                                    <li>
                                                        <div class="widget-posts-img"><a href="<?= base_url(); ?>/website/beritadetail/<?= $rows->seo; ?>"><img src="<?= base_url('./uploads/berita/'.$rows->image); ?>" alt=""></a></div>
                                                        <div class="widget-posts-descr">
                                                            <h4><a href="<?= base_url(); ?>/website/beritadetail/<?= $rows->seo; ?>"><?= $rows->title; ?></a></h4>
                                                            <div class="geodir-category-location fl-wrap"><a href="#"><i class="fal fa-calendar" style="color: #b71111;"></i> <?= tanggal($rows->created_at); ?></a></div>
                                                        </div>
                                                    </li>
                                                <?php endforeach; ?>
                                                </ul>
                                            </div>
                                            <!-- widget-posts end-->
                                        </div>
                                    </div>
                                </div>
                                <!--box-widget-item end -->                                     
                                <!--box-widget-item -->
                                <div class="box-widget-item fl-wrap">
                                    <div class="banner-wdget fl-wrap">
                                        <div class="overlay"></div>
                                        <div class="bg"  data-bg="<?= base_url('uploads/image.jpg'); ?>"></div>
                                        <div class="banner-wdget-content fl-wrap">
                                            <h4>SISTEM INFORMASI GENDER DAN ANAK BANTEN.</h4>
                                        </div>
                                    </div>
                                </div>                               
                            </div>
                        </div>
                        <!-- blog sidebar end -->
                    </div>
                </div>
        </div>
    </section>
    <div class="limit-box fl-wrap"></div>
</div>