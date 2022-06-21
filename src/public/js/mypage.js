function changeNumberAndPrice(loop_index) {//人数を変更した場合、金額も変更
  const reservation_number = document.getElementById('number' + loop_index);
  const selected_index = reservation_number.selectedIndex;
  const number = reservation_number.options[selected_index].value;
  const course_price = document.getElementById('course-price' + loop_index);
  const price = course_price.value * number;
  document.getElementById('price' + loop_index).innerText = price + "円";
}