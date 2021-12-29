    <section id="faq" class="faq section-bg">
      <div class="container">

        <div class="section-title" data-aos="fade-up">
          <h2>F.A.Q</h2>
          <p>Frequently Asked Questions</p>
        </div>

        <div class="faq-list">
          <ul>
            <?php if (count($faq)>0): ?>
              <?php foreach ($faq as $faq): ?>
                <li data-aos="fade-up">
                  <i class="bx bx-help-circle icon-help"></i> <a data-toggle="collapse" class="collapse" href="#faq-list-<?php echo $faq->id ?>"><?php echo $faq->pertanyaan ?><i class="bx bx-chevron-down icon-show"></i><i class="bx bx-chevron-up icon-close"></i></a>
                  <div id="faq-list-<?php echo $faq->id ?>" class="collapse show" data-parent=".faq-list">
                    <p>
                      <?php echo $faq->jawaban ?>
                    </p>
                  </div>
                </li>
              <?php endforeach ?>
            <?php endif ?>
            
          </ul>
        </div>

      </div>
    </section>