<?php
//check the request method by server
if ($_SERVER['REQUEST_METHOD'] == 'GET'){
    //establish database connection//
    require_once('db.php');

    //data get from input//
    $fullname=mysqli_real_escape_string($con,$_REQUEST['fullname']); 
    $mobile=mysqli_real_escape_string($con,$_REQUEST['mobile']); 
    $password1=mysqli_real_escape_string($con,$_REQUEST['password1']);
    $password2=mysqli_real_escape_string($con,$_REQUEST['password2']);
    $referal_code=mysqli_real_escape_string($con,$_REQUEST['referal_code']);


    //validation checking of all input
            
            //checking all input//
            if(!empty($fullname) && !empty($mobile) && !empty($password1) && !empty($password2)){
                
                //password check//

                if($password1==$password2){
                    

                    //check user availablity//

                    $sql="SELECT * FROM account WHERE mobile='$mobile'";
                    $result=mysqli_query($con,$sql);
                    $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
                    $count=mysqli_num_rows($result);


                    if($count=='1'){
                        $response = array( "status" => "error","response" => "You Already Have Account");
                    }
                    else{

                        //data geeting//
                        $account_id=uniqid();
                        $otp=rand(1000,9999);
                        $password=md5($password2);
                        require_once('referal_system.php');

                        $sql = "INSERT INTO `account`(`id`, `account_id`, `wallet`, `fullname`, `mobile`, `password`, `referal_code`, `referal_user`, `otp`) VALUES
                        (null,'" . $account_id . "','" . $wallet . "','" . $fullname . "','" . $mobile . "','".$password."','" . $referal_code . "','" . $referal_user . "','" . $otp . "')";
                        $sql_query = mysqli_query($con, $sql);


                        
                        $response = array( "status" => "success","response" => "Account Created Successfully");








                    }

                }
                else{
                    $response = array( "status" => "error","response" => "Please Enter Correct Password");
                }
            
            
            
            }
            else{
                $response = array( "status" => "error","response" => "Please Enter Full Details");
            }

}
else{
    $response = array( "status" => "error","response" => "Access Right Request Method");
}   
//Json decode

echo json_encode($response);
