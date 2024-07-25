
<div class="items">
    <!-- FETCH ALL ROOM -->
    <?php 
        $sql_fetch_room = "SELECT * FROM `room`";
        try{
            $resultRoom= mysqli_query($conn,$sql_fetch_room);
            if(mysqli_num_rows($resultRoom) > 0){
                while ( $row = mysqli_fetch_assoc($resultRoom)){
                ?>
                    <div class="item">
                    <h5 class="heading">
                        <?php echo $row['roomName']?>
                        <div class="subheading"><?php echo $row['address1']?></div>
                    </h5>
                </div>
    
                <?php };
     
             }
             else{
                 echo "Could not find room";
             }
    
        }
    
        catch(mysqli_sql_exception){
            echo "Could not find room";
        }   
    
    ?>
</div>