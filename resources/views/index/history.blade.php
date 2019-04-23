<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<h1>历史记录</h1>
<hr/><hr/>
<table border=1 >
    <tr>
        <td>ID</td>
        <td>商品名称</td>
        <td>浏览时间</td>
    </tr>
    @foreach ($arr as $k=>$v)
        <tr>
            <td>{{ $v->goods_id }}</td>
            <td>{{ $v->goods_name }}</td>
            <td>{{ $v->create_time }}</td>
        </tr>
    @endforeach
</table>
</body>
</html>

