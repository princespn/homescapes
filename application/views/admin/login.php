<?php if (!empty($this->session->userdata('username'))) {
	redirect("processed");
} ?>
 <div class="container login">
	<div class="row">
	<div class="col-md-6">
		<?php if (validation_errors()) : ?>			
				<div class="alert alert-danger" role="alert">
					<?= validation_errors() ?>
				</div>
			
		<?php endif; ?>
		<?php if (isset($error)) : ?>
			
				<div class="alert alert-danger" role="alert">
					<?= $error ?>
				</div>
			
		<?php endif; ?>
		
			<div class="page-header">
				<h1>Login</h1>
			</div>
			<?= form_open('/user/login') ?>
				<div class="form-group">
					<label for="username">Username</label>
					<input type="text" class="form-control" id="username" name="username" placeholder="Your username">
				</div>
				<div class="form-group">
					<label for="password">Password</label>
					<input type="password" class="form-control" id="password" name="password" placeholder="Your password">
				</div>
				<div class="form-group">
					<input type="submit" class="btn btn-default" value="Login">
				</div>
			</form>
		</div>
	</div><!-- .row -->
</div><!-- .container 