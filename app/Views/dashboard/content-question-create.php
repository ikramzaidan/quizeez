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
                                <div class="card py-3 px-4">
                                    <form action="<?= base_url()."/group/".$Group['group_code']."/quiz/".$quiz_hash?>/quest/createNew" method="post">
                                        <fieldset class="form-group">
                                            <div class="row">
                                                <legend class="col-form-label col-sm-2 pt-0">Soal</legend>
                                                <div class="col-sm-10">
                                                    <textarea id="editor1" name="question"></textarea>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <hr>
                                        <fieldset class="form-group">
                                            <div class="row">
                                                <legend class="col-form-label col-sm-2 pt-0">A</legend>
                                                <div class="col-sm-10">
                                                    <textarea id="editor2" name="option_1"></textarea>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset class="form-group">
                                            <div class="row">
                                                <legend class="col-form-label col-sm-2 pt-0">B</legend>
                                                <div class="col-sm-10">
                                                    <textarea id="editor3" name="option_2"></textarea>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset class="form-group">
                                            <div class="row">
                                                <legend class="col-form-label col-sm-2 pt-0">C</legend>
                                                <div class="col-sm-10">
                                                    <textarea id="editor4" name="option_3"></textarea>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <div class="form-group row">
                                            <div class="col-sm-4">
                                                <button type="submit" class="btn btn-primary">Tambah Soal</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                    </div>

                </div>
                <script>
                    ClassicEditor
                        .create( document.querySelector( '#editor1' ), {
                            ckfinder: {
                                uploadUrl: '<?= base_url()."/group/".$Group['group_code']."/quiz/".$quiz_hash?>/quest/uploadImage',
                            } 
                        })
                        .catch( error => {
                            console.error( error );
                          } );
                    ClassicEditor
                        .create( document.querySelector( '#editor2' ), {
                            ckfinder: {
                                uploadUrl: '<?= base_url()."/group/".$Group['group_code']."/quiz/".$quiz_hash?>/quest/uploadImage',
                            } 
                        })
                        .catch( error => {
                            console.error( error );
                        } );
                    ClassicEditor
                        .create( document.querySelector( '#editor3' ), {
                            ckfinder: {
                                uploadUrl: '<?= base_url()."/group/".$Group['group_code']."/quiz/".$quiz_hash?>/quest/uploadImage',
                            } 
                        })
                        .catch( error => {
                            console.error( error );
                        } );
                    ClassicEditor
                        .create( document.querySelector( '#editor4' ), {
                            ckfinder: {
                                uploadUrl: '<?= base_url()."/group/".$Group['group_code']."/quiz/".$quiz_hash?>/quest/uploadImage',
                            } 
                        })
                        .catch( error => {
                            console.error( error );
                        } );
                    ClassicEditor
                        .create( document.querySelector( '#editor5' ), {
                            ckfinder: {
                                uploadUrl: '<?= base_url()."/group/".$Group['group_code']."/quiz/".$quiz_hash?>/quest/uploadImage',
                            } 
                        })
                        .catch( error => {
                            console.error( error );
                        } );
                </script>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->