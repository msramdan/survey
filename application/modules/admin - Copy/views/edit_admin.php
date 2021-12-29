<section class="content">
	<input type="hidden" id="base" value="<?php echo site_url() ?>">
	<div class="row">
		<div class="panel">
			<div class="panel-body">
				<table width="80%" >
					<form action="<?php echo site_url('admin/update_admin') ?>" method="post" accept-charset="utf-8">
						<tr>
							<td width="30%">Display Name</td>
							<td width="70%" style="padding: 10px;"><input type="text" name="display" value="<?php echo $admin->display ?>" class="form-control" required></td>
						</tr>
						<tr>
							<td>Username</td>
							<td style="padding: 10px;"><input type="text" name="username" value="<?php echo $admin->username ?>" class="form-control" required></td>
						</tr>
						<tr >
							<td>Password</td>
							<td style="padding: 10px;"><input type="password" name="password" value="<?php echo $admin->password ?>" class="form-control" required></td>
						</tr>
						<tr >
							<td>ulangi Password</td>
							<td style="padding: 10px;"><input type="password" name="password2" value="<?php echo $admin->password ?>" class="form-control" required placeholder="ulangi password"></td>
						</tr>
						<tr >
							<td></td>
							<td style="padding: 10px;"><button onclick="return confirm('anda yakin merupah informasi anda?')" type="submit" class="btn bg-purple"><i class="fa fa-save"></i> Simpan Perubahan</button></td>
						</tr>
					</form>
				</table>
			</div>
		</div>
	</div>
</section>