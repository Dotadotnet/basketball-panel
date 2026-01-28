<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Print</title>
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
</head>
<body>
<div class="print-card">
    <div class="category">
        @foreach($season_game as $g)
            @if($g->id == $list->game_season_id)
                @foreach($category as $c)
                    @if($c->id == $g->category_id)
                        {{ $c->name }}
                    @endif
                @endforeach
            @endif
        @endforeach
    </div>
    <div class="year">
        @foreach($season_game as $g)
            @if($g->id == $list->game_season_id)
                {{ str_split($g->date, 4)[0] }}
            @endif
        @endforeach
    </div>
    <img class="photocase" src="
                @if(!is_null($list->photo_case))
    {{ route('admin.image.view', ['id' => $hash->encode($list->photo_case)]) }}
    @endif
        " alt="">
    <div class="team">
        @foreach($team as $t)
            @if($t->id == $list->team_name_id)
                {{ $t->name }}
            @endif
        @endforeach
    </div>
    <div class="name">{{ $list->name }}</div>
    <div class="surname">{{ $list->surname }}</div>
    <div class="post">
        @foreach($post as $p)
            @if($p->id == $list->post_id)
                {{ $p->name }}
            @endif
        @endforeach
    </div>
    <div class="birthdate">{{ $list->birthdate }}</div>
    <div class="code">{{ $list->national_code }}</div>
    <div class="tShirt">
{{--        <img src="{{ asset('images/tshirt.png') }}">--}}
        <p>شماره پیراهن</p>
        <span>{{ $list->t_shirt_number }}</span>
    </div>
</div>
{{--<script src="{{ asset('bootstrap/js/bootstrap.js') }}" defer></script>--}}
</body>
</html>
