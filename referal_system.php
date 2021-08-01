<?php
if(empty($referal_code)){
    $referal_code="na";
    $referal_user="na";
    $wallet = "0";

}
else{
    //database connection
    require_once('db.php');
    //get data of referal user
    $sql_ref="SELECT * FROM account WHERE `mobile`='$referal_code'";
    $result_ref=mysqli_query($con,$sql_ref);
    $row_ref=mysqli_fetch_array($result_ref,MYSQLI_ASSOC);
    $referal_user = $row_ref['fullname'];
    $referal_code = $row_ref['mobile'];
    $wallet_user = $row_ref['wallet'];
    //get wallet amount//
    $sql_setting="SELECT * FROM `setting`";
    $result_setting=mysqli_query($con,$sql_setting);
    $row_setting=mysqli_fetch_array($result_setting,MYSQLI_ASSOC);
    $wallet = $row_setting['register_amt'];
    //update refferal amount to shared user//


    $update_wallet=$wallet_user+$wallet;
    $update = "UPDATE `account` SET wallet = '$update_wallet'";
    $query_update=mysqli_query($con, $update);

    //transaction log are remain
    $date=date('d/m/Y');
    $day=date('l');
    $month=date('F');
    $year=date('Y');
    $time=date('H:i');


    $sql_referal_1 = "INSERT INTO `transaction`(`id`, `date`, `day`, `month`, `year`, `transaction_id`, `user_id`, `amount`, `action`, `title`, `status`) VALUES 
    (null,'" . $account_id . "','" . $wallet . "','" . $fullname . "','" . $mobile . "','".$password."','" . $referal_code . "','" . $referal_user . "','" . $otp . "')";
    $sql_query_referal_1 = mysqli_query($con, $sql_referal_1);










}