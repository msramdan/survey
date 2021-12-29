<section class="content">
	<div class="row">
		<div class="panel">
			<div class="panel-body">
				<table class="table table-hover" style="font-size: 16px;">
					<thead>
						<tr>
							<th width="10%">News</th>
							<th width="15%">IMG</th>
							<th width="20%">Judul</th>
							<th width="65%">Konten</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($news as $news): ?>	
							<tr>
								<td><a href="<?php echo site_url('news/editnews/').$news->id ?>" ><?php echo "News".$news->id ?></a></td>
								<td><img src="<?php echo base_url('assets/img/').$news->img ?>" alt="" style="width: 100%"></td>
								<td><?php echo $news->judul ?></td>
								<td style="word-wrap: break-word;"><?php echo $news->konten ?></td>
							</tr>
						<?php endforeach ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>