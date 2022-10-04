<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!-- partial -->
<?php
include '../header.php';
$upd="update tbl_paint_order_head set pohead_cash='Paid',pohead_cash_date=curdate() where pohead_id='".$_SESSION['pohead_id']."'";
mysqli_query($con, $upd);
$sels = "select * from tbl_buyer where buyer_id='" . $_SESSION['UserID'] . "'";
$rows = mysqli_query($con, $sels);
$num_rows = mysqli_num_rows($rows);
$datas = mysqli_fetch_array($rows);
?>
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
<style>
    .my_th{
        text-align: left;
        font-weight: bold;
    }
</style>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-2">
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <div id="divToPrint">
                        <h2 style="text-align: center; color: #3399FF">PAINT OUTLET</h2>
                        <p class="card-description" style="text-align: center;">Transaction ID: <?php echo rand(10000, 10000000); ?> </p><br>
                        <form method="post" class="form-sample" >
                            
                            <table align="center" width="100%" height="100px" style="font-size:1em;" class="auto-style1">
                                <tr>
                                    <td>Name: </td>
                                    <td style="font-weight:bold;">&nbsp; <?php echo $datas['buyer_name']; ?></td>
                                    <td>Date: </td>
                                    <td style="font-weight:bold;">&nbsp;<?php echo date("d-m-Y"); ?></td>
                                </tr>
                            </table>
                            <table class="table table-hover" width="100%" style="min-height: 150px">
                                <thead>
                                    <tr>
                                        <td class="my_th" style="color: red;">No</td>
                                        <td class="my_th" style="color: red;">Paint</td>
                                        <td class="my_th" style="color: red;">Color</td>
                                        <td class="my_th" style="color: red;">Rate</td>
                                        <td class="my_th" style="color: red;">Litre</td>
                                        <td class="my_th" style="color: red;">Unit Total</d>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $i = 1;
                                    $tot_amount = 0;
                                    $sel = "select * from tbl_paint_order_detail od inner join tbl_paint_color pc on od.pcolor_id=pc.pcolor_id inner join tbl_paint p on pc.paint_id=p.paint_id where od.podetail_status<>'deactive' and od.pohead_id='" . $_SESSION['pohead_id'] . "'";
                                    $row = mysqli_query($con, $sel);
                                    while ($data = mysqli_fetch_array($row)) {
                                        $tot_amount = $tot_amount + $data['podetail_unit_total'];
                                        ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $data['paint_name']; ?></td>
                                            <td><?php echo $data['pcolor_name']; ?></td>
                                            <td><?php echo $data['podetail_rate_per_lr']; ?></td>
                                            <td><?php echo $data['podetail_lr']; ?></td>
                                            <td><?php echo $data['podetail_unit_total']; ?> /-</td>
                                        </tr>

                                        <?php
                                        $i++;
                                    }
                                    ?>
                               
                                    <tr>
                                        <td colspan="2">Total Amount:</td>
                                        <td colspan="3" > <hr></td>
                                        <td style="color: green;font-weight: bold;"><?php echo $tot_amount; ?> /-</td>
                                    </tr>
                                </tbody>
                            </table>
                            <hr><hr>
                            <br><br>
                        </form>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row" style="text-align: center">
                                        <input type="submit" value="" name="btnsub" Width="108px" OnClick="PrintDiv();" style="background-image:url('Icons/1391813769_printer.png');background-repeat:no-repeat;height:50px;width:50px;border:none;margin-left: 45%;"  />
                                    </div>
                                </div>
                            </div>
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