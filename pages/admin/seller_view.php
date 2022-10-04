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
                    <h4 class="card-title">Seller's Details</h4>
                    <p class="card-description"> Seller <code>.table</code>
                    </p>
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Name</th>
                          <th>Email</th>
                          <th>Contact</th>
                          <th>Experience</th>
                          <th>Status</th>
                          <th>View Profile</th>
                          <th>View Paints</th>
                          <th>View Designs</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                          $i=1;
                          $sel="select * from tbl_seller";
                          $row=mysqli_query($con,$sel);
                          while($data=mysqli_fetch_array($row))
                          {
                          ?>
                        <tr>
                          <td><?php echo $i?></td>
                          <td><?php echo $data['seller_name'];?></td>
                          <td><?php echo $data['seller_email'];?></td>
                          <td><?php echo $data['seller_phno'];?></td>
                          <td><?php echo $data['seller_experience'];?></td>
                          <?php
                          if($data['seller_status']=="active")
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
                          <td class="text-danger"><a href="seller_reg.php?seller_id=<?php echo $data['seller_id'];?>"> View Profile </a></td>
                          <td class="text-danger"><a href="ViewPaints.php?seller_id=<?php echo $data['seller_id'];?>"> View Paints </a></td>
                          <td class="text-danger"><a href="ViewDesigns.php?seller_id=<?php echo $data['seller_id'];?>"> View Designs </a></td>
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

