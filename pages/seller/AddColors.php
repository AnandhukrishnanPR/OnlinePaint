<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!-- partial -->
<?php include '../header.php'; ?>
<?php

$pcolor_id=$_GET['pcolor_id'];
$paint_id=$_GET['paint_id'];

if($pcolor_id)
{
    $sels="select * from tbl_paint_color where pcolor_id='".$pcolor_id."'";
    $rows=mysqli_query($con,$sels);
    $datas=mysqli_fetch_array($rows);
    $name=$datas['pcolor_name'];
    $em=$datas['pcolor_value'];
    $im=$datas['pcolor_pic'];
    $paint_id=$datas['paint_id'];
    $sels2="select * from tbl_paint where paint_id='".$paint_id."'";
    $rows2=mysqli_query($con,$sels2);
    $datas2=mysqli_fetch_array($rows2);
}
else
{
    $sels2="select * from tbl_paint where paint_id='".$paint_id."'";
    $rows2=mysqli_query($con,$sels2);
    $datas2=mysqli_fetch_array($rows2);
}

if(isset($_POST['btnsave']))
{
    $selc="select * from tbl_paint_color where pcolor_name='".$_POST['txtname']."' and pcolor_value='".$_POST['txtvalue']."' and paint_id='".$paint_id."' and pcolor_status='active'";
    $rowc=mysqli_query($con,$selc);
    $numc= mysqli_num_rows($rowc);
    if($numc>0)
    {
        echo "<script>
            var cid='".$pcolor_id."';
        alert('This Paint Color is already exists');
        window.location.href='AddColors.php?pcolor_id='+cid;
        </script>";
    }else{
        $dd=date('Y-m-d');
        $img=$_FILES['txtpic']['name'];
        $temp=$_FILES['txtpic']['tmp_name'];
        $ext=pathinfo($img,PATHINFO_EXTENSION);
        $ra=rand(10000,10000000);
        $img1=basename($img,$ext);
        $image=$dd.$ra.".".$ext;
        move_uploaded_file($temp,"../colors/".$image);
        $ins="insert into tbl_paint_color(pcolor_name,pcolor_value,paint_id,pcolor_pic) values('".$_POST['txtname']."','".$_POST['txtvalue']."','".$paint_id."','".$image."')";
        mysqli_query($con,$ins);
        echo "<script>
            var pid='".$paint_id."';
        alert('Color Added successfully');
        window.location.href='AddColors.php?paint_id='+pid;
        </script>";
    }
}

if(isset($_POST['btnupdate']))
{
    $selc="select * from tbl_paint_color where pcolor_name='".$_POST['txtname']."' and pcolor_value='".$_POST['txtvalue']."' and paint_id='".$paint_id."' and pcolor_status='active' and pcolor_id<>'".$pcolor_id."'";
    $rowc=mysqli_query($con,$selc);
    $numc= mysqli_num_rows($rowc);
    if($numc>0)
    {
        echo "<script>
            var cid='".$pcolor_id."';
        alert('This Paint Color is already exists');
        window.location.href='AddColors.php?pcolor_id='+cid;
        </script>";
    }else{
        $dd=date('Y-m-d');
        $img=$_FILES['txtpic']['name'];
        $temp=$_FILES['txtpic']['tmp_name'];
        if($img=="")
        {
            $image=$im;
        }
        else
        {
            echo "<script>alert('".$img."');</script>";
            $ext=pathinfo($img,PATHINFO_EXTENSION);
            $ra=rand(10000,10000000);
            $img1=basename($img,$ext);
            $image=$dd.$ra.".".$ext;
            move_uploaded_file($temp,"../colors/".$image);
        }
        $ins="update tbl_paint_color set pcolor_name='".$_POST['txtname']."',pcolor_value='".$_POST['txtvalue']."',pcolor_pic='".$image."' where pcolor_id='".$pcolor_id."'";
        mysqli_query($con,$ins);
        echo "<script>
            var pid='".$paint_id."';
        alert('Color Updated successfully');
        window.location.href='AddColors.php?paint_id='+pid;
        </script>";
    }
}


if(isset($_POST['btnaccept']))
{
    $ins="update tbl_paint_color set pcolor_status='active' where pcolor_id='".$pcolor_id."'";
    mysqli_query($con,$ins);
    echo "<script>
    alert('Activated successfully');
    window.location.href='ViewPaints.php';
    </script>";
    
}

if(isset($_POST['btnreject']))
{
    $ins="update tbl_paint_color set pcolor_status='deactive' where pcolor_id='".$pcolor_id."'";
    mysqli_query($con,$ins);
    echo "<script>
    alert('Deactivated successfully');
    window.location.href='ViewPaints.php';
    </script>";
}

if(isset($_POST['btncancel']))
{
    
    header("Location:ViewPaints.php");
    
}

?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Paint Color Details</h4>
                        <form method="post" enctype="multipart/form-data" class="form-sample">
                            <p class="card-description"> Color info </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Paint:</label>
                                        <div class="col-sm-10">
                                            <input type="text" disabled="" value="<?php echo $datas2['paint_name']; ?>" placeholder="Enter Name" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Price:</label>
                                        <div class="col-sm-10">
                                            <input type="text" disabled="" placeholder="Enter Rate" value="<?php echo $datas2['paint_price']; ?>" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Name:</label>
                                        <div class="col-sm-10">
                                            <input type="text" pattern="[a-zA-z ]{2,20}" required="" name="txtname" value="<?php echo $name; ?>" placeholder="Enter Name" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Value:</label>
                                        <div class="col-sm-10">
                                            <input type="value" required="" name="txtvalue" placeholder="Enter Value" value="<?php echo $em; ?>" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-3 col-form-label">Color Pic:</label>
                                        <div class="col-sm-9">
                                            <input type="file" name="txtpic" placeholder="Select Photo" class="form-control" />
                                            <?php
                                            if($pcolor_id!=0)
                                            {
                                            ?>
                                            <img src="../colors/<?php echo $im;?>" style="width: 100px;height: 100px;">
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
                                        if($pcolor_id!=0)
                                        {
                                            ?>
                                        <button type="submit" name="btnaccept" class="btn btn-success mr-2"> Activate </button>
                                        <button type="submit" name="btnreject" class="btn btn-light mr-2">Deactivate</button>
                                        <button type="submit" name="btnupdate" style="float: right;background-color: #00ffb8;margin-left: 50%;" class="btn btn-gradient-primary"> UPDATE </button>
                                        <a href="ViewPaints.php" class="btn btn-gradient-light">BACK</a>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                        <button type="submit" name="btnsave" class="btn btn-gradient-primary mr-2"> SAVE </button>
                                        <a href="ViewPaints.php" class="btn btn-success">FINISH</a>
                                        <!--&nbsp;&nbsp;<a href="ViewPaints.php" class="btn btn-gradient-light">CANCEL</a>-->
                                            <?php
                                        }
                                        ?>
                                        
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                  <div class="card-body">
                    <h4 class="card-title">Other Colors</h4>
                    <p class="card-description"> Colors <code>.table</code>
                    </p>
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Color</th>
                          <th>Status</th>
                          <th>Edit</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                          $i=1;
                          $sel2="select * from tbl_paint_color where paint_id='".$paint_id."' and pcolor_id<>'".$pcolor_id."'";
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
                            <a href="AddColors.php?pcolor_id=<?php echo $data2['pcolor_id'];?>"><img src="../colors/<?php echo $data2['pcolor_pic'];?>" style="margin: 5px;width: 30px;height: 30px;"> </a><br>
                          </td>
                          <?php
                          if($data2['pcolor_status']=="active")
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
                          <td class="text-success"><a href="AddColors.php?pcolor_id=<?php echo $data2['pcolor_id'];?>"> Edit </a></td>
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