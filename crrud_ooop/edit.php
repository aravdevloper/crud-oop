<?php include 'header.php';
include 'database.php';
$obj = new database();
$upd_id = $_GET['id'];
$obj->sql("SELECT * FROM students WHERE id = '{$upd_id}'");
$data1 = $obj->getresult();
foreach($data1 as list("id"=>$id,"name"=>$name,"address"=>$address,"class"=>$class,"phone"=>$phone)){

?>

<div id="main-content">
    <h2>Update Record</h2>
    <form class="post-form" action="update.php" method="post">
      <div class="form-group">
          <label>Name</label>
          <input type="hidden" name="sid" value="<?php echo $id ?>"/>
          <input type="text" name="sname" value="<?php echo $name ?>"/>
      </div>
      <div class="form-group">
          <label>Address</label>
          <input type="text" name="saddress" value="<?php echo $address ?>"/>
      </div>
      <div class="form-group">
          <label>Class</label>
          <select name="sclass">
              <option value="" selected disabled>Select Class</option>
            <?php

            $obj->sql("SELECT * FROM class");
            $data = $obj->getresult();
            foreach($data as list("cid"=>$cid,"cname"=>$cname)){
            
            if($class == $cid){
            $select = "selected"; 
            }else{
            $select = "";
            }
            
              echo "<option {$select} value='$cid'>$cname</option>";
            }

            ?>
          </select>
      </div>
      <div class="form-group">
          <label>Phone</label>
          <input type="text" name="sphone" value="<?php echo $phone ?>"/>
      </div>
      <input class="submit" type="submit" value="Update" name="update" />
    </form>
    <?php
  }
    ?>
</div>
</div>
</body>
</html>
