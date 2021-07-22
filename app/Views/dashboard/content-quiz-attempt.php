<?php
    $db = \Config\Database::connect();
    $user   = $db->table('users')->getWhere(['username'=>$usrn])->getRowArray();
    $Group  = $db->table('groups')->getWhere(['id'=>$group])->getRowArray();
    $Quiz   = $db->table('quiz')->getWhere(['hash'=>$quiz_hash])->getRowArray();
    $Quest  = $db->table('questions')->getWhere(['id_quiz'=>$Quiz['id']]);                                
?>

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Content -->
                    <div class="px-4">
                        <div class="row">
                            <div class="col-md-8">
                            <?php
                                $quest  = $Quest->getResult();
                                $i = 1;
                                $n = NULL;
                                foreach($quest as $item){
                                    $Answer = $db->table('answers')->where('id_quiz',$Quiz['id'])->getWhere(['id_question'=>$item->id])->getRowArray();                                   
                            ?>
                                <div class="card py-3 px-3 mb-3">
                                    <div class="d-flex flex-row">
                                        <div class="mr-1"><?= $i++?>.</div>
                                        <div class="px-1"><?= $item->question;?></div>
                                    </div>
                                </div>
                                <div class="container py-2">
                                    <form method="post">
                                        <input type="radio" id="option_1" name="option<?=$item->id?>" value="A" onChange="myFunction(<?=$item->id?>)"
                                          <?php if($Answer and $Answer['answer'] == "A"): echo"checked";endif;?>>
                                        <label for="option_1"><?= $item->option_1;?></label><br>
                                        <input type="radio" id="option_2" name="option<?=$item->id?>" value="B" onChange="myFunction(<?=$item->id?>)"
                                          <?php if($Answer and $Answer['answer'] == "B"): echo"checked";endif;?>>
                                        <label for="option_2"><?= $item->option_2;?></label><br>
                                        <input type="radio" id="option_3" name="option<?=$item->id?>" value="C" onChange="myFunction(<?=$item->id?>)"
                                          <?php if($Answer and $Answer['answer'] == "C"): echo"checked";endif;?>>
                                        <label for="option_3"><?= $item->option_3;?></label>
                                    </form>
                                    
                                </div>         
                            <?php } ?>
                            <script>
                                function myFunction(id) {
                                        var qid= id;
                                        var option=$("input[name='option"+id+"']:checked").val();
                                        $.ajax({
                                            type : "POST",
                                            url  : "<?= base_url()."/group/".$Group['group_code']."/quiz/".$quiz_hash."/answer/mark/"; ?>"+qid,
                                            dataType : "JSON",
                                            data : {option:option},
                                            success: function(data){
                                            }
                                        });
                                        return false;
                                }
                            </script>
                            </div>
                        </div>
                    </div>
                    
                </div>   
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->