let upvotes = document.querySelectorAll('#upvote');
console.log(upvotes); //geeft array terug met alle elementen die id upvote bevatten 

upvotes.forEach(upvote => {
    upvote.addEventListener("click", function(){
        let commentid = this.dataset.commentid;
        console.log(commentid);
    
        let formData = new FormData();
        formData.append("commentid", commentid);

        fetch("ajax/saveupvote.php", {
            method: "POST",
            body: formData
        }) 
            .then(response => response.json())
            .then(result => {
                //hier iets printen? 
            })
            .catch(error => {
               console.log("Error:", error);
            });
    
    });
});