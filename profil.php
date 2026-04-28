<?php if(empty($p)) { header("Location: index.php?p=home"); die(); } ?>
<div
    id="about-us"
    class="container-fluid fh5co-about-us pl-0 pr-0 parallax-window">
    <div class="container">
        <div class="about-info">

            <div class="row">
                <div class="col-md-6 about-grids">
                    <br>
                    <img style="width:50%" src="admin/data/image/logo/logo.png" alt="">
                </div>
                <div class="col-md-6 about-grids">
                    <br>
                    <h2 class="wow bounceInLeft"><?php echo strtoupper($objek); ?></h2>
                    <hr>
                    <p>Alamat :
                        <?php echo strtoupper($alamat); ?></p>
                    <br>
                    <p>No Telepon :
                        <?php echo strtoupper($no_telepon); ?></p>
                </div>
            </div>
            <div class="clearfix"></div>
        </div>

    </div>
</div>