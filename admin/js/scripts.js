


tinymce.init({ selector:'textarea' });


$(document).ready(function(){

   // alert('Hello');  //used to test if javascript is running 



    $('#selectAllBoxes').click(function(event){

        if(this.checked){  // this keyword is referring to #selectAllBoxes

            $('.checkBoxes').each(function(){

                this.checked = true;   //this keyword is referring to the object .checkBoxes
            });

        } else {

            $('.checkBoxes').each(function(){

                this.checked = false;

            });

        }
    


    });

    // prepend  connects elements to the tag that is named
    //$("body").prepend();

    // 2 divs... 
    var div_box ="<div id='load-screen'><div id='loading'></div></div>";
    $("body").prepend(div_box);

    // functions chained together
    //targeting the load-screen, delay 700miliseconds, fading out 600,  then removing 
    $('#load-screen').delay(700).fadeOut(600, function(){
        $(this).remove();
    })

});



function loadUsersOnline(){
    // send get request to server 
    $.get("funcitons.php?onlineusers=result", function(data){
            // container usersonline  ... function text to insert data into the container
        $(".usersonline").text(data)

    });

}

// use function to set time interval for executing and calling  the function every couple seconds 
setInterval(function(){
        // calls the function loadUsersOnline every 500 miliseconds (1/2 second)
    loadUsersOnline();

}, 500);

