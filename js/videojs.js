var player = videojs('my-video',{
    //autoplay: true,
    controls: true,
    fluid: true,
    playbackRates: [0.25,0.5,1,1.5,2,2.5,3,3.5,4],
    plugins: {
        hotkeys: {

        }
    }
    
});

player.watermark({
    file: 'images/logo_watermark.png',
    fadeTime: 3000,
    xpos: 0,
    ypos: 0,
    position: 'bottom-right',
    opacity: 0.7,
});

player.ready(function(){
    formData = new FormData();
    var movieid = document.getElementById('dixmv').value;
    var usermail = document.getElementById('dixml').value;
    formData.append('email',usermail);
    formData.append('mid',movieid);
    //console.log(movieid+' '+usermail);

    fetch('apis/get_movietime.php',{
        method: 'post',
        body: formData
        })
        .then(response => response.json())
        .then(res => {
        //console.log(res);
        // console.log(res.data);
        if(window.sessionStorage.getItem('lastvisit') !== null){
                var last_visit = window.sessionStorage.getItem('lastvisit');
                if((new Date().getTime() - last_visit) < 3000){
                    // console.log('you refreshed'); 
                    // console.log(res.data);  
                        if(res.data != 'not_exist'){
                            //player.currentTime = parseInt(res.data);
                            player.currentTime(parseInt(res.data));
                            player.play();
                        }
                    window.sessionStorage.clear();
                }else{

                    console.log('you are new');
                    if(res.data != 'not_exist'){
                        Swal.fire({
                        title: 'Do you want to resume this movie?',
                        showDenyButton: true,
                        confirmButtonText: 'Yes',
                        denyButtonText: `No`,
                        }).then((result) => {

                        if (result.isConfirmed) {
                            //player.currentTime = parseInt(res.data);
                            player.currentTime(parseInt(res.data));
                            player.play();
                        } else if (result.isDenied) {
                            player.currentTime(0);
                            player.play(); 
                        }
                        })
                    }
                    window.sessionStorage.clear();
                }
            }else{
                // console.log('you are new very fresh');
                if(res.data != 'not_exist'){
                    Swal.fire({
                        title: 'Do you want to resume this movie?',
                        showDenyButton: true,
                        confirmButtonText: 'Yes',
                        denyButtonText: `No`,
                        }).then((result) => {

                        if (result.isConfirmed) {
                            player.currentTime = parseInt(res.data);
                            player.play();
                        } else if (result.isDenied) {
                            player.currentTime = 0;
                            player.play(); 
                        }
                        })
                }
                window.sessionStorage.clear();
            }
        })
        .catch((error) => { 
        console.error('Error:', error);
        });

    $(window).bind('beforeunload', function(){
        window.sessionStorage.setItem('lastvisit',new Date().getTime());
        console.log(player.currentTime());
        if(player.ended() != true && player.currentTime() != 0){
            console.log('it has not ended');
            var current_time  = player.currentTime();
            formData.append('ctime',current_time);
                fetch('apis/store_movietime.php',{
                     method: 'post',
                     body:formData
                })
                .then(response => response.json())
                .then(data => {
                    console.log(data);
                })
                .catch((error) => { 
                     console.error('Error:', error);
                });
        }else{
            console.log('it has ended');
        }
    });
});

// player.ready(function(){
//     player.currentTime(66.432);
//     player.play();
// });