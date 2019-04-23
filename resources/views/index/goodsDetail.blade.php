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
<h1>商品详情</h1>
<hr/><hr/>
<table border=1 >
    <tr>
        <td>ID</td>
        <td>商品名称</td>
        <td>商品价格</td>
        <td>商品数量</td>
        <td>浏览量</td>
    </tr>
    <tr>
        <td>{{ $arr['goods_id'] }}</td>
        <td>{{ $arr['goods_name'] }}</td>
        <td>{{ $arr['goods_selfprice'] }}</td>
        <td>{{ $arr['goods_num'] }}</td>
        <td>{{ $arr['look_num'] }}</td>
    </tr>
</table>
</body>
</html>
