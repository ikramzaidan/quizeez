<?php
    $db = \Config\Database::connect();
    $user   = $db->table('users')->getWhere(['username'=>$usrn])->getRowArray();
    $Group  = $db->table('groups')->getWhere(['id'=>$group])->getRowArray();                                     
?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content -->
                    <div class="px-4">
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card py-3 px-4">
                                    <form action="<?= base_url()."/group/".$Group['group_code']?>/quiz/createNew" method="post">
                                        <div class="form-group row">
                                            <label for="inputTitle" class="col-sm-2 col-form-label">Judul</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" name="title" id="inputTitle" placeholder="Judul Kuis">
                                            </div>
                                        </div>
                                        <fieldset class="form-group">
                                            <div class="row">
                                                <legend class="col-form-label col-sm-2 pt-0">Deskripsi</legend>
                                                <div class="col-sm-10">
                                                    <textarea class="form-control" name="desc" id="exampleFormControlTextarea1" rows="3" placeholder="Deskripsi/Petunjuk Kuis"></textarea>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <div class="form-group row">
                                            <label for="inputDuration" class="col-sm-2 col-form-label">Durasi</label>
                                            <div class="col-sm-3">
                                                <input type="number" class="form-control" name="duration" id="inputDuration" placeholder="Durasi Kuis">
                                            </div>
                                            <div class="col-sm-4 py-2">
                                                Menit
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <button type="submit" class="btn btn-primary">Buat Kuis</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
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