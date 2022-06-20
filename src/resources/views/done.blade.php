@extends('layouts.done')

@section('done-content')
@switch($status)
  @case('reserve')
  <p class="done-content">ご予約ありがとうございます</p>
  <a href="/" class="btn">戻る</a>
  @break
  @case('change')
  <p class="done-content">ご予約を変更しました</p>
  <a href="/mypage" class="btn">戻る</a>
  @break
  @case('cancel')
  <p class="done-content">ご予約をキャンセルしました</p>
  <a href="/mypage" class="btn">戻る</a>
  @break
@endswitch
@endsection