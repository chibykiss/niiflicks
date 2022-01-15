var player = videojs('my-video',{
    //autoplay: true,
    controls: true,
    height: "300",
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
    var serieid = $('#siid').val();
    var seasonid = $('#seen').val();
    var episodeid = $('#real_id').val();
    var usermail = $('#user').val();
    var seasonno = $('#seno').val();
    //console.log(serieid,seasonid,episodeid,usermail);
    var formData = new FormData();
    formData.append('email',usermail);
    formData.append('sid',serieid);
    formData.append('seaid',seasonid);
    formData.append('episid',episodeid);
    //check if theres any resumable time for movie
    
        fetch('apis/get_serietime.php',{
        method: 'post',
        body: formData
        })
        .then(response => response.json())
        .then(res => {
        // console.log(res);
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

                    // console.log('you are new');
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
                            // player.currentTime = parseInt(res.data);
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
        })
        .catch((error) => { 
        console.error('Error:', error);
        });

        //chek if ended
        player.on('ended', function(){
            //console.log('it has ended');
            fetch('apis/nextepisode.php',{
                method: 'POST',
                body: formData
            })
            .then((res) => res.json())
            .then(data =>{
                //console.log(data);
                if(data.error == false){
                    var epid = data.epid;
                    window.location.assign(`player_serie/play/${serieid}/${seasonid}/${epid}/${seasonno}`);
                }
            })
        });
        $(window).bind('beforeunload', function(){
            window.sessionStorage.setItem('lastvisit',new Date().getTime());
            // console.log('something here');
            if(player.ended() != true && player.currentTime() != 0){
                var current_time = player.currentTime();
            //    console.log(current_time);
                formData.append('ctime',current_time);
                fetch('apis/store_serietime.php',{
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
                
            }
        });
});



                player.on('ended', event => {
                    //console.log('its ended');
                 
                });

         
                
           