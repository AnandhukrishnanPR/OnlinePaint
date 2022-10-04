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
                    <h4 class="card-title">Design's Details</h4>
                    <p class="card-description"> Design <code>.table</code>
                    </p>
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Name</th>
                          <th>Rate per Sq Feet</th>
                          <th>Photo</th>
                          <th>Status</th>
                          <th>View More</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                          $i=1;
                          $sel="select * from tbl_design";
                          $row=mysqli_query($con,$sel);
                          while($data=mysqli_fetch_array($row))
                          {
                              
                          ?>
                        <tr>
                          <td><?php echo $i?></td>
                          <td><?php echo $data['design_name'];?></td>
                          <td><?php echo $data['design_rate_per_sqfeet'];?></td>
                          <td>
                              
                          <?php
                          $sel2="select * from tbl_design_photo where dphoto_status<>'deactive' and design_id='".$data['design_id']."'";
                          $row2=mysqli_query($con,$sel2);
                          $num_cl= mysqli_num_rows($row2);
                          if($num_cl>0)
                          {
                              while($data2=mysqli_fetch_array($row2))
                            {
                            ?>
                            <a href="AddDesignPhotos.php?dphoto_id=<?php echo $data2['dphoto_id'];?>"><img src="../designs/<?php echo $data2['dphoto'];?>" style="margin: 5px;width: 30px;height: 30px;"> </a><br>
                            <?php
                            }
                          }
                          if($data['design_status']=="active")
                          {
                          ?>
                            <a href="AddDesignPhotos.php?design_id=<?php echo $data['design_id'];?>">Add Photos </a><br>
                            <?php
                          }
                          ?>
                          </td>
                          <?php
                          if($data['design_status']=="active")
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
                          <td class="text-success"><a href="AddDesigns.php?design_id=<?php echo $data['design_id'];?>"> View More </a></td>
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

