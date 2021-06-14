
<?php include 'header.php';
include 'database.php';   
$obj = new database();

if(isset($_POST['update'])){

$id = $_POST['sid'];
$name = $_POST['sname'];
$address = $_POST['saddress'];
$class = $_POST['sclass'];
$phone = $_POST['sphone'];

$value = ["name"=>$name,"address"=>$address,"class"=>$class,"phone"=>$phone];
$obj->update('students',$value, "id='$id'");
header("Location: index.php");
}

?>
<div id="main-content">
    <h2>Edit Record</h2>
    <form class="post-form" action="" method="post">
        <div class="form-group">
            <label>Id</label>
            <input type="text" name="sid" />
        </div>
        <input class="submit" type="submit" name="showbtn" value="Show" />
    </form>

    <?php
    
    if(isset($_POST['showbtn'])){
    $id = $_POST['sid'];
    $obj->sql("SELECT * FROM students WHERE id = '{$id}'");
    $data1 = $obj->getresult();
    foreach($data1 as list("id"=>$id,"name"=>$name,"address"=>$address,"class"=>$class,"phone"=>$phone)){
    ?>


    <form class="post-form" action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="form-group">
            <label for="">Name</label>
            <input type="hidden" name="sid"  value="<?php echo $id  ?>" />
            <input type="text" name="sname" value="<?php echo $name  ?>" />
        </div>
        <div class="form-group">
            <label>Address</label>
            <input type="text" name="saddress" value="<?php echo  $address  ?>" />
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
            <input type="text" name="sphone" value="<?php echo $phone  ?>" />
        </div>
    <input class="submit" type="submit" value="Update" name="update"  />
    </form>
    <?php
}
}

    ?>
    

</div>
</div>
</body>
</html>
