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
                                    if(count($quest) == 0){
                                ?>
                                <div class="row">
                                    <div style="height: 30vw;" class="col-md-12 py-5 text-center">
                                        <h3>Belum ada soal di sini.</h3>
                                    </div>
                                </div>
                                <?php
                                    }
                                    $i = 1;
                                    foreach($quest as $item){
                                        $Answer = $db->table('answers')->where('id_attempt', $id_attempt)->getWhere(['id_question'=>$item->id])->getRowArray();                                   
                                ?>
                                <div class="row">
                                    <div class="col-md-12">
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
                                    </div>
                                </div>        
                                <?php } ?>
                                <script>
                                    function myFunction(id) {
                                            var qid= id;
                                            var option=$("input[name='option"+id+"']:checked").val();
                                            $.ajax({
                                                type : "POST",
                                                url  : "<?= base_url()."/group/".$Group['group_code']."/quiz/".$quiz_hash."/attempt/".$id_attempt."/mark/"; ?>"+qid,
                                                dataType : "JSON",
                                                data : {option:option},
                                                success: function(data){
                                                }
                                            });
                                            return false;
                                    }
                                </script>
                                <a href="<?= base_url()."/group/".$Group['group_code']."/quiz/".$quiz_hash."/attempt/".$id_attempt."/attemptFinish/"; ?>" 
                                    id="attSubmit" class="btn btn-primary mb-5 w-100">Finish Attempt</a>
                            </div>
                            <div class="col-md-4">
                            <div class="card py-3 px-3 mb-3">
                                <p id="demo" style="font-size:30px"></p>
                                <p><?php 
                                        $timeStart = $attempt_data['time_start'];
                                        date_default_timezone_set("Asia/Jakarta");
                                        $timeDurat = $timeStart + ($duration * 60);
                                        $timeEnd = date('Y-m-d\TH:i:s', $timeDurat);
                                        echo $timeEnd;
                                        $tes = $db->table('attempts')->where('id_quiz', $Quiz['id'])->where('id_user', $user['id'])
							                    ->countAllResults(false);
                                        echo " ".$tes;
                                    ?></p>
                            </div>
                            <script>
                            // Set the date we're counting down to
                            var end = new Date("<?=$timeEnd?>").getTime();

                            // Update the count down every 1 second
                            var countdownfunction = setInterval(function() {

                            // Get todays date and time
                            var now = new Date().getTime();
                            
                            // Find the distance between now an the count down date
                            var distance = end - now;
                            
                            // Time calculations for days, hours, minutes and seconds
                            var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                            var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                            var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                            var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                            
                            // Output the result in an element with id="demo"
                            document.getElementById("demo").innerHTML = days + "d " + hours + "h "
                            + minutes + "m " + seconds + "s ";
                            
                            // If the count down is over, write some text 
                            if (distance < 0) {
                                clearInterval(countdownfunction);
                                document.getElementById("demo").innerHTML = "EXPIRED";
                                attemptSubmit();
                            }
                            }, 1000);

                            // On mouse-over, execute myFunction
                            function attemptSubmit() {
                                document.getElementById("attSubmit").click(); // Click on the checkbox
                            }
                            </script>
                            </div>
                        </div>
                        <!-- /.row -->
                        
                    </div>
                    
                </div>   
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->