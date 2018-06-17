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

  var cptChecked = 0;
  $("#mdl-share-group input[name^='groups[']").change( function() {
    if(this.checked) {
        cptChecked += 1;
    } else {
      cptChecked -= 1;
    }
    if( cptChecked > 0) {
      $("#search_user").removeAttr('disabled');
    } else {
      $("#search_user").attr('disabled', true);
    }
  });

  $("#search_user").on("input", function() {
    var groups_id = [];
    $("#mdl-share-group input[name^='groups[']:checked").each(function (){
      groups_id.push($(this).attr('id'));
    });
    $("#mdl-share-group input[name^='groups[']:checked").val();
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
            data: {keyword: keyword, groups_id: groups_id},
            dataType: "json"
    })
    .done(function(data) {
      var html = "<ul class='list-group'>";
      if(data["result"].length > 0) {
        $.each(data["result"], function (index, object){
          html += "<li class='list-group-item list-group-item-action'>";
          html += object["name"] + " - " +object["email"];
          html += "<span id='id_user' class='hidden-content'>" + object["id"] + "</span>";
          html += "<span id='username' class='hidden-content'>" + object["name"] + "</span>";
          html += "</li>";
        });
      } else {
        html += "<li class='list-group-item list-group-item-action'>";
        html += "No user found";
        html += "</li>";
      }
      html += "</ul>";
      $("#search_result").html(html);
      $("#search_result").fadeIn('fast');
    })
    .fail(function(data) {
      $.each(data.responseJSON, function (key, value) {
        alert(value);
      });
    });
  });

  $("#search_result").on("click", ".list-group-item",function() {
    var user_id = $(this).find("#id_user").html();
    var username = $(this).find("#username").html();
    $("#user_display").removeClass('hidden-content');
    var html = "<div class='user_added'>" + username;
    html += "<button type='button' class='close' aria-label='Close'>";
    html += "<span aria-hidden='true'>&times;</span>";
    html += "</button>";
    html += "<span id='id' class='hidden-content'>" + user_id + "</span>";
    html += "</div>";
    $("#search_user").val("");
    $("#search_result").fadeOut("fast");
    $("#user_display").append(html);
    $("#user_added").attr("value", function() { return $(this).attr("value") + user_id + ";"});
  });

  $("#user_display").on("click", "button",function() {
    var id_user = $(this).parent().find("#id").html() + ';';
    $(this).parent().remove();
    var str = $("#user_added").html();
    $("#user_added").attr("value", function() { return $(this).attr("value").replace(id_user,"")});
  });


});
