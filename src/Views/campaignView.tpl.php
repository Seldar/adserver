<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">

</head>
<body>
<b>Campaign info:</b><br>
Name: <?php echo ($data->getName()); ?><br>
Status: <?php echo ($data->isStatus()); ?><br>
Goal: <?php echo ($data->getGoal()); ?><br>
Impression: <?php echo ($data->getImpression()); ?><br>
Banners: <?php foreach ($data->getBanners() as $banner) {
    echo "<a href='/" . $rootUrl . "/banners/" . $banner->getId() . "'>" . $banner->getName() . "</a> | ";
} ?><br>
Restrictions: <?php foreach ($data->getRestrictions() as $restriction) {
    echo $restriction->getType() . " - " . $restriction->getFirstValue() . " - " . $restriction->getSecondValue() . " | ";
} ?><br>
</body>
</html>