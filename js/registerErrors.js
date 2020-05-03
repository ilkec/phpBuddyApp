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