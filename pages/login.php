<?php
session_start();
require '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);

    if (!empty($username) && !empty($password)) {
        try {
            $sql = "SELECT user_id, username, email, password, role FROM users WHERE username = :username";
            $stmt = $pdo->prepare($sql);
            $stmt->execute(['username' => $username]);
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($user && password_verify($password, $user['password'])) {
                // Set session variables
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['username'] = $user['username'];

                // Redirect to the cart page
                header("Location: cart.php");
                exit;
            } else {
                echo "Invalid username or password.";
            }
        } catch (PDOException $e) {
            echo "Database error: " . $e->getMessage();
        }
    } else {
        echo "Please fill in all fields.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <style>
@media (max-width: 1024px) {
    .wrapper {
        width: 95%;
        max-width: 600px;
    }

    .wrapper .form_box h2 {
        font-size: 26px;
    }

    .input_box {
        height: 40px;
    }

    .input_box input {
        font-size: 14px;
    }

    .input_box label {
        font-size: 12px;
    }

    .input_box i {
        font-size: 16px;
    }

    .btn {
        height: 40px;
        font-size: 14px;
    }

    .form_box .logreg-link {
        font-size: 14px;
    }

    .wrapper .info-text h2 {
        font-size: 28px;
    }

    .wrapper .info-text p {
        font-size: 14px;
    }

    .wrapper .bg-anmiate,
    .wrapper .bg-anmiate2 {
        width: 600px;
        height: 450px;
        top: -4px;
    }

    .wrapper .bg-anmiate2 {
        top: 95%;
    }
}

@media (max-width: 768px) {
    .wrapper {
        width: 90%;
        max-width: 450px;
    }

    .wrapper .form_box {
        width: 100%;
        padding: 0 20px;
    }

    .input_box {
        height: 35px;
        margin: 15px 0;
    }

    .input_box input {
        font-size: 14px;
    }

    .input_box label {
        font-size: 12px;
    }

    .input_box i {
        font-size: 14px;
    }

    .btn {
        height: 40px;
        font-size: 14px;
    }

    .form_box .logreg-link {
        font-size: 12px;
    }

    .wrapper .info-text h2 {
        font-size: 24px;
    }

    .wrapper .info-text p {
        font-size: 12px;
    }

    .wrapper .bg-anmiate,
    .wrapper .bg-anmiate2 {
        width: 500px;
        height: 400px;
        top: -4px;
    }

    .wrapper .bg-anmiate2 {
        top: 90%;
    }
}

@media (max-width: 480px) {
    .wrapper {
        width: 95%;
        max-width: 360px;
        padding: 15px;
    }

    .wrapper .form_box {
        padding: 0 10px;
    }

    .wrapper .form_box h2 {
        font-size: 20px;
    }

    .input_box {
        height: 30px;
        margin: 10px 0;
    }

    .input_box input {
        font-size: 12px;
    }

    .input_box label {
        font-size: 10px;
    }

    .input_box i {
        font-size: 14px;
    }

    .btn {
        height: 35px;
        font-size: 12px;
    }

    .form_box .logreg-link {
        font-size: 10px;
    }

    .wrapper .info-text h2 {
        font-size: 20px;
    }

    .wrapper .info-text p {
        font-size: 10px;
    }

    .wrapper .bg-anmiate,
    .wrapper .bg-anmiate2 {
        width: 360px;
        height: 300px;
        top: -4px;
    }

    .wrapper .bg-anmiate2 {
        top: 85%;
    }
}

@import url('https://fonts.googleapis.com/css2?family=Caprasimo&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
}

body {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: #CB9DF0; /* Main background color */
}

.wrapper {
    position: relative;
    width: 750px;
    height: 450px;
    background: transparent;
    border: 2px solid #F0C1E1; /* Border color */
    box-shadow: 0 0 25px #F0C1E1;
    overflow: hidden;
}

.wrapper .form_box {
    position: absolute;
    top: 0;
    width: 50%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.wrapper .form_box.login {
    left: 0;
    padding: 0 60px 0 40px;
}

.wrapper .form_box.login .anmiation {
    transform: translateX(0);
    opacity: 1;
    filter: blur(0);
    transition: .7s ease;
}

.wrapper.active .form_box.login .anmiation {
    transform: translateX(-120%);
    opacity: 0;
    filter: blur(10px);
    transition-delay: calc(.1s * var(--i));
}

.form_box h2 {
    font-size: 32px;
    color: white; /* Heading color */
    text-align: center;
}

.wrapper .form_box.register {
    right: 0;
    padding: 0 40px 0 60px;
}

.wrapper .form_box.register .anmiation {
    transform: translateX(120%);
    opacity: 0;
    filter: blur(10px);
    transition: .7s ease;
}

.wrapper.active .form_box.register .anmiation {
    transform: translateX(0);
    opacity: 1;
    filter: blur(0);
    transition-delay: calc(.1s * var(--i));
}

.form_box .input_box {
    position: relative;
    width: 100%;
    height: 50px;
    margin: 25px 0;
}

.input_box input {
    width: 100%;
    height: 100%;
    background: transparent;
    border: none;
    outline: none;
    border-bottom: 2px solid #F0C1E1; /* Input underline */
    padding-right: 23px;
    font-size: 16px;
    transition: .5s;
    color: white; /* Input text */
    font-weight: 500;
}

.input_box input:focus,
.input_box input:valid {
    border-bottom-color: #F0C1E1;
}

.input_box label {
    position: absolute;
    top: 50%;
    left: 0;
    transform: translateY(-50%);
    font-size: 16px;
    color: white; /* Label color */
    pointer-events: none;
    transition: -5s;
}

.input_box input:focus ~ label,
.input_box input:valid ~ label {
    top: -5px;
    color: white;
}

.input_box i {
    position: absolute;
    top: 50%;
    right: 0;
    transform: translateY(-50%);
    font-size: 18px;
    color: white; /* Icon color */
    transition: .5s;
}

.input_box input:focus ~ i,
.input_box input:valid ~ i {
    color: white;
}

.btn {
    position: relative;
    width: 100%;
    height: 45px;
    background: transparent;
    border: 2px solid white; /* Button border */
    outline: none;
    border-radius: 40px;
    cursor: pointer;
    font-size: 16px;
    color: white; /* Button text */
    font-weight: 600;
    z-index: 1;
    overflow: hidden;
}

.btn::before {
    content: "";
    position: absolute;
    top: -100%;
    left: 0;
    width: 100%;
    height: 300%;
    background: linear-gradient(#F0C1E1, #FDDBBB, #F0C1E1, #FDDBBB);
    z-index: -1;
    transition: .5s;
}

.btn:hover::before {
    top: 0;
}

.form_box .logreg-link {
    font-size: 14.5px;
    color: white; /* Text color */
    text-align: center;
    margin: 20px 0 10px;
}

.logreg-link p a {
    color: white; /* Link color */
    text-decoration: none;
    font-weight: 600;
}

.logreg-link p a:hover {
    text-decoration: underline;
}

.wrapper .info-text {
    position: absolute;
    top: 0;
    width: 50%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.wrapper .info-text.login {
    right: 0;
    text-align: right;
    padding: 0 40px 60px 150px;
}

.wrapper .info-text.login .anmiation {
    transform: translateX(0);
    opacity: 1;
    filter: blur(0);
    transition: .7s ease;
}

.wrapper.active .info-text.login .anmiation {
    transform: translateX(120%);
    opacity: 0;
    filter: blur(10px);
    transition-delay: calc(.1s * var(--i));
}

.info-text.register {
    left: 0;
    text-align: left;
    padding: 0 150px 60px 40px;
    pointer-events: none;
}

.info-text h2 {
    font-size: 36px;
    color: white; /* Info heading */
    line-height: 1.3;
    text-transform: uppercase;
}

.info-text p {
    font-size: 16px;
    color: white; /* Info text */
}

.wrapper .bg-anmiate {
    position: absolute;
    top: -4px;
    right: 0;
    width: 850px;
    height: 600px;
    background: linear-gradient(45deg, #F0C1E1, #CB9DF0);
    border-bottom: 3px solid #CB9DF0;
    transform: rotate(10deg) skewY(40deg);
    transform-origin: bottom right;
    transition: 1.5s ease;
}

.wrapper.active .bg-anmiate {
    transform: rotate(0) skewY(0);
    transition-delay: .5s;
}

.wrapper .bg-anmiate2 {
    position: absolute;
    top: 100%;
    left: 250px;
    width: 850px;
    height: 600px;
    background: #F0C1E1;
    border-top: 3px solid #CB9DF0;
    transform: rotate(0) skewY(0);
    transform-origin: bottom left;
    transition: 1.5s ease;
}

.wrapper.active .bg-anmiate2 {
    transform: rotate(-11deg) skewY(-41deg);
    transition-delay: 1.2s;
}

.wrapper .info-text.register .anmiation {
    transform: translateX(-120%);
    opacity: 0;
    filter: blur(10px);
    transition: .7s ease;
    transition-delay: calc(.1s * var(--j));
}

.wrapper.active .info-text.register .anmiation {
    transform: translateX(0);
    opacity: 1;
    filter: blur(0);
    transition-delay: calc(.1s * var(--i));
}
</style>
</head>
<body>


    <div class="wrapper">
        <span class="bg-anmiate"></span>
        <span class="bg-anmiate2"></span>
        <div class="form_box login">
            <h2 class="anmiation" style="--i:0">login</h2>
            <form method="POST" action="login.php">
    <div class="input_box anmiation" style="--i:1">
        <input type="text" name="username" required>
        <label>Username</label>
        <i class='bx bxs-user'></i>
    </div>
    <div class="input_box anmiation" style="--i:2">
        <input type="password" name="password" required>
        <label>Password</label>
        <i class='bx bxs-lock-alt'></i>
    </div>
    <button type="submit" class="btn anmiation" style="--i:3">Login</button>
    <div class="logreg-link anmiation" style="--i:4">
        <p>Don't have an account? <a href="#" class="register_link">Sign up</a></p>
    </div>
</form>

        </div>
        <div class="info-text login">
            <h2 class="anmiation" style="--i:0;">welcome back</h2>
            <p class="anmiation" style="--i:1;">Login to check your orders and add to your cart </p>

        </div>


        <div class="form_box register">
            <h2 class="anmiation" style="--i:17">Sign Up</h2>
            <form method="POST" action="./register.php">
                <div class="input_box anmiation" style="--i:18">
                <input type="text" name="username" id="username" required>
                <label for="username">Username</label>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input_box anmiation"style="--i:19">
                <input type="email" name="email" id="email" required>
                <label for="email">Email</label>
                    <i class='bx bxs-user'></i>
                </div>
                <div class="input_box anmiation"style="--i:20">
                <input type="password" name="password" id="password" required>
                <label for="password">Password</label>
                    <i class='bx bxs-lock-alt'></i>
                </div>
                <button type="submit" class="btn anmiation"style="--i:21">Sign up</button>
                <div class="logreg-link anmiation"style="--i:22">
                    <p>Already  have an account? <a href="#" class="login-link">login</a>
                
                    </p>
                </div>
            </form>
        </div>
        <div class="info-text register ">
            <h2 class="anmiation" style="--i:17; --j:0">welcome To Flora</h2>
            <p class="anmiation"style="--i:18 --j:1" >register now for a better shopping experience  </p>
        </div>


    </div>
    
<script>
const wrapper=document.querySelector('.wrapper');
const rigisterlink=document.querySelector('.register_link');
const loginlink=document.querySelector('.login-link');


rigisterlink.onclick =()=> {
    wrapper.classList.add('active');


}
loginlink.onclick =()=> {
    wrapper.classList.remove('active');
    

}
</script>
</body>
</html>