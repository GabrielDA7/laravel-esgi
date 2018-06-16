$(function() {

  $("#groups .list-group-item").on("click", function() {
    var group_id = $(this).find(".hidden-content").text();
    window.location.href = "/group/" + group_id + "/show";
  });

  $("#groups .card-header button").on("click", function() {
    var account_id = $(this).parent().parent().find(".account-id").text();
    var action = "/" + account_id + "/delete";
    var form = $("#mdl-delete-account .modal-body form");
    var action = form.attr('action') + action;
    form.attr('action', action);
  });

  $("#search_user").on("input", function() {
    var keyword = $("#search_user").val();
    var url = window.location.protocol + "//" + window.location.host + "/user/search";
    $.ajaxSetup({
       headers: {
           'X-CSRF-TOKEN': $('input[name="_token"]').val()
       }
    });
    $.ajax({
            type: "POST",
            url: url,
            data: {keyword: keyword},
            dataType: "json"
    })
    .done(function(data) {
      var html = "<ul class='list-group'>";
      $.each(data, function (key,value){
        html += "<li class='list-group-item list-group-item-action'>";
        html += value;
        html += "</li>";
      });
      html += "</ul>";
      $("#search_result").append(html);
      $("#search_result").fadeIn('slow');
    })
    .fail(function(data) {
      $.each(data.responseJSON, function (key, value) {
        alert(value);
      });
    });
  });


});
