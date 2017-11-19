<!DOCTYPE html>
<html>
<head>
<title>
    <?=$title?>
</title>
</head>

<body>
<h1><?=$header?></h1>
<?php
if(isset($_SESSION['success'])){
    ?>
    <div >
        <font color="green">
            <?=get_session_clear('success')?>
        </font>
    </div>
    <?php
}
?>

<?php
if(isset($_SESSION['error'])){
    ?>
    <div >
        <font color="red">
            <?=get_session_clear('error')?>
        </font>
    </div>
    <?php
}
?>
<p>
<?=$content?>
</p>
</body>
</html>