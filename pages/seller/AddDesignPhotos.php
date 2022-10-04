<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!-- partial -->
<?php include '../header.php'; ?>
<?php

$dphoto_id=$_GET['dphoto_id'];
$design_id=$_GET['design_id'];

if($dphoto_id)
{
    $sels="select * from tbl_design_photo where dphoto_id='".$dphoto_id."'";
    $rows=mysqli_query($con,$sels);
    $datas=mysqli_fetch_array($rows);
    $im=$datas['dphoto'];
    $design_id=$datas['design_id'];
    $sels2="select * from tbl_design where design_id='".$design_id."'";
    $rows2=mysqli_query($con,$sels2);
    $datas2=mysqli_fetch_array($rows2);
}else{
    $sels2="select * from tbl_design where design_id='".$design_id."'";
    $rows2=mysqli_query($con,$sels2);
    $datas2=mysqli_fetch_array($rows2);
}

if(isset($_POST['btnsave']))
{
    $dd=date('Y-m-d');
    $img=$_FILES['txtpic']['name'];
    $temp=$_FILES['txtpic']['tmp_name'];
    $ext=pathinfo($img,PATHINFO_EXTENSION);
    $ra=rand(10000,10000000);
    $img1=basename($img,$ext);
    $image=$dd.$ra.".".$ext;
    move_uploaded_file($temp,"../designs/".$image);
    $ins="insert into tbl_design_photo(design_id,dphoto) values('".$design_id."','".$image."')";
    mysqli_query($con,$ins);
    echo "<script>
        var cid='".$design_id."';
    alert('Design Added Successfully');
    window.location.href='AddDesignPhotos.php?design_id='+cid;
    </script>";
}

if(isset($_POST['btnupdate']))
{
    $dd=date('Y-m-d');
    $img=$_FILES['txtpic']['name'];
    $temp=$_FILES['txtpic']['tmp_name'];
    if($img=="")
    {
        $image=$im;
    }
    else
    {
        $ext=pathinfo($img,PATHINFO_EXTENSION);
        $ra=rand(10000,10000000);
        $img1=basename($img,$ext);
        $image=$dd.$ra.".".$ext;
        move_uploaded_file($temp,"../designs/".$image);
    }
    $ins="update tbl_design_photo set dphoto='".$image."' where dphoto_id='".$dphoto_id."'";
    mysqli_query($con,$ins);
    echo "<script>
        var cid='".$design_id."';
    alert('Design Updated Successfully');
    window.location.href='AddDesignPhotos.php?design_id='+cid;
    </script>";
    
}


if(isset($_POST['btnaccept']))
{
    $ins="update tbl_design_photo set dphoto_status='active' where dphoto_id='".$dphoto_id."'";
    mysqli_query($con,$ins);
    echo "<script>
        var cid='".$design_id."';
    alert('Designs Activated Successfully');
    window.location.href='AddDesignPhotos.php?design_id='+cid;
    </script>";
    
}

if(isset($_POST['btnreject']))
{
    $ins="update tbl_design_photo set dphoto_status='deactive' where dphoto_id='".$dphoto_id."'";
    mysqli_query($con,$ins);
    echo "<script>
        var cid='".$design_id."';
    alert('Designs Deactivated Successfully');
    window.location.href='AddDesignPhotos.php?design_id='+cid;
    </script>";
}

if(isset($_POST['btncancel']))
{
    
    header("Location:ViewDesigns.php");
    
}

?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Design Photos</h4>
                        <form method="post" enctype="multipart/form-data" class="form-sample">
                            <p class="card-description"> Design info </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Design Pic:</label>
                                        <div class="col-sm-9">
                                            <input type="file" name="txtpic" placeholder="Select Photo" class="form-control" />
                                            <?php
                                            if($dphoto_id!=0)
                                            {
                                            ?>
                                            <img src="../designs/<?php echo $im;?>" style="width: 100px;height: 100px;">
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br><br><br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        
                                        <?php
                                        if($dphoto_id!=0)
                                        {
                                            ?>
                                        <button type="submit" name="btnaccept" class="btn btn-success mr-2"> Activate </button>
                                        <button type="submit" name="btnreject" class="btn btn-danger mr-2">Deactivate</button>
                                        <button type="submit" name="btnupdate" style="float: right;background-color: #00ffb8;margin-left: 45%;" class="btn btn-gradient-primary"> UPDATE </button>&nbsp;&nbsp;
                                        <a href="ViewDesigns.php" class="btn btn-gradient-light">BACK</a>                                        
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                        <button type="submit" name="btnsave" class="btn btn-gradient-primary mr-2"> SAVE </button>
                                        <a href="ViewDesigns.php" class="btn btn-success">FINISH</a>
                                        <!--&nbsp;&nbsp;<a href="ViewDesigns.php" class="btn btn-gradient-light">Cancel</a>-->
                                            <?php
                                        }
                                        ?>
                                        
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                  <div class="card-body">
                    <h4 class="card-title">Other Photos</h4>
                    <p class="card-description"> Photos <code>.table</code>
                    </p>
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Photo</th>
                          <th>Status</th>
                          <th>Edit</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                          $i=1;
                          $sel2="select * from tbl_design_photo where design_id='".$design_id."' and dphoto_id<>'".$dphoto_id."'";
                          $row2=mysqli_query($con,$sel2);
                          $num_cl= mysqli_num_rows($row2);
                          if($num_cl>0)
                          {
                              while($data2=mysqli_fetch_array($row2))
                            {
                            ?>
                        <tr>
                          <td><?php echo $i?></td>
                          <td>
                            <a href="AddDesignPhotos.php?dphoto_id=<?php echo $data2['dphoto_id'];?>"><img src="../designs/<?php echo $data2['dphoto'];?>" style="margin: 5px;width: 30px;height: 30px;"> </a><br>
                          </td>
                          <?php
                          if($data2['dphoto_status']=="active")
                          {
                          ?>
                          <td><label class="badge badge-success"> Active </label></td>
                          <?php   
                          }
                          else
                          {
                          ?>
                          <td><label class="badge badge-danger"> Deactive </label></td>
                          <?php
                          }
                          ?>
                          <td class="text-success"><a href="AddDesignPhotos.php?dphoto_id=<?php echo $data2['dphoto_id'];?>"> Edit </a></td>
                        </tr>
                          <?php
                            $i++;
                            }
                          }
                          ?>
                          
                          
                      </tbody>
                    </table>
                  </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <?php include '../footer.php'; ?>