document.querySelector('#btnSendMessage').addEventListener("click", function(){

    //message text
    let text = document.querySelector("#message").value;
    console.log(text);
        
    //message posten naar de databank(via ajax)
    let formData = new FormData();
    formData.append("text", text);
   

    
    fetch("ajax/savecomment.php", {
        method: "POST",
        body: formData
    }) 
        .then(response => response.json())
        .then(result => {
            let newMessage = document.createElement("p");
            newMessage.innerHTML = result.body;
            document.querySelector(".chatbox").appendChild(newMessage);
        })
        .catch(error => {
           console.log("Error:", error);
        });
});//messages tonen in chatvenster;