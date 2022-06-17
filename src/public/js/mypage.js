function changeNumberAndPrice() {//人数を変更した場合、金額を変更
  const reservation_number = document.reservation_update_form.number;
  const selectedIndex = reservation_number.selectedIndex;
  number_str = reservation_number.options[selectedIndex].textContent;
  const number = number_str.slice(0, -1);
  const course_price = document.getElementById('course-price');
  const price = course_price.value * number;
  document.getElementById('price').innerText = price + "円";
}