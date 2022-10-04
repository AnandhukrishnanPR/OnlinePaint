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
                    <h4 class="card-title">My Cart</h4>
                    <p class="card-description"> Cart <code>.table</code>
                        <a href="PaintOrderStatus.php" class="btn btn-gradient-light" style="float: right">BACK</a><br><br><br>
                    </p>
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Issued Date</th>
                          <th>No: of Items</th>
                          <th>View More</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                          $i=1;
                          $sel="select * from tbl_paint_order_head where pohead_status='active' and buyer_id='".$_SESSION['UserID']."'";
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
                          <td class="text-success"><a href="CartProfile.php?pohead_id=<?php echo $data['pohead_id'];?>"> View More </a></td>
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

