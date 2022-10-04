<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!-- partial -->
<?php include '../header.php'; ?>
<link rel="stylesheet" href="style.css">
<script type="text/javascript">
    function PrintDiv() {
        var divToPrint = document.getElementById('divToPrint');
        var popupWin = window.open('', '_blank', 'width=1500,height=700');
        popupWin.document.open();
        popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
    }
</script>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-2">
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title" style="text-align: center; color: #3399FF">Payment Success</h4><br><br>
                        <form method="post" class="form-sample">
                            <table align="center" width="100%" height="100px" style="font-size:1em;" class="auto-style1">
                                <tr>
                                    <td>Merchant: </td>
                                    <td style="font-weight:bold;">&nbsp;PAINT OUTLET </td>
                                    <td>Transaction ID: </td>
                                    <td style="font-weight:bold;">&nbsp; <?php echo rand(10000, 10000000); ?> </td>
                                </tr>
                                <tr>
                                    <td>Date: </td>
                                    <td style="font-weight:bold;">&nbsp;<?php echo date("d-m-Y"); ?></td>
                                    <td>Amount: </td>
                                    <td style="font-weight:bold;">&nbsp; Rs.<?php echo $_SESSION['total']; ?><strong>/-</strong></td>
                                </tr>
                            </table>
                            <br><HR><br>
                            <table class="table table-hover">
                      <thead>
                        <tr>
                          <th>No</th>
                          <th>Name</th>
                          <th>Color</th>
                          <th>Rate</th>
                          <th>Litre</th>
                          <th align="right">Unit Total</th>
                          <!--<th>Remove</th>-->
                        </tr>
                      </thead>
                      <tbody>
                          <?php
                          $i=1;
                          $tot_amount=0;
                          $sel="select * from tbl_paint_order_detail od inner join tbl_paint_color pc on od.pcolor_id=pc.pcolor_id inner join tbl_paint p on pc.paint_id=p.paint_id where od.podetail_status<>'deactive' and od.pohead_id='".$pohead_id."'";
                          $row=mysqli_query($con,$sel);
                          while($data=mysqli_fetch_array($row))
                          {
                              $tot_amount=$tot_amount+$data['podetail_unit_total'];
                          ?>
                        <tr>
                          <td><?php echo $i?></td>
                          <td><?php echo $data['paint_name'];?></td>
                          <td><?php echo $data['pcolor_name'];?></td>
                          <td><?php echo $data['podetail_rate_per_lr'];?></td>
                          <td><?php echo $data['podetail_lr'];?></td>
                          <td align="right"><?php echo $data['podetail_unit_total'];?></td>
                          <!--<td class="text-success"><a href="PaintCart.php?rid=<?php echo $data['podetail_id'];?>">Remove </a></td>-->
                        </tr>
                          
                          <?php
                          $i++;
                          }
                          
                          ?>
                        <tr>
                            <td colspan="5" >Total AMount:</td>
                            <td colspan="1" align="right"><?php echo $dataq['pohead_total_amount'];?> /-</td>
                        </tr>
                      </tbody>
                    </table>
                            <br><br>
                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group row" style="text-align: center">
                                        <input type="submit" value="" name="btnsub" Width="108px" OnClick="PrintDiv();" style="background-image:url('Icons/1391813769_printer.png');background-repeat:no-repeat;height:50px;width:50px;border:none;margin-left: 40%;"  />
                                    </div>
                                </div>
                            </div>
                        </form>
                        <br><br>
                        <h4 class="card-title" style="text-align: center; color: #3399FF">Thank You</h4>
                    </div>
                </div>
            </div>
            <div class="col-2">
            </div>
        </div>
    </div>
    <!-- content-wrapper ends -->
<?php include '../footer.php'; ?>