const jsspg = require('javascript-strong-password-generator');

$(function() {

  // Generate random password
  $( "#generate-password" ).on( "click", function() {
    jsspg.init();
    const GeneratePassword = jsspg.generate(32);
    $("#input-password").val(GeneratePassword);
  });

  $("#vault .card").on("click", function() {
    var account_id = $(this).find(".account-id").text();
    window.location.href = "/account/" + account_id + "/edit";
  });

});
