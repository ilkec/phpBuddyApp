 

let upvoteCount = document.querySelector("#upvoteCount");
let upvotes = document.querySelectorAll('#upvote');
//console.log(upvotes); //geeft array terug met alle elementen die id upvote bevatten 

    upvotes.forEach(upvote => {
        upvote.addEventListener("click", function(){
            let commentid = this.dataset.commentid;
            let parent = upvote.parentNode;
            console.log(parent);
            //console.log(commentid);
            let number = parseInt(this.dataset.number);
            number = number + 1 ; 
            
            //console.log(number);
    
            let formData = new FormData();
            formData.append("commentid", commentid);
            formData.append("upvotecount", number);
    
            fetch("ajax/saveupvote.php", {
                method: "POST",
                body: formData
            }) 
                .then(response => response.json())
                .then(result => {
                   let upvotenumber =  parent.querySelector("#upvoteCount");
                   console.log(upvotenumber);
                   upvotenumber.innerHTML = number;
                   let remove = parent.querySelector("#upvote");
                   remove.style.display = "none";
                   let already = document.createElement("p");
                   already.innerHTML = "You already upvoted "
                   parent.appendChild(already);


    
                })
                .catch(error => {
                   console.log("Error:", error);
                });
        });

        
       
    });
