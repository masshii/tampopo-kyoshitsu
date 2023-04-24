<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>お問い合わせを受け付けました</title>
</head>
<body>
  <p>お問い合わせ内容は次のとおりです。</p>
  －－－－
  <p>件名:{{$contact['title']}}</p>
  <p>お問い合わせ内容:{{$contact['body']}}</p>
  <p>メールアドレス:{{$contact['email']}}</p>
  －－－－
  <p>担当の者よりご連絡いたしますので、今しばらくお待ちください。</p><br>
  <p class="mt-4">&copy; たんぽぽ書道教室</p>
</body>
</html>