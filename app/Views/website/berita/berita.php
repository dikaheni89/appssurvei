<div class="content">
    <!--  section  -->
    <section class="parallax-section single-par" data-scrollax-parent="true">
        <div class="bg par-elem "  data-bg="<?= base_url('uploads/image.jpg'); ?>" data-scrollax="properties: { translateY: '30%' }"></div>
        <div class="overlay op7"></div>
        <div class="container">
            <div class="section-title center-align big-title">
                <h2><span>Berita Terbaru</span></h2>
                <span class="section-separator"></span>
            </div>
        </div>
        <div class="header-sec-link">
            <a href="#sec1" class="custom-scroll-link"><i class="fal fa-angle-double-down" style="color: #2e3f6e;"></i></a> 
        </div>
    </section>
    <!--  section  end-->
    <section class="gray-bg no-top-padding-sec" id="sec1">
        <div class="container" style="text-align: center;">
            <div class="breadcrumbs inline-breadcrumbs fl-wrap block-breadcrumbs">
                <a href="#">Berita</a>
                <div  class="showshare brd-show-share color2-bg"> <i class="fas fa-share"></i> Share </div>
            </div>
            <div class="share-holder hid-share sing-page-share top_sing-page-share">
                <div class="share-container  isShare"></div>
            </div>
            <div class="post-container fl-wrap">
                <div class="row">
                    <!-- blog content-->
                    <div class="col-md-8">
                        <!-- article> --> 
                        <?php foreach($berita as $key) : ?>
                            <article class="post-article">
                                <div class="list-single-main-media fl-wrap">
                                    <div class="single-slider-wrap">
                                        <div class="single-slider fl-wrap">
                                            <div class="swiper-container">
                                                <div class="swiper-wrapper lightgallery">
                                                    <div class="swiper-slide hov_zoom"><img src="<?= base_url('./uploads/berita/'.$key['image']); ?>" alt=""><a href="<?= base_url('./uploads/berita/'.$key['image']); ?>" class="box-media-zoom   popup-image"><i class="fal fa-search"></i></a></div>
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
                                    <h2 class="post-opt-title"><a href="#"><?= $key['title']; ?></a></h2>
                                    <p><?= $key['title']; ?></p>
                                    <span class="fw-separator"></span>
                                    <div class="post-author"><a href="#"><img src="<?= base_url('uploads/logo.png'); ?>" alt=""><span>By , Administrator</span></a></div>
                                    <div class="post-opt">
                                        <ul class="no-list-style">
                                            <li><i class="fal fa-calendar" style="color: #b71111;"></i> <span><?= tanggal($key['created_at']); ?></span></li>
                                        </ul>
                                    </div>
                                    <a href="<?= base_url(); ?>/website/beritadetail/<?= $key['seo']; ?>" class="btn color2-bg  float-btn">Selengkapnya<i class="fal fa-angle-right"></i></a>
                                </div>
                            </article>
                        <?php endforeach; ?>
                        <!-- article end -->    
                        <?= $pager->links('berita', 'berita_pagination'); ?>                                   
                    </div>
                    <!-- blog conten end-->
                    <!-- blog sidebar -->
                    <div class="col-md-4" style="text-align: center;">
                        <div class="box-widget-wrap fl-wrap fixed-bar">                                   
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
                                                <?php foreach($popular as $rows) : ?>
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