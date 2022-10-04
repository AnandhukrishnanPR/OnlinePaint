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
        $seller_id=$_GET['seller_id'];
        $rid=$_GET['rid'];
        if($rid)
        {
            $ins="update tbl_design_request_detail set drdetail_status='deactive' where drdetail_id='".$rid."'";
            mysqli_query($con,$ins);
            header("Location:RequestCart.php?drhead_id=".$drhead_id."&seller_id=".$seller_id);

        }
        ?>
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Design's Details</h4>
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
                          <th>Remove</th>
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
                              $seller_id=$data['seller_id'];
                              $tot_amount=$tot_amount+$data['drdetail_unit_total'];
                          ?>
                        <tr>
                          <td><?php echo $i?></td>
                          <td><?php echo $data['design_name'];?></td>
                          <td><?php echo $data['drdetail_rate_per_sqfeet'];?></td>
                          <td><?php echo $data['drdetail_sqfeet'];?></td>
                          <td><?php echo $data['drdetail_unit_total'];?></td>
                          <td><?php echo $data['drdetail_description'];?></td>
                          <td class="text-success"><a href="RequestCart.php?rid=<?php echo $data['drdetail_id'];?>&drhead_id=<?php echo $drhead_id;?>&seller_id=<?php echo $seller_id;?>">Remove </a></td>
                        </tr>
                          
                          <?php
                          $i++;
                          }
                          
                          ?>
                      </tbody>
                    </table>
                    <br><br><br>
                    <div class="row">
                        <form method="post" class="form-sample">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <a href="ViewDesigns.php?seller_id=<?php echo $seller_id?>&drhead_id=<?php echo $drhead_id;?>" class="btn btn-gradient-primary"> ADD DESIGNS </a>
                                    &nbsp;&nbsp;<button type="submit" name="btnsend" class="btn btn-success"> SEND REQUEST </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php
                    if(isset($_POST['btnsend']))
                    {
                        $ins2 = "update tbl_design_request_head set drhead_total_amount='" . $tot_amount . "' where drhead_id='".$drhead_id."'";
                        mysqli_query($con, $ins2);
//                        echo $ins2;
                        header("Location:DesignAddress.php?drhead_id=".$drhead_id);

                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <?php include '../footer.php'; ?>

