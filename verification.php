<?php include('admin/config.php') ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="CodeHim">
     <title>  <?= $system_title; ?></title>
    <!-- website icon -->
    <link rel="shortcut icon" href="images/logo.png"/>
    <!-- Style CSS -->
    <link rel="stylesheet" href="./otp/style.css">
    <!-- Demo CSS (No need to include it into your project) -->
    <link rel="stylesheet" href="./otp/demo.css">
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css'>
</head>
<style type="text/css">
    body {
        padding-top: 60px;
        padding-bottom: 40px;
        background-image: url('images/bg.png');
        background-attachment: fixed;
        background-size: 100% 100%;
    }
</style>
<body>


<?php

if (isset($_GET['tryagain'])) {
    $otp = rand_strInt(6, 'x');
    sendSMS($_POST['contact'], 'YOUR NEW OTP CODE IS ' .$otp);
    $query = db_update('org_structure', ['otp' => $otp], ['contact' => $_SESSION['ccontact']]);
    $message = "New Code send.";
    echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
    exit();
}


if (isset($_POST['submit'])) {
    $otp = $_POST['d1'] . $_POST['d2'] . $_POST['d3'] . $_POST['d4'] . $_POST['d5'] . $_POST['d6'];
    $contact = $_POST['contact'];

    $result = $db->prepare("SELECT *  FROM  org_structure WHERE otp='$otp' AND contact_no='$contact'");
    $result->execute();
    if ($row = $result->fetch()) {
        $message = "Account Verified. You can now login.";
        echo "<script type='text/javascript'>alert('$message');window.location.href='admin/index';</script>";
        // echo "<script>window.open('admin/index','_self');</script>";
        exit();
    } else {
        $message = " Invalid input. Try again";
        echo "<script type='text/javascript'>alert('$message');history.go(-1);</script>";
        exit();
    }
}

?>
<main class="cd__main">
    <body class="container-fluid bg-body-tertiary d-block">
    <div class="row justify-content-center">
        <div class="col-12 col-md-6 col-lg-4" style="min-width: 500px;">
            <div class="card bg-white mb-5 mt-5 border-0" style="box-shadow: 0 12px 15px rgba(0, 0, 0, 0.02);">
                <div class="card-body p-5 text-center">
                    <form action="" method="POST">
                        <input type="hidden" name="contact" value="<?= $_SESSION['ccontact']; ?>"/>
                        <h4>Verify</h4>
                        <p>Your code was sent to you via otp</p>

                        <div class="otp-field mb-4">
                            <input type="number" name="d1" autofocus/>
                            <input type="number" name="d2" disabled/>
                            <input type="number" name="d3" disabled/>
                            <input type="number" name="d4" disabled/>
                            <input type="number" name="d5" disabled/>
                            <input type="number" name="d6" disabled/>
                        </div>

                        <button type="submit" name="submit" class="btn btn-primary mb-3">
                            Verify
                        </button>
                    </form>
                    <p class="resend text-muted mb-0">
                        Didn't receive code? <a href="verification.php?tryagain">Request again</a>
                    </p>
                </div>
            </div>
        </div>
    </div>

    </body>
</main>

<script src="./otp/script.js"></script>
</body>
</html>