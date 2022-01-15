
let clink = document.getElementById('clink');
let dlink = window.location.href;
clink.value = dlink;
window.onload = function(){
    let to_copy = document.getElementById('to_copy');
    to_copy.addEventListener('click',function(e){
    e.preventDefault();
    clink.select();
    clink.setSelectionRange(0, 99999); /* For mobile devices */

    /* Copy the text inside the text field */
    navigator.clipboard.writeText(clink.value);
    

    /* Alert the copied text */
    Toast.fire({
        icon: 'success',
        title: 'link Copied'
        })
    });
    
    const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 2000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
    })

    $.fn.addMessage = function(msg){
        //alert(msg);
        var output = `
        <div style="width:100%; height:30px; background-color:#444242;">
                <div style="width: 90%; height:30px; margin: 0 auto;">
                    <i style="color:#ff8282; padding-left:20px;" class="fa fa-info-circle"></i>
                    <span style="color:#ff8282;">${msg}</span>
                </div>
            </div>
        `;
        $('#response_message').html(output);
        $('#response_message').show();
    }

   


    let hollyc = document.getElementById('hollym');
    hollyc.addEventListener('click', function(e){
        e.preventDefault();
         Swal.fire({
            title: 'Go to app to watch free hollywood movies',
            showCancelButton: true,
            confirmButtonText: 'Ok',
        }).then((result) => {
            /* Read more about isConfirmed, isDenied below */
            if (result.isConfirmed) {
            window.location.href="https://play.google.com/store/apps/details?id=com.ini.niiflicks";
            }
            // } else if (result.isDenied) {
            // Swal.fire('Changes are not saved', '', 'info')
            // }
        })
    })
    
    //console.log(trailer,pics,dexc);

    //fb share link
    // https://www.facebook.com/sharer.php?u=[post-url]
    //twiter share link
    // https://twitter.com/share?url=[post-url]&text=[post-title]
    //linkedin
    //https://www.linkedin.com/shareArticle?url=[post-url]&title=[post-title]
     //add social shares js
 
    //  $('meta[property="og:description"]').attr('content', dexc);
    //  document.querySelector('meta[property="og:description"]').setAttribute("content", dexc);
    //  document.querySelector('meta[property="og:image"]').setAttribute("content", `localhost/niiflicks.com/niiflicks/directors${pics}`);
    // var link = document.createElement('meta');
    // link.setAttribute('property', 'og:description');
    // link.content = dexc;
    // document.getElementsByTagName('head')[0].appendChild(link);
     // document.getElementsByTagName('meta')["og:description"].content = "My new page description!!";
     // $("meta[property='og:image']").attr("content", pics);
            
     //document.querySelector('meta[property="og:description"]').setAttribute("content", dexc);
    //$('meta[property="og:description"]').attr('content', dexc);


}
