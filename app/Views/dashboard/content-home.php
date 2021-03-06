                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <?php if(session()->getFlashdata('msg')):?>
                    <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
                    <?php endif;?>

                    <!-- Content -->
                    <?php
                        $db = \Config\Database::connect();
                        $user   = $db->table('users')->getWhere(['username'=>$usrn])->getRowArray();
                        $groups  = $db->table('users_groups')->getWhere(['id_user'=>$user['id']])->getResult();
                        if(count($groups) == 0)
                        {                                      
                    ?>
                    <div class="d-flex flex-column py-5 mt-5">
                        <h2 style="text-align: center;">Anda belum bergabung ke dalam kelas manapun.</h2>
                        <h3 style="text-align: center;">Coba buat kelas atau bergabung dengan menggunakan kode kelas.</h3>
                        <div style="text-align: center;" class="dropdown">
                            <a alt="Tambah Kelas" title="Tambah Kelas" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i style="font-size:3rem;" class="fas fa-plus text-gray-800"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                <a href="<?php base_url() ?>/group" class="dropdown-item" type="button">Buat Kelas</a>
                                <a href="" class="dropdown-item" type="button">Gabung Kelas</a>
                            </div>
                        </div>
                    </div>
                    <?php 
                        }else{
                    ?>
                    <div class="row">
                    <?php
                            foreach($groups as $item)
                            {
                                $group  = $db->table('groups')->getWhere(['id'=>$item->id_group])->getRow();
                    ?>
                        <!-- Earnings (Monthly) Card Example -->
                        <div class="col-md-4 mb-4">
                            <div class="card border-dark h-100">
                                <div class="card-header pt-3 pb-5 bg-primary">
                                    <a href="<?php base_url(); echo "group/".$group->group_code ?>" 
                                    class="h5 mb-0 font-weight-bold text-light text-uppercase">
                                        <?= $group->group_name;?>   
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="mb-0 font-weight-bold text-gray-800">
                                                <?php echo substr($group->group_desc, 0, 50);if(strlen($group->group_desc) > 50):echo"...";endif;
                                                ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                            }
                    ?>
                    </div>
                    <?php
                        }
                    ?>
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->