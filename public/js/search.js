function fun1(){
    const r = document.getElementById("order_radio_name");
    const c = document.getElementById("order_check_name");
    if (c.checked) {       
      r.style.display = "block";
    } else {
      r.style.display = "none";
    }
}
function fun2(){
    const r = document.getElementById("sort_radio_gender");
    const c = document.getElementById("sort_check_gender");
    if (c.checked) {
      r.style.display = "block";
    } else {
      r.style.display = "none";
    }
}

function fun3(){
  const by = document.getElementById("by");
  const arr1 = document.getElementsByName("sort_by_gender");
  const arr2 = document.getElementsByName("order_by");
  var checked = false;
  arr1.forEach(element => {
    if(element.checked) checked=true;
  });
  arr2.forEach(element => {
    if(element.checked  && element.id!="order_check_none") checked=true;
  });
  if(checked)
    by.disabled = false;
  else
    by.disabled = true;

}