<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login</title>
	<meta name="description" content="Quizees is an Online Quiz Maker">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link rel="shortcut icon" type="image/png" href="/favicon.ico"/>

    <link href="<?=$assets?>/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="<?=$assets?>/css/sb-admin-2.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div class="container">
		<div class="row justify-content-center">
		    <div class="card my-5 col-lg-5">
                <div class="card-body">
                    <?php if(session()->getFlashdata('msg')):?>
                        <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
                    <?php endif;?>
                    <form action="login/auth" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control" name="username" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <button type="submit" class="form-control btn btn-primary">Login</button>
                        </div>
                    </form>
                </div>
		    </div>
		</div>
	</div>      

</body>
</html>
