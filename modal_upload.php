<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style_home.css">
    <title>Modal</title>
</head>


<body>
 
 <!-- The Modal -->
 <div id="myModal" class="modal">

<!-- Modal content -->
<div class="modal-content">
    <div class="modal-header">
        <span class="close">&times;</span>
        <h2>Share a story</h2>
    </div>
    <div class="modal-body">
        <div class="row temp">
            <form action="">
                <input type="text" class="form-control form-control-lg" placeholder="Have a story to share?">
            </form>
        </div>
        <form action = " " method="post" enctype="multipart/form-data">
            <div class="row temp">
                <div class="col-md-6 temp">
                    <h4>Add to your story</h4>
                </div>

                <!--Uploading media file-->
                <div class="col-md-2 temp">
                    <img src="svg/i_img.svg" alt="Upload an Image" style="border-radius: 0; width:2.5rem; height:2.5rem;" >
                    <h3 style = "font-size:1rem;">Image</h3>  
                </div>
                <div class="col-md-2 temp">
                    <img src="svg/i_vid.svg" alt="Upload a Video" style="border-radius: 0; width:2.5rem; height:2.5rem;" >
                </div>
                <div class="col-md-2 temp">
                    <img src="svg/i_tag.svg" alt="Tag Someone" style="border-radius: 0; width:2.5rem; height:2.5rem;" >
                </div>
            </div>
            <div class="row temp mt-3 mb-4">
                <input id ="upload_btn" type="submit" value="Post Story" class="btn btn-dark">
            </div>
        </form>
    </div>
</div>

</div>

<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("btn_post");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
    modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
    modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}
</script>
</body>
</html>