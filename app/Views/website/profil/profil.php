<div class="content">
    <!--  section  -->
    <section class="parallax-section single-par" data-scrollax-parent="true">
        <div class="bg par-elem "  data-bg="<?= base_url('uploads/image.jpg'); ?>" data-scrollax="properties: { translateY: '30%' }"></div>
        <div class="overlay op7"></div>
        <div class="container">
            <div class="section-title center-align big-title">
                <h2><span>Profil Diskomsantik</span></h2>
                <span class="section-separator"></span>
            </div>
        </div>
        <div class="header-sec-link">
            <a href="#sec1" class="custom-scroll-link"><i class="fal fa-angle-double-down" style="color: #2e3f6e;"></i></a> 
        </div>
    </section>
    <section   id="sec1" data-scrollax-parent="true">
        <div class="container">
            <!--about-wrap -->
            <div class="about-wrap">
                <div class="row">
                    <div class="col-md-4">
                        <div class="ab_text-title fl-wrap">
                            <h3>Kategori Profil</h3>
                            <span class="section-separator fl-sec-sep"></span>
                        </div>
                        <!--box-widget-item -->                                       
                        <div class="box-widget-item fl-wrap block_box">
                            <div class="box-widget">
                                <div class="box-widget-content bwc-nopad">
                                    <div class="list-author-widget-contacts list-item-widget-contacts bwc-padside">
                                        <ul class="no-list-style">
                                            <?php foreach ($profil as $row) : ?>
                                                <li><a href="<?= base_url('website/profil/'.$row->seo); ?>" class="custom-scroll-link"><?= $row->seo; ?></a></li>
                                            <?php endforeach ; ?>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>                                          
                    </div>
                    <div class="col-md-8">
                        <div class="ab_text" style="text-align: justify;">
                            <div class="list-single-main-media fl-wrap">
                                <?php if ($detail->image == ''){ $foto = ''; }else{ $foto = '<img src="../../uploads/halaman/'.$detail->image.'" class="respimg" alt="">'; } ?>
                                <?= $foto; ?>
                            </div>
                            <div class="ab_text-title fl-wrap">
                                <h3><?= $detail->title; ?></h3>
                                <span class="section-separator fl-sec-sep"></span>
                            </div>
                            <p><?= $detail->deskripsi; ?></p>
                            <!-- contact form  end--> 
                        </div>
                    </div>
                </div>
            </div>
            <!-- about-wrap end  --> 
        </div>
    </section>
    <div class="limit-box fl-wrap"></div>
</div>