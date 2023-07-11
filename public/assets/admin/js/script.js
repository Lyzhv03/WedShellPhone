var all = document.querySelector(".checkAll");
var unset = document.querySelector(".uncheckAll");
var selects = document.querySelectorAll(".select");

all.addEventListener("click", () => {
  selects.forEach((item) => {
    item.checked = true;
  });
});

unset.addEventListener("click", () => {
  selects.forEach((item) => {
    item.checked = false;
  });
});

console.log("Hello");
