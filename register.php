<?php
include_once 'includes/header.php';

if(Input::exists()) {
	if(Token::check(Input::get('token'))) {

		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'username' => array(
				'required' => true,
				'min' => 2,
				'max' => 20,
				'unique' => 'users'
			),
			'password' => array(
				'required' => true,
				'min' => 6
			),
			'password_again' => array(
				'required' => true,
				'matches' => 'password'
			),
			'name' => array(
				'required' => true,
				'min' => 2,
				'max' => 50
			)
		));

		if($validation->passed()) {
			$user = new User();

			$salt = Hash::salt(32);

			try {

				$user->create(array(
					'username' => Input::get('username'),
					'password' => Hash::make(Input::get('password'), $salt),
					'salt' => $salt,
					'naam' => Input::get('name'),
					'joined' => date('Y-m-d H:i:s'),
					'group' => 1
				));

				Session::flash('home', '
					<div class="alert alert-dismissible alert-success">
					  <strong>U bent succesvol geregistreerd! </strong><a href="login.php" class="alert-link">Klik hier </a>om op uw nieuwe account in te loggen.
					</div>');
				Redirect::to('index.php');

			} catch (Exception $e) {
				die($e->getMessage());
			}
		} else {
			foreach($validation->errors() as $error) {
				echo $error . '<br>';
			}
		}
	}
}
?>
<div class="container">
<form class="form-horizontal" action="" method="post">
  <legend><p class="legend" style="margin-left: 50px;">Please register here</p></legend>
  <div class="well" style="width: 300px;">
  <div class="form-group">
    <div class="col-sm-10">
      <input type="text" style="margin-left: 27px;" autocomplete="off" name="username" class="form-control" value="<?php echo Input::get('username'); ?>" id="username" placeholder="Username">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10">
      <input type="password" style="margin-left: 27px;" class="form-control" name="password" id="password" placeholder="Choose a password">
    </div>
  </div>
    <div class="form-group">
    <div class="col-sm-10">
      <input type="password" style="margin-left: 27px;" class="form-control" name="password_again" id="password_again" placeholder="Enter your password again">
    </div>
  </div>
    <div class="form-group">
    <div class="col-sm-10">
      <input type="text" style="margin-left: 27px;" class="form-control" name="name" value="<?php echo Input::get('naam'); ?>" id="name" placeholder="Enter your name">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-0 col-sm-10">
      <input type="submit" value="Register" style="margin-left: 27px;" class="btn btn-default">
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