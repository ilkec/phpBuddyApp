$('#alert2').hide();
$("#registerBtn").click(function(e){
  
  let inputFields = $(".formInputs").val();
  console.log("inputfields" + ' '+inputFields);
  
   let userInfo =[];
        let info={};
            info.inputFields=inputFields;
            
            userInfo.push(info);  
    console.log(userInfo[0]['inputFields']);
  
  if(userInfo[0]['inputFields'] === ""){
    e.preventDefault();
   $.ajax({
        method: "post"
        , url: "./ajax/Errormesage.php"
        , data: $('#alert2').serialize()
        , dataType: "html"
        , success: (respons) => {
          $('#alert2').show();
         
        $('#alert2').append(respons);
        
             
        }
      });
   
    
  }
  
});



$('.emailErrorDiv').hide();
$("#exampleInputEmail1").blur(function() {
  let email = $("#exampleInputEmail1").val();
  //console.log(email);
   let userInfo =[];
        let usrEmail={};
            usrEmail.userGivedEmail=email;
            userInfo.push(usrEmail);  
    console.log(userInfo);

  if(email != ''){
    
    $.ajax({
         url: "./ajax/checkEmail.php"
        ,  method: "post"
        ,  data: {usrEmail: JSON.stringify(userInfo)}
        ,  dataType:"html"
        , success: (respons) => {
          if(email.indexOf("@student.thomasmore.be") > -1){
            $('.emailErrorDiv').show();
          
          $('.emailErrorDiv').html(respons);
          }else{
            $('.emailErrorDiv').show();
             $('.emailErrorDiv').html("Please enter a valid email");
          }
        }
      });
 }else{
    $('.emailErrorDiv').hide();
 }

});