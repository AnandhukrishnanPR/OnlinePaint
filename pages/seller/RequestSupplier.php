<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!-- partial -->
<?php include '../header.php'; ?>
<?php

$drhead_id=$_GET['drhead_id'];
$selq="select * from tbl_design_request_head ph inner join tbl_order_address oa on ph.oaddress_id=oa.oaddress_id inner join tbl_buyer b on ph.buyer_id=b.buyer_id where ph.drhead_id='".$drhead_id."'";
mysqli_query($con,$selq);
$rowq=mysqli_query($con,$selq);
$dataq=mysqli_fetch_array($rowq);
if(isset($_POST['btnaccept']))
{
    $ins="update tbl_design_request_head set drhead_status='accepted',drhead_starting_date='".$_POST['txtdate']."',supplier_id='".$_POST['selsup']."' where drhead_id='".$drhead_id."'";
    mysqli_query($con,$ins);
//    echo $ins;
    header("Location:ViewRequests.php");
}

if(isset($_POST['btncancel']))
{
    header("Location:ViewRequests.php");
}

?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                  <div class="card-body">
                        <h4 class="card-title">Design Details</h4>
                        <p class="card-description"> Design <code>.table</code>
                        </p>
                        <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Name</th>
                          <th>Rate per Sq Ft</th>
                          <th>Square Feet</th>
                          <th>Unit Total</th>
                          <th>Description</th>
                          <!--<th>Remove</th>-->
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                          $i=1;
                          $tot_amount=0;
                          $sel="select * from tbl_design_request_detail od inner join tbl_design p on od.design_id=p.design_id where od.drdetail_status<>'deactive' and od.drhead_id='".$drhead_id."'";
                          $row=mysqli_query($con,$sel);
                          while($data=mysqli_fetch_array($row))
                          {
                              $tot_amount=$tot_amount+$data['podetail_unit_total'];
                          ?>
                        <tr>
                          <td><?php echo $i?></td>
                          <td><?php echo $data['design_name'];?></td>
                          <td><?php echo $data['drdetail_rate_per_sqfeet'];?></td>
                          <td><?php echo $data['drdetail_sqfeet'];?></td>
                          <td><?php echo $data['drdetail_unit_total'];?></td>
                          <td><?php echo $data['drdetail_description'];?></td>
                          <!--<td class="text-success"><a href="PaintCart.php?rid=<?php //echo $data['drdetail_id'];?>">Remove </a></td>-->
                        </tr>
                          
                          <?php
                          $i++;
                          }
                          
                          ?>
                        <tr>
                            <td colspan="4" >Total AMount:</td>
                            <td><?php echo $dataq['drhead_total_amount'];?> /-</td>
                        </tr>
                      </tbody>
                    </table>
                      </div>
                    <div class="card-body">
                        <h4 class="card-title">Confirmation Details</h4>
                        <form method="post" class="form-sample">
                            <p class="card-description"> Confirmation info </p>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-5 col-form-label">Choose a Staring Date:</label>
                                        <div class="col-sm-7">
                                            <input type="date" required="" name="txtdate" value="<?php echo $name; ?>" placeholder="Enter Name" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group row">
                                        <label class="col-sm-4 col-form-label">Select Supplier:</label>
                                        <div class="col-sm-8">
                                            
                                            <select name="selsup" class="form-control" >
                                                <option>----------- Select Supplier---------</option>
                                                <?php
                                                    $selm = "select * from tbl_supplier where supplier_status<>'deactive'";
                                                    $rowm = mysqli_query($con, $selm);
                                                    while ($datam = mysqli_fetch_array($rowm)) {
                                                ?>
                                                <option value="<?php echo $datam['supplier_id']?>"<?php if($pt==$datam['supplier_id']){
                                                    ?>
                                                        selected=""
                                                    <?php
                                                        }
                                                    ?>><?php echo $datam['supplier_name']?></option>
                                            </select>
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
                                        <button type="submit" name="btnaccept" class="btn btn-gradient-primary mr-2"> FINISH </button>
                                        <a href="ViewOrders.php" class="btn btn-light">Cancel</a>
                                       
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
    <?php include '../footer.php'; ?>