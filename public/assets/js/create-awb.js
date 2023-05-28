/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!***********************************************!*\
  !*** ./resources/assets/js/awb/create-awb.js ***!
  \***********************************************/
document.addEventListener('livewire:load', function () {
  Livewire.on('branchSelected', function (branch) {
    $("#branch_phone").val(branch.phone);
    $("#branch_address").val(branch.address);
    $("#branch_city").val(branch.city.title);
    $("#branch_area").val(branch.area.title);
  });
});
$('#company_id').on('change', function () {
  var selectedOption = $(this).val(); // Emit an event with the selected value to a specific Livewire component

  Livewire.emit('getShipmentTypeForSelectedCompany', selectedOption);
});
$("#collection").css('display', 'none');
if ($("#payment_type").val() == 4) $("#collection").css('display', 'block');
$('#payment_type').on('change', function () {
  var selectedOption = $(this).val();
  if (selectedOption == 4) $("#collection").css('display', 'block');else $("#collection").css('display', 'none');
});
/******/ })()
;