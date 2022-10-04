<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
        <!-- partial -->
        <?php include '../header.php'; ?>
        <?php
        $pohead_id=$_GET['pohead_id'];
        $seller_id=$_GET['seller_id'];
        $rid=$_GET['rid'];
        if($rid)
        {
            $ins="update tbl_paint_order_detail set podetail_status='deactive' where podetail_id='".$rid."'";
            mysqli_query($con,$ins);
            header("Location:PaintCart.php?pohead_id=".$pohead_id."&seller_id=".$seller_id);

        }
        ?>
        <div class="main-panel">
          <div class="content-wrapper">
            <div class="row">
              <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <h4 class="card-title">Paint's Details</h4>
                    <p class="card-description"> Paint <code>.table</code>
                    </p>
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Name</th>
                          <th>Color</th>
                          <th>Rate</th>
                          <th>Litre</th>
                          <th>Unit Total</th>
                          <th>Remove</th>
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                          $i=1;
                          $tot_amount=0;
                          $sel="select * from tbl_paint_order_detail od inner join tbl_paint_color pc on od.pcolor_id=pc.pcolor_id inner join tbl_paint p on pc.paint_id=p.paint_id where od.podetail_status<>'deactive' and od.pohead_id='".$pohead_id."'";
                          $row=mysqli_query($con,$sel);
                          $num= mysqli_num_rows($row);
                          if($num>0)
                          {
                            while($data=mysqli_fetch_array($row))
                            {
                                $seller_id=$data['seller_id'];
                                $tot_amount=$tot_amount+$data['podetail_unit_total'];
                            ?>
                          <tr>
                            <td><?php echo $i?></td>
                            <td><?php echo $data['paint_name'];?></td>
                            <td><?php echo $data['pcolor_name'];?></td>
                            <td><?php echo $data['podetail_rate_per_lr'];?></td>
                            <td><?php echo $data['podetail_lr'];?></td>
                            <td><?php echo $data['podetail_unit_total'];?></td>
                            <td class="text-success"><a href="PaintCart.php?rid=<?php echo $data['podetail_id'];?>&pohead_id=<?php echo $pohead_id;?>&seller_id=<?php echo $seller_id;?>">Remove </a></td>
                          </tr>

                            <?php
                            $i++;
                            }
                          }
                          else{
                              $data=mysqli_fetch_array($row);
                              $seller_id=$data['seller_id'];
                          }
                          ?>
                      </tbody>
                    </table>
                    <br><br><br>
                    <div class="row">
                        <form method="post" class="form-sample">
                            <div class="col-md-12">
                                <div class="form-group row">
                                    <a href="ViewPaints.php?seller_id=<?php echo $seller_id;?>&pohead_id=<?php echo $pohead_id;?>" class="btn btn-gradient-primary"> ADD ITEMS </a>
                                    &nbsp;&nbsp;<button type="submit" name="btnsend" class="btn btn-success"> SEND ORDER </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php
                    if(isset($_POST['btnsend']))
                    {
                        $adid=$_POST['txtoadd'];
                        $ins2 = "update tbl_paint_order_head set pohead_total_amount='" . $tot_amount . "' where pohead_id='".$pohead_id."'";
                        mysqli_query($con, $ins2);
                        header("Location:PaintAddress.php?pohead_id=".$pohead_id);

                    }
                    ?>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- content-wrapper ends -->
          <?php include '../footer.php'; ?>

