

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
