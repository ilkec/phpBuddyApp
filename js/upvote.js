let upvotes = document.querySelectorAll('#upvote');
console.log(upvotes); //geeft array terug met alle elementen die id upvote bevatten 

upvotes.forEach(upvote => {
    upvote.addEventListener("click", function(){

        upvotetry();
        let commentid = this.dataset.commentid;
        console.log(commentid);
        let number = parseInt(this.dataset.number);
        number = number + 1 ; 
        console.log(number);

        

    
        let formData = new FormData();
        formData.append("commentid", commentid);

        fetch("ajax/saveupvote.php", {
            method: "POST",
            body: formData
        }) 
            .then(response => response.json())
            .then(result => {
                let upvoteNumber = document.createElement("p");
                upvoteNumber.innerHTML = number;
                document.querySelector(".upvoteclass").appendChild(upvoteNumber);


            })
            .catch(error => {
               console.log("Error:", error);
            });
    
    });
});