<?php
session_start();
if (($_SESSION['login'] == false)) {
    header(("location: ../login/index_login.php"));
}
?>

<?php include('../template/header.php'); ?>
<p>
<h1>
    <marquee>WELLCOME TO MY PROJECK</marquee>

</h1>
</p>
<?php include('../template/footer.php'); ?>