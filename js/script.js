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

/*document.getElementById("acceptBtn").addEventListener("click", hide());

function hide() {
  document.getElementById("verzoeken").style.display = "none";
}*/


/*-------------------------Reaction---------------------------------------------*/
$(".reactionsBox").click(function (e) {
     
   e.preventDefault();
  $.ajax({
        method: "post"
        , url: "./classes/ShowReaction.php"
        , data: $('.emojisBox').serialize()
        , dataType: "html"
        , success: (respons) => {
          let emojiBox = $(this).next();
         emojiBox.toggle();
          let emojis = $(this).next().children().last().children().children();
          let currentMessageBox = $(this).prev();
         givedReactionBoxSrc = $(this).prev().children().last();
          console.log(respons);
          //console.log(currentMessageBox);
  
  emojis.click(function(e){
      let curentSelectedReaction = $(this).attr("id");
        let  selectedMessageBox = currentMessageBox.attr('id');  
        let userReaction =[];
        let reaction={};
            reaction.reactionId=curentSelectedReaction;
            reaction.messageBoxId=selectedMessageBox;
            userReaction.push(reaction);  
    console.log(userReaction);
    let givedReaction = currentMessageBox.children().children().last();
    
    if(givedReaction.attr('src') == ""){
    $.ajax({
         url: "./ajax/savereactions.php"
        ,  method: "POST"
        ,  data:{reaction: JSON.stringify(userReaction)}
        , success: (respons) => {//console.log(currentMessageBox.children().children().last().attr('src',respons));
          //let currentMesg=currentMessageBox.children().children().last().attr('src');
          console.log('reaction is added to messagesId:' + respons);
        $.ajax({
         url: "./ajax/addReaction.php"
        ,  method: "post"
        ,  data: {reaction: JSON.stringify(userReaction)}
        ,  dataType:"html"
        , success: (respons) => {
           
          console.log(respons);
          var test = currentMessageBox.children().children().last();
          test.attr('src',respons);
        }
      });
          
        }
      }); 
    }else{
       console.log('message already has a reaction');
    }   
  });
        }
     
     
   });
  

});