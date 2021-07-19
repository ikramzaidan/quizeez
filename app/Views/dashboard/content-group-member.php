<?php
    $db = \Config\Database::connect();
    $user   = $db->table('users')->getWhere(['username'=>$usrn])->getRowArray();
    $Group  = $db->table('groups')->getWhere(['id'=>$group])->getRowArray();                                     
?>
                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content -->
                    <div class="px-4">
                        <div class="card bg-primary shadow text-light w-100 mb-3">
                            <div class="card-body py-4 px-5">
                                <h2><?= $Group['group_name']; ?></h2>
                                <span>Kode Kelas: <?= $Group['group_code']; ?></span>
                            </div>
                            <div class="card-footer px-5 mt-5 text-dark">
                                <?= $Group['group_desc']; ?>
                            </div>
                        </div>

                        <div class="card shadow py-2 w-100 mb-3">
                            <ul class="nav justify-content-center">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="page" href="<?= base_url()."/group/".$Group['group_code']?>">Beranda</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Kuis</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?= base_url()."/group/".$group_hash; ?>/member">Peserta</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Nilai</a>
                                </li>
                            </ul>
                        </div>

                        <div class="card py-3 px-5 shadow text-dark w-100">
                            <div class="row">
                            <?php
                                $groups  = $db->table('users_groups')->getWhere(['id_group'=>$Group['id']])->getResult();
                                foreach($groups as $item)
                                {                                    
                            ?>
                                <div class="col-md-6 offset-md-3 mb-2">
                                    <div class="card py-2 px-2">
                                <?php
                                    $member  = $db->table('users')->getWhere(['id'=>$item->id_user])->getRow();
                                    echo $member->name;
                                ?>
                                    </div>
                                </div>
                            <?php } ?>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->