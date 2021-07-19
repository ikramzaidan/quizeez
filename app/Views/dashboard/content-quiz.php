<?php
    $db = \Config\Database::connect();
    $user   = $db->table('users')->getWhere(['username'=>$usrn])->getRowArray();
    $Group  = $db->table('groups')->getWhere(['id'=>$group])->getRowArray();
    $Quiz   = $db->table('quiz')->getWhere(['hash'=>$quiz_hash])->getRowArray();                                   
?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content -->
                    <div class="px-4">
                        <div class="card bg-secondrary shadow text-dark w-100 mb-3">
                            <div class="card-body py-4 text-center">
                                <h2><?= $Quiz['name']; ?></h2>
                                <span><?= $Quiz['description']; ?></span>
                                <div class="mt-5">
                                    <p>Durasi: <?= $Quiz['duration']; ?> Menit</p>
                                    <a class="btn btn-primary">Attempt</a>
                                </div>
                            </div>
                        </div>                        
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->