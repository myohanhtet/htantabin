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
    <h1 style="text-align:center;line-height:2;">အဝင္( @if(isset(request()->a_win)) {{ en_number(request()->a_win) }}  @else ..... @endif )</h1>
    <h1>မဲနံပါတ္ {{ en_number($lucky_number) }}</h1>
    <p>အလွဴခံပုဂၢိဳလ္  @if(isset(request()->sayadaw)) <u> {{ uni2zg(request()->sayadaw) }} </u> @else .............. @endif </p>
    <!-- <p></p> -->
    @foreach($luckys as $lucky)
        <p><strong>ေငြပေဒသာ {{ en_number($lucky['amount']) }} ႏွင့္ {{ uni2zg($lucky['mtl']) }}</strong> 
        <br>{{ uni2zg($lucky['donor']) }}<br>{{ uni2zg($lucky['address']) }} (ေျပစာအမွတ္ {{ en_number($lucky['id']) }} )</p>
        <!-- <p></p> -->
    @endforeach
    <hr><p></p>
    <p>ေငြပေဒသာစုစုေပါင္း : {{ en_number($luckys->sum('amount')) }} က်ပ္ | လွဴဖြယ္ပစၥည္းတန္ဖိုးစုစုေပါင္း : {{ en_number($luckys->sum('mtl_value'))}} က်ပ္</p>

    <p>ေစာင္ေရေပါင္း ({{ en_number($luckys->count()) }}) ေစာင္ | ႏွစ္ရပ္ေပါင္းတန္ဖိုး ({{ en_number($luckys->sum('amount')+ $luckys->sum('mtl_value') )  }}) က်ပ္</p>
</body>
</html>
