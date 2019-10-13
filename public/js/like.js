var postId = 0;

$('.like').on('click', function (event) {
   event.preventDefault();
   postId = event.target.parentNode.dataset['postId'];
   var isLike = event.target.previousElementSibling == null;
   $.ajax({
       method: 'POST',
       url:urlLike,
       data:{
           isLike:isLike,
           postId:postId,
           _token:token,
       },
       success:(
           function (ans) {
               console.log(ans);
               event.target.innerText = isLike ? event.target.innerText === 'Мне нравится' ?
                   'Вам понравилось' : 'Мне нравится' :
                   event.target === 'Мне не нравится' ?
                       'Вам не понравилось' : 'Мне не нравится';
               if (isLike) {
                   event.target.nextElementSibling.innerText = 'Мне не нравится';

               } else {
                   event.target.previousElementSibling.innerText = 'Мне понравилось';
               }
           }
       )
   })
});