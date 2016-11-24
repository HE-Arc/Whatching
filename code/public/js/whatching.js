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
            var result = [];
            delete $.ajaxSettings.headers["X-CSRF-TOKEN"];
            $.ajax("https://api.themoviedb.org/3/search/movie?api_key="+API_KEY+"&language=en-US&query="+req.term, {
              async: false,
              success: function(data, status, xhr){
                data.results.forEach(function(el){
                  result.push({id: el.id, label: el.title});
                });
              }
            });
            res(result);
          }
        },
        select: function(e, ui){
          //Searching for an user
          if($('#search-bar').val().indexOf('@') == 0){
            var usrname = ui.item.label.substring(1);
            window.location.href = '/user/'+usrname;
          } else {
            //TMDb
            window.location.href = '/film/'+ui.item.id;
          }

        }
      });
    }

  });
});


function getMovieFromTMDb(id, filmCoverId=null, filmNameId=null, filmSynopsisId=null){
  var url = "https://api.themoviedb.org/3/movie/"+id+"?api_key="+API_KEY+"&language=en-US";
  $.ajax(url, {success: function(data, status, xhr){
    updateMyDB(id, data.original_title);
    if(filmNameId != null)
      $(filmNameId).html(data.original_title);
    if(filmSynopsisId != null){
      $(filmSynopsisId).html(data.overview);
    }
    if(filmCoverId != null){
      $(filmCoverId).attr('src', "http://image.tmdb.org/t/p/w780"+data.poster_path);
    }
  }});
}


function updateMyDB(tmdbId, name){
  $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

  $.post("/addToDB", {'tmdbId': tmdbId, 'name': name});
}
