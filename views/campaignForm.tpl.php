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
    var formData = new FormData();
    formData.append('name', 'testName');
    formData.append('status', '1');
    formData.append('goal', '50');
    formData.append('impression', '0');
    formData.append('restrictions[0]', '{"type" : "interval", "first_value" : "2016-11-18 10:00:00", "second_value" : "2016-11-20 10:00:00"}');
    formData.append('banners[0]', '{"name" : "testName", "caption" : "testCaption", "click_url" : "testClickUrl", "image_file" : "' + $('input[type=file]')[0].files[0] + '", "size_x" : 100, "size_y" : 100}');
    formData.append('image_file', $('input[type=file]')[0].files[0]);
    $.ajax({
        url: "campaigns",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

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
<input type="file">
<input type="button" value="Post" onclick="post();" />
<input type="button" value="Put" onclick="put();" />
</html>