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
                    <h4 class="card-title">Buyer's Details</h4>
                    <p class="card-description"> Buyer <code>.table</code>
                    </p>
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Contact</th>
                          <th>Registerd Date</th>
                          <th>Status</th>
                          <th>View Profile</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                          $i=1;
                          $sel="select * from tbl_buyer";
                          $row=mysqli_query($con,$sel);
                          while($data=mysqli_fetch_array($row))
                          {
                          ?>
                        <tr>
                          <td><?php echo $i?></td>
                          <td><?php echo $data['buyer_name'];?></td>
                          <td><?php echo $data['buyer_email'];?></td>
                          <td><?php echo $data['buyer_phno'];?></td>
                          <td><?php echo $data['buyer_reg_date'];?></td>
                          <?php
                          if($data['buyer_status']=="active")
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
                          <td class="text-danger"><a href="buyer_profile.php?buyer_id=<?php echo $data['buyer_id'];?>"> View Profile </a></td>
                        </tr>
                          
                          <?php
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

