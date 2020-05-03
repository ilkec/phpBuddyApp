
document.querySelector('#btnSendMessage').addEventListener("click", function(){

    //message text
    let text = document.querySelector("#message").value;
    console.log(text);
    let sendername = this.dataset.sendername;
    console.log(sendername);

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
            let newContainerRow = document.createElement("div");
            newContainerRow.className = "messageContainer row";
            let messageBox = document.createElement("div");
            messageBox.className = "messageBox col-lg-6";
            let sender = document.createElement("strong");
            sender.innerHTML = sendername;

            newMessage.innerHTML = result.body;
            document.querySelector(".chatbox").appendChild(newContainerRow);
            newContainerRow.appendChild(messageBox);
            messageBox.appendChild(sender);
            messageBox.appendChild(newMessage);
           
            document.querySelector("#message").value = "";
        })
        .catch(error => {
           console.log("Error:", error);
        });
});//messages tonen in chatvenster; 