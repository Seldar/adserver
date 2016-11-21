<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="UTF-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
</head>
<body>
<script lang="javascript">
function post()
{
    var serializedData = {'name' : "testName",'status': 1, "goal": 50, "impression": 0,
        "restrictions":
        [
            {'type' : 'interval', 'first_value' : '2016-11-18 10:00:00', 'second_value' : '2016-11-20 10:00:00'}
        ],
        "banners" :
        [
            {'name' : "testName", 'caption' : "testCaption", "click_url" : "testClickUrl", "image_file" : "testImageFile", "size_x" : 100, "size_y" : 100}
        ]
    };
    $.ajax({
        url: "campaigns",
        type: "post",
        data: serializedData
    });
}

function put()
{
    var serializedData = {'id': 1, 'status': 0};
    $.ajax({
        url: "campaigns",
        type: "put",
        data: serializedData
    });
}
</script>
</body>
<input type="button" value="Post" onclick="post();" />
<input type="button" value="Put" onclick="put();" />
</html>