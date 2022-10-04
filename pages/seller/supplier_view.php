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
                    <h4 class="card-title">Supplier's Details</h4>
                    <p class="card-description"> Supplier <code>.table</code>
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
                          <th>View More</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                          $i=1;
                          $sel="select * from tbl_supplier";
                          $row=mysqli_query($con,$sel);
                          while($data=mysqli_fetch_array($row))
                          {
                          ?>
                        <tr>
                          <td><?php echo $i?></td>
                          <td><?php echo $data['supplier_name'];?></td>
                          <td><?php echo $data['supplier_email'];?></td>
                          <td><?php echo $data['supplier_phno'];?></td>
                          <td><?php echo $data['supplier_experience'];?></td>
                          <?php
                          if($data['supplier_status']=="active")
                          {
                          ?>
                          <td><label class="badge badge-success"> Active </label></td>
                          <td class="text-success"><a href="supplier_reg.php?supplier_id=<?php echo $data['supplier_id'];?>"> View More </a></td>
                          <?php   
                          }
                          else
                          {
                          ?>
                          <td><label class="badge badge-danger"> Deactive </label></td>
                          <td class="text-danger"><a href="supplier_reg.php?supplier_id=<?php echo $data['supplier_id'];?>"> View More </a></td>
                          <?php
                          }
                          ?>
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

