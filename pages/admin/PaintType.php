<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<!-- partial -->
<?php include '../header.php'; ?>
<?php
$ptype_id = $_GET['eptype_id'];
$dptype_id = $_GET['dptype_id'];

if ($ptype_id) {
    $sels = "select * from tbl_paint_type where ptype_id='" . $ptype_id . "'";
    $rows = mysqli_query($con, $sels);
    $datas = mysqli_fetch_array($rows);
    $name = $datas['ptype'];
}

if (isset($_POST['btnsave'])) {
    $ins = "insert into tbl_paint_type(ptype) values('" . $_POST['txtname'] . "')";
    mysqli_query($con, $ins);
    header("Location:PaintType.php");
}

if (isset($_POST['btnupdate'])) {
    $ins = "update tbl_paint_type set ptype='" . $_POST['txtname'] . "' where ptype_id='" . $ptype_id . "'";
    mysqli_query($con, $ins);
    echo "<script>
    alert('Updated successfully');
    window.location.href='PaintType.php';
    </script>";
}

if ($dptype_id) {
    $ins = "update tbl_paint_type set ptype_status='deactive' where ptype_id='" . $dptype_id . "'";
    mysqli_query($con, $ins);
    echo "<script>
    alert('Deleted successfully');
    window.location.href='PaintType.php';
    </script>";
}

if (isset($_POST['btncancel'])) {

    header("Location:seller_view.php");
}
?>
<div class="main-panel">
    <div class="content-wrapper">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Paint Types</h4>
                        <form method="post" class="form-sample">
                            <p class="card-description"> Personal info </p>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">
                                        <label class="col-sm-2 col-form-label">Name:</label>
                                        <div class="col-sm-10">
                                            <input type="text" required="" name="txtname" value="<?php echo $name; ?>" placeholder="Enter Name" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <br><br><br>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group row">

                                    <?php
                                    if ($ptype_id != 0) {
                                        ?>
                                        <button type="submit" name="btnupdate" class="btn btn-gradient-primary mr-2"> UPDATE </button>
                                        <?php
                                    } else {
                                        ?>
                                            <button type="submit" name="btnsave" class="btn btn-gradient-primary mr-2"> SAVE </button>
                                        <?php
                                    }
                                    ?>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Paint Type Details</h4>
                        <p class="card-description"> Paint Types <code>.table</code>
                        </p>
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Paint Type</th>
                                    <th>Edit</th>
                                    <th>Delete</th>
                                </tr>
                            </thead>
                            <tbody>
<?php
$i = 1;
$sel = "select * from tbl_paint_type where ptype_status<>'deactive'";
$row = mysqli_query($con, $sel);
while ($data = mysqli_fetch_array($row)) {
    ?>
                                    <tr>
                                        <td><?php echo $i ?></td>
                                        <td><?php echo $data['ptype']; ?></td>
                                        <td class="text-success"><a href="PaintType.php?eptype_id=<?php echo $data['ptype_id']; ?>"> Edit </a></td>
                                        <td class="text-danger"><a href="PaintType.php?dptype_id=<?php echo $data['ptype_id']; ?>"> Delete </a></td>
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