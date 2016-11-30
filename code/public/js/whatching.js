$(function(){
  $(document).ready(function(){
    if(window.jQuery){
      $("#search-bar").autocomplete({
        source: function(req, res){
          console.log(req.term);
          if(req.term.indexOf("@") == 0){
            //Searching a user
            console.log("looking for a user...");
            var result;
            var usr = req.term.substring(1);
            if(usr != ""){
              $.ajax("/user/search/"+usr, {
                async: false,
                success: function(data, status, xhr){
                    result = data;
                }
              });
            }

            console.log(result);
            res(result);
          } else {
            var result;
              $.ajax("/film/search/"+req.term, {
                async: false,
                success: function(data, status, xhr){
                    console.log(data);
                    result = data;
                }
              });

            console.log(result);
            res(result);
          }
        },
        select: function(e, ui){
          //Searching for an user
          if($('#search-bar').val().indexOf('@') == 0){
            window.location.href = '/user/'+ui.item.id;
          } else {
            window.location.href = '/film/'+ui.item.id;
          }ve

        }
      });
    }

  });
});

function setWatched(id) {
    $.ajax('/watched/'+id, {
        success: function(data, status, xhr){
            $("#btnWatched").toggleClass("btn-success");
        }
    });
}
