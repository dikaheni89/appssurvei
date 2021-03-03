<style>
    .listing-item-category-wrap{
        float: right;
    }
</style>
<!-- content-->
<div class="content">
    <!--section  -->
    <section class="hero-section"   data-scrollax-parent="true">
        <div class="bg-tabs-wrap">
            <div class="bg-parallax-wrap" data-scrollax="properties: { translateY: '200px' }">
                <div class="bg bg_tabs"  data-bg="<?= base_url('uploads/image.jpg'); ?>"></div>
                <div class="overlay op7"></div>
            </div>
        </div>
        <div class="container small-container">
            <div class="intro-item fl-wrap">
                <span class="section-separator"></span>
                <div class="bubbles">
                    <h1 style="text-align: center;">(SIGAB) SISTEM INFORMASI GENDER DAN ANAK BANTEN</h1>
                </div>
                <!-- <h3>Deskripsi</h3> -->
            </div>
        </div>
        <div class="header-sec-link">
            <a href="#sec1" class="custom-scroll-link"><i class="fal fa-angle-double-down" style="color: #2e3f6e;"></i></a> 
        </div>
    </section>
    <!--section Video -->
    <section class="slw-sec" id="sec1">
        <div class="section-title">
            <h2>Listing Videos</h2>
            <div class="section-subtitle" style="color: #325096;">Listing Videos</div>
            <span class="section-separator"></span>
        </div>
        <div class="listing-slider-wrap fl-wrap" style="text-align: center;">
            <div class="listing-slider fl-wrap">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <!--  swiper-slide  -->
                        <?php foreach ($video as $row) : ?>
                        <div class="swiper-slide">
                            <div class="listing-slider-item fl-wrap">
                                <!-- listing-item  -->
                                <div class="listing-item listing_carditem">
                                    <article class="geodir-category-listing fl-wrap">
                                        <div class="geodir-category-img">
                                            <a href="https://www.youtube.com/embed/<?= $row->uri; ?>" class="geodir-category-img-wrap image-popup fl-wrap">
                                            <iframe width="100%" height="300" src="https://www.youtube.com/embed/<?= $row->uri; ?>" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe> 
                                            </a>
                                            <div class="geodir-category-opt">
                                                <div class="listing_carditem_footer fl-wrap">
                                                    <div class="post-author"><a href="#"><img src="<?= base_url('template/logo.png'); ?>" alt=""><span>By , Admin</span></a></div>
                                                </div>
                                            </div>
                                        </div>
                                    </article>
                                </div>
                                <!-- listing-item end -->                                                   
                            </div>
                        </div>
                        <?php endforeach ; ?>
                        <!--  swiper-slide end  -->                                        
                    </div>
                </div>
                <div class="listing-carousel-button listing-carousel-button-next2"><i class="fas fa-caret-right"></i></div>
                <div class="listing-carousel-button listing-carousel-button-prev2"><i class="fas fa-caret-left"></i></div>
            </div>
            <div class="tc-pagination_wrap">
                <div class="tc-pagination2"></div>
            </div>
        </div>
    </section>
    <!--section end-->
    <!-- section Berita -->
    <section>
        <div class="container big-container" style="text-align: center;">
            <div class="section-title">
                <h2><span>Berita</span></h2>
                <div class="section-subtitle" style="color: #325096;">Berita Terbaru</div>
                <span class="section-separator"></span>
            </div>
            <div class="grid-item-holder gallery-items fl-wrap">
                <!--  gallery-item-->
                <?php foreach($berita as $rows) :?>
                <div class="gallery-item">
                    <!-- listing-item  -->
                    <div class="listing-item">
                        <article class="geodir-category-listing fl-wrap">
                            <div class="geodir-category-img">
                                <a href="<?= base_url(); ?>/website/beritadetail/<?= $rows->seo; ?>" class="geodir-category-img-wrap fl-wrap">
                                    <img src="<?= base_url('uploads/berita/'.$rows->image); ?>" alt=""> 
                                </a>
                            </div>
                            <div class="geodir-category-content fl-wrap title-sin_item">
                                <div class="geodir-category-content-title fl-wrap">
                                    <div class="geodir-category-content-title-item">
                                        <h3 class="title-sin_map"><?= substr($rows->title, 0,50); ?></h3>
                                    </div>
                                </div>
                                <div class="geodir-category-footer fl-wrap">
                                    <a class="listing-item-category-wrap" href="<?= base_url(); ?>/website/beritadetail/<?= $rows->seo; ?>">
                                        <div class="listing-item-category red-bg"><i class="fal fa-arrow-right" ></i></div>
                                        <span>Selengkapnya</span>
                                    </a>
                                </div>
                            </div>
                        </article>
                    </div>
                    <!-- listing-item end -->                              
                </div>
                <?php endforeach; ?>
                <!-- gallery-item  end-->                           
            </div>
        </div>
    </section>
    <!--section end-->
    <!-- section Berita -->

    <!--section end-->
    </div>
    <!--content end-->
</div>