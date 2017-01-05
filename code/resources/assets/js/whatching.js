var True = true;
$(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      }
    })

      var sb = $("#search-bar");
      var url = sb.closest('form').attr('action');
      var altUrl = sb.closest('form').data('user-action');
      sb.autocomplete({
        source: function(req, res){
          console.log(req.term);
          if(req.term.indexOf("@") == 0){
            //Searching a user
            var result;
            var usr = req.term.substring(1);
            if(usr != ""){
              $.ajax(atlUrl+"/"+usr, {
                success: function(data, status, xhr){
                    res(data);
                }
              });
            }
          } else {
            var result;
              $.ajax(url+"/"+req.term, {
                success: function(data, status, xhr){
                    res(data);
                }
              });
          }
        },
        select: function(e, ui){
          //Searching for an user
          if($('#search-bar').val().indexOf('@') == 0){
            // FIXME: doesn't work when the root is not `/` -Yoan
            window.location.href = '/user/'+ui.item.id;
          } else {
            window.location.href = '/film/'+ui.item.id;
          }

        }
      });

});

function setWatched(id) {
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      }
    })


    $.ajax('/film/watched', {
        type: "POST",
        data: {
            film_id: id
        },
        success: function(data, status, xhr){
            $("#btnWatched").toggleClass("btn-success");
            $("#btnReview").toggleClass("hidden");
        }
    });
  

}

function subscribeTo(follower, followed){
    $.ajax({
      type: "POST",
      url: "/user/subscribeToggle",
      data: {
        follower_id: follower,
        followed_id: followed
      },
      dataType: 'json',
      success: function (data) {
        if(data.action == "sub"){
          $('#subscribe-toggle').attr('class', 'btn btn-danger');
          $('#subscribe-toggle').attr('value', 'Unsubscribe');
        }else{
          $('#subscribe-toggle').attr('class', 'btn btn-primary');
          $('#subscribe-toggle').attr('value', 'Subscribe');
        }
      },
      error: function (data) {
        console.log('Error:', data);
      }
  });
}

// Change panel color ad toggle the inner checkbox
function selectRow(elem){
  $("#"+elem.id).toggleClass("selected-row");
  var $tc = $("#"+elem.id).children().find('input:checkbox:first'),
        tv = $tc.attr('checked');
    $tc.attr('checked', !tv);
}

window.selectRow = selectRow;

function suggestMovie(movid, myid){
    var suggestionsIds = [];
    $(':checkbox:checked').each(function(i){
      suggestionsIds[i] = $(this).val();
    });

    if(suggestionsIds < 1){
      alert("Choose someone !");
    }else{

      $.ajax({
        type: "POST",
        url: "/film/suggestToFriend",
        data: {
          user_ids: suggestionsIds,
          film_id: movid,
          state_id: 1,
          source_id: myid
        },
        dataType: 'json',
        success: function (data) {
          $('#suggestModal').modal('toggle');
        },
        error: function (data) {
          console.log('Error:', data);
        }
      });
    }
}

window.suggestMovie = suggestMovie;

var converter = new showdown.Converter();

function mdToHTML(text, id){
    $("#"+id).html(converter.makeHtml(text));
}

window.mdToHTML = mdToHTML;
