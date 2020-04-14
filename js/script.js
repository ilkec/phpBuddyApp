$(document).ready(function () {
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
        , data: $('#displayData').serialize()
        , dataType: "html"
        , success: (respons) => {
          $('.usersList').html(respons);

          if (respons.trim() == '') {
            errorAlert.html(errormsg);
          }

        }
      });
    } else if (idBtn === 'music') {
      e.preventDefault();
      $.ajax({
        method: "post"
        , url: "./userFiltering/sortByMusic.php"
        , data: $('#displayData').serialize()
        , dataType: "html"
        , success: (respons) => {
          $('.usersList').html(respons);

          if (respons.trim() == '') {
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
        , data: $('#displayData').serialize()
        , dataType: "html"
        , success: (respons) => {
          $('.usersList').html(respons);
          console.log(respons);
          if (respons.trim() == '') {
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
        , data: $('#displayData').serialize()
        , dataType: "html"
        , success: (respons) => {
          $('.usersList').html(respons);
          if (respons.trim() == '') {
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
        , data: $('#displayData').serialize()
        , dataType: "html"
        , success: (respons) => {
          $('.usersList').html(respons);
          console.log(respons);
          if (respons.trim() == '') {
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
        , data: $('#displayData').serialize()
        , dataType: "html"
        , success: (respons) => {
          $('.usersList').html(respons);
          console.log(respons);
          if (respons.trim() == '') {
            errorAlert.html(errormsg);
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