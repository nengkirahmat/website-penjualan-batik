<?php
   if (isset($_POST['login'])){
        $username=$_POST['username'];
        $password=$_POST['password'];
        $query="select * from tbl_admin where username='$username' and password='$password'";
       	$res=$con->query($query);
       	$res=$res->fetch_array(MYSQLI_BOTH);
        if ($res['username']===$username and $res['password']===$password){
            $_SESSION['id_admin']=$res['id_admin'];
            $_SESSION['username']=$res['username'];
           header('location:index.php');
        }
        else{
            echo "Login Gagal.";
        }
    }

?>
<form action="#" method="POST">
<h3>Login Admin</h3>
    <label>Username</label><br>
    <input type="text" required="" name="username" size="30"><br><br>
    <label>Password</label><br>
    <input type="password" required="" name="password" size="30"><br><br>
    <button type="submit" name="login" class="btn-blue">Login</button>
</form>      
