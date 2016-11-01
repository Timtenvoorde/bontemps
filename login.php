<?php
require_once 'core/init.php';
include_once 'includes/header.php';

if(Input::exists()) {
	if(Token::check(Input::get('token'))) {

		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'username' => array('required' => true),
			'password' => array('required' => true)
		));
		if($validation->passed()) {
			$user = new User();

			$remember = (Input::get('remember') === 'on') ? true : false;
			$login = $user->login(Input::get('username'), Input::get('password'), $remember);

			if($login) {
				Redirect::to('index.php');
			} else {
				echo 'Logging in failed';
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
  <legend><p class="legend" style="margin-left: 50px;">Please login here</p></legend>
  <div class="well" style="width: 300px;">
  <div class="form-group">
    <div class="col-sm-10">
      <input type="text" style="margin-left: 27px;" autocomplete="off" name="username" class="form-control" value="" id="username" placeholder="Username">
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-10">
      <input type="password" style="margin-left: 27px;" class="form-control" name="password" id="password" placeholder="Choose a password">
        <div class="checkbox">
          <label>
            <input style="margin-left: 5px;" name="remember" id="remember" type="checkbox"><p style="margin-left: 27px;" class="remember">Remember me</p>
          </label>
        </div>
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-0 col-sm-10">
      <input type="submit" value="Login" style="margin-left: 27px;" class="btn btn-default">
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
