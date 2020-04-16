$(document).ready(function () {
let idBtn = $(this).attr('id');
    let list = $(".usersList");
    let errormsg = '<div class="alert alert-light" role="alert" style="font-size:14px">No user with the same interest was found.😕</div>';
   let errorForNot100precentMAtch = '<div class="alert alert-light" role="alert" style="font-size:14px">No user with 100% match was found.😕</div>';
    let errorForLocation = '<div class="alert alert-light" role="alert" style="font-size:14px">No user with the same location was found.😕</div>';
    let errorAlert = $('.usersList');

//When the page is ready, all users are shown with 100% match.
     $.ajax({
        method: "post"
        , url: "./userFiltering/showAllUsers.php"
        , data: $('.container-list').serialize()
        , dataType: "html"
        , success: (respons) => {
          $('.usersList').html(respons);
          console.log(respons);
          if(respons.trim()==''){
             errorAlert.html(errorForNot100precentMAtch);
          
          }
        }
      });

  $(".interest").click(function (e) {
    e.preventDefault();
    let idBtn = $(this).attr('id');
    let list = $(".usersList");
    let errormsg = '<div class="alert alert-light" role="alert" style="font-size:14px">No user with the same interest was found.😕</div>';
    let errorForLocation = '<div class="alert alert-light" role="alert" style="font-size:14px">No user with the same location was found.😕</div>';
    let errorAlert = $('.usersList');
    console.log(idBtn);
    if (idBtn === 'book') {
      e.preventDefault();
      $.ajax({
        method: "post"
        , url: "./userFiltering/sortByBook.php"
        , data: $('.container-list').serialize()
        , dataType: "html"
        , success: (respons) => {
          $('.usersList').html(respons);
          
         if(respons.trim()==''){
             errorAlert.html(errormsg);
          }
            
        }
      });
    }else if (idBtn === 'music') {
      e.preventDefault();
      $.ajax({
        method: "post"
        , url: "./userFiltering/sortByMusic.php"
        , data: $('.container-list').serialize()
        , dataType: "html"
        , success: (respons) => {
          $('.usersList').html(respons);
          
         if(respons.trim()==''){
             errorAlert.html(errormsg);
          }
            
        }
      });
    }
    else if (idBtn === 'game') {
      e.preventDefault();
      $.ajax({
        method: "post"
        , url: "./userFiltering/sortByGame.php"
        , data: $('.container-list').serialize()
        , dataType: "html"
        , success: (respons) => {
          $('.usersList').html(respons);
          console.log(respons);
          if(respons.trim()==''){
             errorAlert.html(errormsg);
          }
        }
      });
    }
    else if (idBtn === 'movie') {
      e.preventDefault();
      $.ajax({
        method: "post"
        , url: "./userFiltering/sortByMovie.php"
        , data: $('.container-list').serialize()
        , dataType: "html"
        , success: (respons) => {
          $('.usersList').html(respons);
          if(respons.trim()==''){
             errorAlert.html(errormsg);
          }
        }
      });
    }
    else if (idBtn === 'location') {
      e.preventDefault();
      $.ajax({
        method: "post"
        , url: "./userFiltering/sortByLocation.php"
        , data: $('.container-list').serialize()
        , dataType: "html"
        , success: (respons) => {
          $('.usersList').html(respons);
          console.log(respons);
          if(respons.trim()==''){
             errorAlert.html(errorForLocation);
          }
        }
      });
    }
    else {
      e.preventDefault();
      $.ajax({
        method: "post"
        , url: "./userFiltering/showAllUsers.php"
        , data: $('.container-list').serialize()
        , dataType: "html"
        , success: (respons) => {
          $('.usersList').html(respons);
          console.log(respons);
          if(respons.trim()==''){
             errorAlert.html(errorForNot100precentMAtch);
          }
        }
      });
    }
  });
});

document.getElementById("acceptBtn").addEventListener("click", hide());

function hide() {
  document.getElementById("verzoeken").style.display = "none";
}