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
