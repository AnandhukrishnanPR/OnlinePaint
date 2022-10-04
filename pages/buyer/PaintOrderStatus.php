<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
        <!-- partial -->
        <?php include '../header.php'; ?>
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">My Order Details</h4>
                    <p class="card-description"> Order <code>.table</code>
                        <a href="ViewPaintCart.php" class="btn btn-info" style="float: right"> MY ORDER CART </a><br>
                    </p>
                    <br><br>
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Issued Date</th>
                          <th>No: of Items</th>
                          <th>Status</th>
                          <th>View More</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                          $i=1;
                          $sel="select * from tbl_paint_order_head where pohead_status<>'active' and buyer_id='".$_SESSION['UserID']."'";
                          $row=mysqli_query($con,$sel);
                          while($data=mysqli_fetch_array($row))
                          {
                                $sel2="select * from tbl_paint_order_detail where podetail_status<>'deactive' and pohead_id='".$data['pohead_id']."'";
                                $row2=mysqli_query($con,$sel2);
                                $num_cl= mysqli_num_rows($row2);
                          ?>
                        <tr>
                          <td><?php echo $i?></td>
                          <td><?php echo $data['pohead_issued_date'];?></td>
                          <td><?php echo $num_cl;?></td>
                          <?php
                          if($data['pohead_status']=="waiting...")
                          {
                          ?>
                          <td><label class="badge badge-gradient-info"> waiting... </label></td>
                          <td class="text-success"><a href="OrderProfile.php?pohead_id=<?php echo $data['pohead_id'];?>"> View More </a></td>
                          <?php   
                          }elseif($data['pohead_status']=="accepted")
                          {
                          ?>
                          <td><label class="badge badge-gradient-success"> Accepted </label></td>
                          <td class="text-success"><a href="AcceptedOrder.php?pohead_id=<?php echo $data['pohead_id'];?>"> View More </a></td>
                          <?php   
                          }elseif($data['pohead_status']=="rejected")
                          {
                          ?>
                          <td><label class="badge badge-gradient-danger"> Rejected </label></td>
                          <td>---</td>
                          <?php   
                          }
                          else
                          {
                          ?>
                          <td><label class="badge badge-gradient-warning"> Cancelled </label></td>
                          <td>---</td>
                          <?php
                          }
                          ?>
                          
                        </tr>
                          
                          <?php
                          $i++;
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

