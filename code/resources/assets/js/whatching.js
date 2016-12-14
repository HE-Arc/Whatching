$(function(){
  $(document).ready(function(){
    if(window.jQuery){
      $("#search-bar").autocomplete({
        source: function(req, res){
          console.log(req.term);
          if(req.term.indexOf("@") == 0){
            //Searching a user
            var result;
            var usr = req.term.substring(1);
            if(usr != ""){
              $.ajax("/user/search/"+usr, {
                success: function(data, status, xhr){
                    res(data);
                }
              });
            }
          } else {
            var result;
              $.ajax("/film/search/"+req.term, {
                success: function(data, status, xhr){
                    res(data);
                }
              });
          }
        },
        select: function(e, ui){
          //Searching for an user
          if($('#search-bar').val().indexOf('@') == 0){
            window.location.href = '/user/'+ui.item.id;
          } else {
            window.location.href = '/film/'+ui.item.id;
          }

        }
      });
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
    console.log("Bonjour");
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
      }
    })

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

function suggestMovie(movid, myid){
    var suggestionsIds = [];
    $(':checkbox:checked').each(function(i){
      suggestionsIds[i] = $(this).val();
    });

    if(suggestionsIds < 1){
      alert("Choose someone !");
    }else{

      $.ajaxSetup({
        headers: {
          'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
      })

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

var converter = new showdown.Converter();

function mdToHTML(text, id){
    $("#"+id).html(converter.makeHtml(text));
}
