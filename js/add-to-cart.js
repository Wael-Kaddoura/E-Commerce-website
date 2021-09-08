$(".add-to-cart").click(function () {
  $("#cart-counter").text(parseInt($("#cart-counter").text()) + 1);

  $(this).attr("disabled", "hello");

  $.post("php/add-to-cart.php", { item_id: $(this).val() });
});

$(".add").click(function () {
  $("#qty" + $(this).val()).text(
    parseInt($("#qty" + $(this).val()).text()) + 1
  );

  $("#cart-counter").text(parseInt($("#cart-counter").text()) + 1);

  $.post("php/add-to-cart.php", { item_id: $(this).val() });

  $.get("php/get-new-total.php", function (data) {
    let response = JSON.parse(data);
    let new_total = response.total_price;
    $("#total_price").text(new_total);
  });
});

$(".remove").click(function () {
  $("#qty" + $(this).val()).text(
    parseInt($("#qty" + $(this).val()).text()) - 1
  );

  $("#cart-counter").text(parseInt($("#cart-counter").text()) - 1);

  $.post("php/remove-from-cart.php", { item_id: $(this).val() });

  $.get("php/get-new-total.php", function (data) {
    let response = JSON.parse(data);
    let new_total = response.total_price;
    $("#total_price").text(new_total);
  });
});
