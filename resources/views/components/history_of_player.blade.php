@php
    $user_id = isset($user) ? $user : \Illuminate\Support\Facades\Auth::guard('user')->id();
    $list = \Illuminate\Support\Facades\DB::table('list_of_team_names')
        ->join('teams_posts', 'list_of_team_names.post_id', '=', 'teams_posts.id')
        ->join('teams_names', 'list_of_team_names.team_name_id', '=', 'teams_names.id')
        ->join('teams_game_seasons', 'list_of_team_names.game_season_id', '=', 'teams_game_seasons.id')
        ->select(
            'list_of_team_names.*',
            'teams_posts.name as post_name',
            'teams_names.name as team_name',
            'teams_game_seasons.name as seasons_name',
        )
        ->where('accounts_id', '=', $user_id)
        ->get();
@endphp

@if (!$list->isEmpty())
    <table class="table table-striped text-center table-hover">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col">ثبت نهایی</th>
                <th scope="col">شماره پیراهن</th>
                <th scope="col">سمت</th>
                <th scope="col">رده</th>
                <th scope="col">تیم</th>
                <th scope="col">نام و نام خانوادگی</th>
                <th scope="col">#</th>
            </tr>
        </thead>
        <tbody>
            @php $i = 0; @endphp

            @foreach ($list as $l)
                <tr>
                    <td>
                        @if ($l->status_user_submit == 'undone')
                            <form method="POST"
                                action="{{ route('dashboard.list.delete', [
                                    'seasons_game_id' => $l->game_season_id,
                                    'team_id' => $l->team_name_id,
                                    'list_id' => Hashids::encode($l->id),
                                ]) }}">
                                @csrf
                                <input name="_method" type="hidden" value="DELETE">
                                <button type="submit" class="btn btn-xs btn-outline-danger btn-flat show_confirm"
                                    data-toggle="tooltip" title='Delete'>حذف
                                </button>
                            </form>
                        @endif
                    </td>
                    <td>
                        @if ($l->status_approved == 'undone')
                            <a href="{{ route('dashboard.team.list.edit', ['id' => $l->game_season_id, 'name_id' => $l->team_name_id, 'list_id' => Hashids::encode($l->id)]) }}"
                                class="text-decoration-none btn btn-xs btn-outline-primary">ویرایش</a>
                        @else
                            <a title="{{ "در تاریخ {$l->status_approved_at} توسط هیات تایید شده" }}"
                                class="btn btn-danger">غیرقابل ویرایش</a>
                        @endif
                    </td>
                    <td>
                        @if ($l->status_user_submit == 'undone')
                            {{ 'انجام نشده' }}
                        @else
                            {{ 'انجام گردید' }}
                        @endif
                    </td>
                    <td>{{ $l->t_shirt_number }}</td>
                    <td>
                        {{ $l->post_name }}
                    </td>
                    <td>{{ $l->seasons_name }}</td>
                    <td>{{ $l->team_name }}</td>
                    <td>{{ $l->name . ' ' . $l->surname }}</td>
                    <th scope="row">{{ ++$i }}</th>
                </tr>
                @php $i++; @endphp
            @endforeach
        </tbody>
    </table>

@endif
