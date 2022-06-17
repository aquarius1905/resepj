function confirmRating(event) {//評価の送信確認
  if (confirm('評価を送信しますか？')) {
    form.submit();
  } else {
    event.preventDefault();
  }
}

function confirmDeletion(event) {//予約の削除確認
  if (confirm('予約を削除しますか？')) {
    form.submit();
  } else {
    event.preventDefault();
  }
}

function confirmChangeReservation(event) {//予約の変更確認
  if (confirm('予約を変更しますか？')) {
    form.submit();
  } else {
    event.preventDefault();
  }
}

function confirmRegistration(event) {//登録の確認
  if (confirm('登録しますか？')) {
    form.submit();
  } else {
    event.preventDefault();
  }
}

function confirmShopRegisteration(event) {//店舗情報登録
  if (confirm('店舗情報を登録しますか？')) {
    form.submit();
  } else {
    event.preventDefault();
  }
}

function confirmShopUpdate(event) {//店舗情報登録
  if (confirm('店舗情報を更新しますか？')) {
    form.submit();
  } else {
    event.preventDefault();
  }
}