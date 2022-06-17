function setDate() {//予約日を反映
  const reservation_date = document.reservation_form.date;
  const confirm_date = document.getElementById('confirm-date');
  confirm_date.innerText = reservation_date.value;
}

function setTime() {//予約時間を反映
  const reservation_time = document.reservation_form.time;
  const selectedIndex = reservation_time.selectedIndex;
  const confirm_time = document.getElementById('confirm-time');
  confirm_time.innerText = reservation_time.options[selectedIndex].textContent;
}

function setPrice(numberStr, selectedCourseIndex) {//価格を反映
  if (selectedCourseIndex == -1) {
    const reservation_course = document.reservation_form.course_id;
    selectedCourseIndex = reservation_course.selectedIndex;
  }
  const number = numberStr.slice(0, -1);
  const courses = JSON.parse(document.getElementById('courses').value);
  const price = courses[selectedCourseIndex].price * number;
  const confirm_price = document.getElementById('confirm-price');
  confirm_price.innerText = price;
}

function setNumber() {//予約人数を反映
  const reservation_number = document.reservation_form.number;
  const selectedIndex = reservation_number.selectedIndex;
  const confirm_number = document.getElementById('confirm-number');
  confirm_number.innerText = reservation_number.options[selectedIndex].textContent;
  setPrice(confirm_number.innerText, -1);
}

function setCourse() {//予約コースを反映
  const reservation_course = document.reservation_form.course_id;
  const selectedIndex = reservation_course.selectedIndex;
  const confirm_course = document.getElementById('confirm-course');
  confirm_course.innerText = reservation_course.options[selectedIndex].textContent;
  const confirm_number = document.getElementById('confirm-number');
  setPrice(confirm_number.innerText, selectedIndex);
}

{
  let stripe = null;
  let card = null;
  function makePaymentForm() {// 決済欄を作成
    const pb_key = document.getElementById('pb_key').value;
    stripe = Stripe(pb_key);
    const elements = stripe.elements();
    const style = {
      base: {
        fontSize: '16px',
        color: '#000',
        backgroundColor: '#fff'
      }
    }
    card = elements.create('card', { style: style });
    card.mount('#card-element');

    card.addEventListener('change', function (event) {
      const displayError = document.getElementById('card-errors');
      displayError.textContent = (event.error) ? event.error.message : '';
    });
  }

    
  function removeHiddenInputs()
  {
    const token = document.getElementById('token');
    if(token) document.payment_form.removeChild(token);
    const amount = document.getElementById('amount');
    if (amount) document.payment_form.removeChild(amount);
    const date = document.getElementById('date');
    if (date) document.payment_form.removeChild(date);
    const time = document.getElementById('time');
    if (time) document.payment_form.removeChild(time);
    const number = document.getElementById('number');
    if (number) document.payment_form.removeChild(number);
    const course_id = document.getElementById('course_id');
    if (course_id) document.payment_form.removeChild(course_id);
  }

  function addReservationInfoToForm(payment_form) {
    {
      const date = document.reservation_form.date
      const input = document.createElement('input');
      input.setAttribute('type', 'hidden');
      input.setAttribute('name', 'date');
      input.setAttribute('id', 'date');
      input.setAttribute('value', date.value);
      payment_form.appendChild(input);
    }
    {
      const time = document.reservation_form.time;
      const input = document.createElement('input');
      input.setAttribute('type', 'hidden');
      input.setAttribute('name', 'time');
      input.setAttribute('id', 'time');
      input.setAttribute('value', time.value);
      payment_form.appendChild(input);
    }
    {
      const number = document.reservation_form.number.value;
      const input = document.createElement('input');
      input.setAttribute('type', 'hidden');
      input.setAttribute('name', 'number');
      input.setAttribute('id', 'number');
      input.setAttribute('value', number);
      payment_form.appendChild(input);
    }
    {
      const course_id = document.reservation_form.course_id.value;
      const input = document.createElement('input');
      input.setAttribute('type', 'hidden');
      input.setAttribute('name', 'course_id');
      input.setAttribute('id', 'course_id');
      input.setAttribute('value', course_id);
      payment_form.appendChild(input);
    }
  }

  function stripeTokenHandler(token) {//決済情報をサーバへ送信
    //以前追加したinput(hidden)を削除
    removeHiddenInputs();
    
    //トークン
    const token_id_input = document.createElement('input');
    token_id_input.setAttribute('type', 'hidden');
    token_id_input.setAttribute('name', 'stripeToken');
    token_id_input.setAttribute('id', 'token');
    token_id_input.setAttribute('value', token.id);
    //価格
    const amount_input = document.createElement('input');
    amount_input.setAttribute('type', 'hidden');
    amount_input.setAttribute('name', 'amount');
    amount_input.setAttribute('id', 'amount');
    const confirm_price = document.getElementById('confirm-price');
    amount_input.setAttribute('value', confirm_price.innerText);
    const payment_form = document.payment_form
    payment_form.appendChild(token_id_input);
    payment_form.appendChild(amount_input);
    addReservationInfoToForm(payment_form);
    //決済情報送信
    payment_form.submit()
  }

  function createToken() {
    stripe.createToken(card)
      .then((result) => {
        if (result.error) {// エラー表示
          const displayError = document.getElementById('card-errors');
          displayError.textContent = result.error.message;
          throw e;
        } else {
          stripeTokenHandler(result.token);
        }
      })
  }

  function confirmPayment(event) {//支払いの確認
    if (confirm('決済しますか？')) {
      try {
        createToken();
      } catch (e) {
        throw e;
      }
    } else {
      event.preventDefault();
    }
  }
}

document.addEventListener('DOMContentLoaded', function () {
  // 予約日を反映
  setDate();
  // 予約時間を反映
  setTime();
  // 予約人数を反映
  setNumber();
  // 予約コースを反映
  setCourse();
  // 決済欄を作成
  makePaymentForm();
});

function changeDate() {//予約日変更
  setDate();
}

function changeTime() {//予約時間変更
  setTime();
}

function changeNumber() {//予約人数変更
  setNumber();
}

function changeCourse() {//予約コース変更
  setCourse();
}

function confirmReservation(event) {//予約の確認
  if (confirm('予約しますか？')) {
    document.reservation_form.submit();
  } else {
    event.preventDefault();
  }
}