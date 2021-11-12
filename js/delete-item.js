$(".delete-item").click(function () {
  $.post("php/delete-item.php", { item_id: $(this).val() });
  $("#row" + $(this).val()).remove();
});
