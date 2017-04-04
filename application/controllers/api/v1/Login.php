<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
	public function index()
	{
		if($_SERVER["REQUEST_METHOD"] == "POST"){  
	    $email = $_POST['email'];  
	    $password = $_POST['password'];  
	    $password = md5($password);
	    $data[] = null;
	    $error = null;

	    $sql = "select * from admin where email = '$email' and password = '$password'";
        $result = mysqli_query($link,$sql);
        $data[] = mysqli_fetch_assoc($result);
        echo json_encode([
            'code' => 200,
            'message'=> 'Success',
            'error' => $error,
            'data' => $data,
            ]);
	}
}