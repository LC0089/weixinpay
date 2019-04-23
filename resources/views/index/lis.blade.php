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
<h1>点击量展示</h1>
<hr/><hr/>
<table border=1 >
    <tr>
        <td>ID</td>
        <td>商品名称</td>
        <td>商品价格</td>
        <td>商品数量</td>
        <td>商品点击量</td>
    </tr>
    @foreach ($arr as $v)
        <tr>
            <td>{{ $v->goods_id }}</td>
            <td>{{ $v->goods_name }}</td>
            <td>{{ $v->goods_selfprice }}</td>
            <td>{{ $v->goods_selfprice }}</td>
            <td>{{ $v->look_num }}</td>
        </tr>
    @endforeach
</table>
</body>
</html>
