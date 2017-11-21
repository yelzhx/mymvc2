<!DOCTYPE html>
<html>
<head>
<title>
    <?=(isset($title)) ? $title : ""?>
</title>
</head>

<body>
<h1><?=(isset($header)) ? $header : ""?></h1>
    <div >
        <font color="green">
            <?=get_session_clear('success')?>
        </font>
    </div>

    <div >
        <font color="red">
            <?=get_session_clear('error')?>
        </font>
    </div>
<p>
<?=$content?>
</p>
</body>
</html>