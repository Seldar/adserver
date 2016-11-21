<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">

</head>
<body>
<b>Banner info:</b><br>
Name: <?php echo ($data->getName()); ?><br>
Caption: <?php echo ($data->getCaption()); ?><br>
Click Url: <?php echo ($data->getClickUrl()); ?><br>
Image File: <?php echo ($data->getImageFile()); ?><br>
Size: <?php echo ($data->getSizeX() . "x" . $data->getSizeY()); ?><br>

</body>
</html>