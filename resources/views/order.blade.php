<!DOCTYPE html>
<html>
<head>
    <title>Тестовое задание</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="/css/order.css">
</head>
<body>
<div class="col">
    @if ($message = Session::get('success'))
        <p class="alert-success">{{ $message }}</p>
    @endif
    @if ($message = Session::get('error'))
        <p class="alert-error">{{ $message }}</p>
    @endif


    <form id="new-deal" action="{{ route('create-order') }}" method="post">
        @csrf
        <p id="FIO">*&nbsp;ФИО</p>
        <input type="text" name="FIO" placeholder="ФИО.." id="FIO-input" />
        <p id="comment">*&nbsp;Комментарий клиента</p>
        <textarea type="text" name="comment" placeholder="Комментарий..." id="text-input" maxlength="200"></textarea>
        <p id="vendor">*&nbsp;Артикул товара</p>
        <input type="text" name="article" placeholder="AZ105W" id="vendor-input" value="AZ105W" />
        <p id="brand">*&nbsp;Бренд товара</p>
        <input type="text" name="brand" placeholder="Azalita" id="brand-input" value="Azalita" />
        <button class="btn" type="submit">Создать заказ</button>
    </form>
</div>
</body>
</html>
