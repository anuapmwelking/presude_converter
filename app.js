let currency_usd = document.getElementById("currency-one");
let currency_inr = document.getElementById("currency-two");

document.getElementById("currencyBlock").onchange = function () {
  currency_inr.readOnly = true;
  currency_usd.value = "";

  currency_usd.type = "text";
  document.getElementById("changed_amount").style.display = "block";

  if (this.value == "INR") {
    currency_inr.removeAttribute("readonly");
    currency_inr.removeAttribute("disabled");
    currency_inr.value = "";

    currency_usd.type = "hidden";
    document.getElementById("changed_amount").style.display = "none";
  }

  if (this.value == "USD") {
    currency_inr.value = "";
    // console.log("inside usd");
  }

  console.log("counting");
};
