<?php
    $db = \Config\Database::connect();
    $User   = $db->table('users')->getWhere(['username'=>$usrn])->getRowArray();                                 
?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content -->
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 mb-3">
                                <div class="card py-3 px-3">
                                    <h2>Profile</h2>
                                    <hr class="mb-3">
                                    <div class="form-group row justify-content-center">
                                        <label for="nameField" class="col-sm-2 col-form-label">Nama</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="nameField" class="form-control" name="name" value="<?=$User['name']?>">
                                        </div>
                                    </div>
                                    <div class="form-group row justify-content-center">
                                        <label for="usernameField" class="col-sm-2 col-form-label">Username</label>
                                        <div class="col-sm-8">
                                            <input type="text" id="usernameField" class="form-control" name="username" value="<?=$User['username']?>">
                                        </div>
                                    </div>
                                    <div class="form-group row justify-content-center">
                                        <label for="emailField" class="col-sm-2 col-form-label">Email</label>
                                        <div class="col-sm-8">
                                            <input type="email" id="emailField" class="form-control" name="email" value="<?=$User['email']?>">
                                        </div>
                                    </div>
                                    <div class="form-group row justify-content-center">
                                        <a>Ubah Password</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card py-3">
                                    <div class="text-center">
                                        <i style="font-size: 8rem;" class="fas fa-fw fa-user-circle"></i>
                                    </div>
                                </div>
                            </div>
                        </div>  
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->