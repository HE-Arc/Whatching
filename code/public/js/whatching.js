function getMovieFromTMDb(id){
  var url = "https://api.themoviedb.org/3/movie/"+id+"?api_key="+API_KEY+"&language=en-US";
  $.ajax(url, {success: function(data, status, xhr){
    $("#film-name").html(data.original_title);
    $("#film-synopsis").html(data.overview);
    $("#film-cover").attr('src', "http://image.tmdb.org/t/p/w780"+data.poster_path);
  }});
}
