<?php
  require_once 'core/init.php';
  require_once 'includes/header.php';


if(!$user->isLoggedIn()) {
	Redirect::to('index.php');
}

if(Input::exists()) {
	if(Token::check(Input::get('token'))) {
		
		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'password_current' => array(
				'required' => true,
				'min' => 6
			),
			'password_new' => array(
				'required' => true,
				'min' => 6
			),
			'password_new_again' => array(
				'required' => true,
				'min' => 6,
				'matches' => 'password_new'
			)
		));

		if($validation->passed()) {
			
			if(Hash::make(Input::get('password_current'), $user->data()->salt) !== $user->data()->password) {
				echo 'Je wachtwoord is onjuist.';
			} else {
				$salt = Hash::salt(32);
				$user->update(array(
					'password' => Hash::make(Input::get('password_new'), $salt),
					'salt' => $salt
				));

				Session::flash('home', '					
					<div class="alert alert-dismissible alert-success">
					  <strong>Uw wachtwoord is met succes veranderd!</strong><a href="#" class="alert-link"></a>
					</div>');
				Redirect::to('index.php');
			}

		} else {
			foreach($validation->errors() as $error) {
				echo $error, '<br>';
			}
		}
	}
}

?>

<div class="container">
<form class="form-horizontal" action="" method="post">
  <legend><p class="legend" style="margin-left: 50px;">Update your password</p></legend>
  <div class="well" style="width: 300px;">
  <div class="form-group">
    <div class="col-sm-10">
      <input type="password" style="margin-left: 27px;" name="password_current" id="password_current" class="form-control" placeholder="Current password">
    </div>
  </div>
    <div class="form-group">
    <div class="col-sm-10">
      <input type="password" style="margin-left: 27px;" name="password_new" id="password_new" class="form-control" placeholder="New password">
    </div>
  </div>
    <div class="form-group">
    <div class="col-sm-10">
      <input type="password" style="margin-left: 27px;" name="password_new_again" id="password_new_again" class="form-control" placeholder="New password again">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-0 col-sm-10">
      <input type="submit" value="Update" style="margin-left: 27px;" class="btn btn-default">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10">
      <input type="hidden" name="token" value="<?php echo Token::generate(); ?>" style="margin-left: 27px;" class="form-control">
    </div>
  </div>
</div>
</form>
</body>
</html>
