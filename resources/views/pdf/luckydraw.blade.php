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
    <p style="text-align:center;line-height:1;">{{ uni2zg(setting('luckydraw-invoice-title-one')) }}</p>
    <p style="text-align:center;line-height:1;">{{ uni2zg(setting('luckydraw-invoice-title-two')) }}</p>
    <p style="text-align:center;line-height:1;">{{ uni2zg(setting('luckydraw-invoice-title-three')) }}</p>
{{--    <img src="{{$data}}" width="200" height="200">--}}
<table>
    <tbody>
    <tr>
        <td>ေျပစာအမွတ္</td>
        <td>{{ en_number($luckydraw['id']) }}</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>မဲနံပါတ္</td>
        <td>{{ en_number($luckydraw['lucky_no']) }}</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td>ရက္စြဲ</td>
        <td>{{ \Carbon\Carbon::parse($luckydraw['created_at'])->toDayDateTimeString() }}</td>
    </tr>

    </tbody>
</table>
<br>
<hr>
<br>
<p></p>
<table>
    <tbody>
    <tr>
        <td width="20%">လွဴဖြယ္ပစၥည္း</td>
        <td width="80%">ေငြပေဒသာ
            {{ en_number($luckydraw['amount']) }} က်ပ္ႏွင့္  {{ uni2zg($luckydraw['mtl']) }}</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td width="20%">အလွဴရွင္အမည္</td>
        <td width="80%" style="font-family: 'Zawgyi-One';">{!! uni2zg($luckydraw['donor']) !!}</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td width="20%">ေနရပ္လိပ္စာ </td>
        <td width="80%">{{ uni2zg($luckydraw['address']) }}</td>
    </tr>
    <tr>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
    </tr>
    <tr>
        <td></td>
        <td align="right">ပစၥည္းလက္ခံသူ</td>
    </tr>
    </tbody>
</table>
</body>
</html>

