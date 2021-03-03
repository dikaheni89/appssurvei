<div class="content">
    <!--  section  -->
    <section class="parallax-section single-par" data-scrollax-parent="true">
        <div class="bg par-elem "  data-bg="<?= base_url('uploads/image.jpg'); ?>" data-scrollax="properties: { translateY: '30%' }"></div>
        <div class="overlay op7"></div>
        <div class="container">
            <div class="section-title center-align big-title">
                <h2><span>Gallery</span></h2>
                <span class="section-separator"></span>
            </div>
        </div>
        <div class="header-sec-link">
            <a href="#sec1" class="custom-scroll-link"><i class="fal fa-angle-double-down" style="color: #2e3f6e;"></i></a> 
        </div>
    </section>
    <section   class="gray-bg hidden-section particles-wrapper">
        <div class="container">
            <div class="section-title">
                <h2>Explore Best Cities</h2>
                <div class="section-subtitle">Catalog of Categories</div>
                <span class="section-separator"></span>
                <p>In ut odio libero, at vulputate urna. Nulla tristique mi a massa convallis cursus.</p>
            </div>
            <div class="listing-item-grid_container fl-wrap">
                <div class="row">
                    <!--  listing-item-grid  -->
                    <?php foreach ($album as $row) : ?>
                    <div class="col-sm-4">
                        <div class="listing-item-grid">
                            <div class="bg"  data-bg="<?= base_url('uploads/albums/'.$row->galeri); ?>"></div>
                            <div class="d-gr-sec"></div>
                            <div class="listing-counter color2-bg"><span><?= $total; ?></span> Gallery</div>
                            <div class="listing-item-grid_title">
                                <h3><a href="#"><?= $row->album; ?></a></h3>
                            </div>
                        </div>
                    </div>
                    <!--  listing-item-grid end  -->
                    <?php endforeach ; ?>                                                         
                </div>
            </div>
            <a href="listing.html" class="btn dec_btn   color2-bg">View All Cities<i class="fal fa-arrow-alt-right"></i></a>
        </div>
    </section>
</div>