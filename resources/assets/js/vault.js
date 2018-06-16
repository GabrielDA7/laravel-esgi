const jsspg = require('javascript-strong-password-generator');

$(function() {

  // Generate random password
  $( "#generate-password" ).on( "click", function() {
    jsspg.init();
    const GeneratePassword = jsspg.generate(32);
    $("#input-password").val(GeneratePassword);
  });

  $("#vault .card-body").on("click", function() {
    var account_id = $(this).find(".hidden-content").text();
    window.location.href = "/account/" + account_id + "/edit";
  });

  $("#vault .card-header button").on("click", function() {
    var account_id = $(this).parent().parent().find(".hidden-content").text();
    var action = "/" + account_id + "/delete";
    var form = $("#mdl-delete-account .modal-body form");
    var action = form.attr('action') + action;
    form.attr('action', action);
  })

});
