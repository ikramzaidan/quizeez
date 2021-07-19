<?php
    $db = \Config\Database::connect();
    $user   = $db->table('users')->getWhere(['username'=>$usrn])->getRowArray();
    $Group  = $db->table('groups')->getWhere(['id'=>$group])->getRowArray();
    $Quiz   = $db->table('quiz')->getWhere(['id_group'=>$group])->getResult();                                   
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

                        <div class="card shadow mb-3 py-2 w-100">
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

                        <div class="row">
                            <div class="col-md-8">
                            <?php
                                if(count($Quiz) > 0){   
                                    foreach($Quiz as $item)
                                    {
                            ?>
                                <div class="card py-3 px-4 mb-3">
                                    <a href="<?= base_url()."/group/".$Group['group_code']."/quiz/".$item->hash?>" class="h4 text-dark"><?=$item->name?></a>
                                </div>
                            <?php
                                    }
                                }else{
                            ?>
                                <div class="card py-3 px-4 mb-3">
                                    <span class="h5 text-dark">Belum ada kuis di grup ini, coba buat disini.</span>
                                    <a href="<?= base_url()."/group/".$Group['group_code']?>/quiz/create" class="btn btn-primary">Buat Kuis</a>
                                </div>
                            <?php
                                } 
                            ?>
                            </div>
                            <div class="col-md-4">
                                <div class="card py-3 px-4">
                                    <span class="text-dark mb-3">Belum ada kuis di grup ini, coba buat disini.</span>
                                    <a class="btn btn-primary">Buat Kuis</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->