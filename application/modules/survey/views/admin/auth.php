    <section id="contact" class="contact">
    	<div class="container">

    		<div class="section-title" data-aos="fade-up">
    			<h2>Survey Kepuasan Masyarakat</h2>
    			<p>Please Login</p>
    		</div>

    		<div class="row">

    			<div class="col-lg-4" data-aos="fade-right" data-aos-delay="100">
    				<div class="info">
    					<div class="address">
    						<i class="icofont-google-map"></i>
    						<h4>Alamat</h4>
    						<p>Jl. Nama Jalan No. 01 Kecamatan Kota Provinsi</p>
    					</div>

    					<div class="email">
    						<i class="icofont-envelope"></i>
    						<h4>Email</h4>
    						<p>alamatemail@gmail.com</p>
    					</div>

    					<div class="phone">
    						<i class="icofont-phone"></i>
    						<h4>Telp.</h4>
    						<p>+62 0123456789</p>
    					</div>

    				</div>

    			</div>

    			<div class="col-lg-8 mt-5 mt-lg-0" data-aos="fade-left" data-aos-delay="200">
    				<?php if ($this->session->flashdata('error')): ?>
    					<div class="alert alert-warning alert-dismissible fade show" role="alert">
    						<strong>OPPPS!</strong>  <?php echo $this->session->flashdata('error') ?>
    						<button type="button" class="close" data-dismiss="alert" aria-label="Close">
    							<span aria-hidden="true">&times;</span>
    						</button>
    					</div>
    				<?php endif ?>
    				<form action="<?php echo site_url('survey/auth') ?>" method="post">
    					<div class="form-group">
    						<label for="exampleInputEmail1">Username</label>
    						<input type="text" class="form-control col-lg-6" id="exampleInputEmail1" placeholder="Username" name="username" required>
    					</div>
    					<div class="form-group">
    						<label for="exampleInputPassword1">Password</label> 
    						<input type="password" class="form-control col-lg-6" id="exampleInputPassword1" placeholder="Password" name="password" requireds>
    					</div>
    					<button type="submit" class="btn btn-primary">LOGIN</button>
    				</form>

    			</div>

    		</div>

    	</div>
    </section>