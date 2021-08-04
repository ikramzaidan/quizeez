<?php
    $db = \Config\Database::connect();
    $user   = $db->table('users')->getWhere(['username'=>$usrn])->getRowArray();
    $Group  = $db->table('groups')->getWhere(['id'=>$group])->getRowArray();
    $Quiz   = $db->table('quiz')->getWhere(['hash'=>$quiz_hash])->getRowArray();
    $Quest   = $db->table('questions')->getWhere(['id_quiz'=>$Quiz['id']])->getResult();                                   
?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content -->
                    <div class="px-4">
                        <div class="card bg-secondrary shadow text-dark w-100 mb-3">
                            <div class="card-body py-4">
                                <h2><?= $Quiz['name']; ?></h2>
                                <span><?= $Quiz['description']; ?></span>
                                <div class="mt-5">
                                    <p>Durasi: <?= $Quiz['duration']; ?> Menit</p>
                                    <div class="text-right">
                                        <a class="btn btn-primary">Edit</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card shadow mb-3 py-2 w-100">
                            <ul class="nav justify-content-center">
                                <li class="nav-item">
                                    <a class="nav-link" aria-current="page" href="<?= base_url()."/group/".$Group['group_code']?>">Soal</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="#">Nilai</a>
                                </li>
                            </ul>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <?php
                                    $i = 1;
                                    foreach($Quest as $item){
                                ?>
                                <div class="card mb-3 py-2 px-3">
                                    <span>
                                        <?= $i++.". ".$item->question;?>
                                    </span>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="col-md-4">
                                <div class="card py-3 px-4">
                                    <span class="text-dark mb-3">Belum ada kuis di grup ini, coba buat disini.</span>
                                    <a href="<?= base_url()."/group/".$Group['group_code']."/quiz/".$quiz_hash?>/quest/create" class="btn btn-primary">Tambah Soal</a>
                                </div>
                            </div>
                        </div>                    
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->