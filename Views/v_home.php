<div class="col-md-12">
    <div class="card-body">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="3"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="4"></li>
            </ol>
            <div class="carousel-inner">
                <?php foreach ($slider as $key => $value) { ?>

                    <div class="carousel-item <?= $value['id_slider'] == 1 ? 'active' : '' ?>">
                        <img class="d-block w-100" src="<?= base_url('slider/' . $value['slider']) ?>" alt="First slide">
                    </div>

                <?php } ?>
            </div>
            <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                <span class="carousel-control-custom-icon" aria-hidden="true">
                    <i class="fas fa-chevron-left"></i>
                </span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                <span class="carousel-control-custom-icon" aria-hidden="true">
                    <i class="fas fa-chevron-right"></i>
                </span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">Buku Baru</h3> <span class="right badge badge-success">New</span>
        </div>

        <div class="card-body">
            <div class="row">
                <?php foreach ($buku as $key => $value) { ?>
                    <div class="col sm-2">
                        <div class="text-center">
                            <div class="card-body box-profile">
                                <img src="<?= base_url('cover/' . $value['cover']) ?>" width="150px" height="150px">
                            </div>
                            <a href="<?= base_url('Home/DetailBuku/' . $value['id_buku']) ?>"><?= $value['judul_buku'] ?></a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">E-Book Baru</h3> <span class="right badge badge-success">New</span>
        </div>

        <div class="card-body">
            <div class="row">
                <?php foreach ($ebook as $key => $value) { ?>
                    <div class="col sm-2">
                        <div class="text-center">
                            <div class="card-body box-profile">
                                <img src="<?= base_url('cover/' . $value['cover']) ?>" width="150px" height="150px">
                            </div>
                            <a href="<?= base_url('Home/DetailEbook/' . $value['id_ebook']) ?>"><?= $value['judul_ebook'] ?></a>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>

    </div>
</div>