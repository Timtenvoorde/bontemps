<?php
require_once 'core/init.php';
include_once 'includes/header.php';

$user = new User();

if(!$user->isLoggedIn()) {
	Redirect::to('index.php');
}

if(Input::exists()) {
	if(Token::check(Input::get('token'))) {

		$validate = new Validate();
		$validation = $validate->check($_POST, array(
			'naam' => array(
				'required' => true,
				'min' => 2,
				'max' => 50
			)
		));

		if($validation->passed()) {
			
			try {
				$user->update(array(
					'naam' => Input::get('naam')
				));
				Session::flash('home', 'Je profiel is geupdate.');
				Redirect::to('index.php');

			} catch(Exception $e) {
				die($e->getMessage());
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
  <legend><p class="legend" style="margin-left: 50px;">Update your information</p></legend>
  <div class="well" style="width: 300px;">
  <div class="form-group">
    <div class="col-sm-10">
      <input type="text" style="margin-left: 27px;" name="naam" id="naam" class="form-control" value="<?php echo escape($user->data()->naam); ?>" placeholder="Name">
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
