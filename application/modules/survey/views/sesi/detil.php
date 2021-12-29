    <section id="details" class="details">
      <div class="container">
        <div class="row content">
          <div class="col-md-4" data-aos="fade-right">
            <img src="<?php echo base_url().'assets/img/'.$news1->img ?>" class="img-fluid" alt="" style="border-radius: 20px;">
              
            </style>
          </div>
          <div class="col-md-8" data-aos="fade-up">
            <h3><?php echo $news1->judul ?></h3>
            <p><?php echo $news1->konten?></p>
          </div>
        </div>

        <div class="row content">
          <div class="col-md-4 order-1 order-md-2" data-aos="fade-left">
            <img  style="border-radius: 20px;" src="<?php echo base_url().'assets/img/'.$news2->img?>" class="img-fluid" alt="">
            <br>
          </div>
          <div class="col-md-8 order-2 order-md-1" data-aos="fade-up">
            <h3><?php echo $news2->judul ?></h3>
            <p>
             <?php echo $news2->konten ?>
            </p>
          </div>
        </div>

      </div>
    </section>