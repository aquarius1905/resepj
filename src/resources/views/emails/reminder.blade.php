<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <style>
    .user-name,
    .thanks-text {
      margin-bottom: 30px;
    }
    .shop-name {
      margin-top: 30px;
    }
    .content-ttl {
      margin-bottom: 0;
    }
    .top-partation {
      margin-top: 0;
    }
</style>
</head>
<body>
  <p class="user-name">{{ $reservation->getUserName() }}　様</p>

  <p class="text">この度はご予約頂き誠にありがとうございます。<br>
  ご予約日当日となりましたので、お知らせ致します。<br>
  ご予約内容は以下の通りです。</p>

  <p class="top-partation">-------------------------</p>
  <p>お名前：{{ $reservation->getUserName() }}　様</p>
  <p>店名：{{ $reservation->getShopName() }}</p>
  <p>予約日：{{ $reservation->date->format('Y年m月d日') }}</p>
  <p>時間：{{ $reservation->time->format('H時i分') }}</p>
  <p>人数：{{ $reservation->number }}人</p>
  <p>--------------------------<p>

  <p>  ご来店お待ちしております。</p>

  <p class="shop-name">{{ $reservation->getShopName() }}</p>
</body>
</html>

