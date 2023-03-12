$(document).ready( function (){

    $.get('/ajax_get', function (data) {
        for (let i = 0; i < data.length; i++) {
            $("#desc").append(
                '<div class="comm">' +
                '<span>' + data[i].owner + '</span>' +
                '<p>' + data[i].desc + '</p>' +
                '</div>'
            );
        }
    })

    let block = document.getElementsByClassName('disclosure');
    for (let i = 0; i < block.length; i++){
        block[i].addEventListener('click', function() {
            this.classList.toggle('active');
            let content = this.nextElementSibling;
            if (content.style.maxHeight) {
                content.style.maxHeight = null;
            } else {
                content.style.maxHeight = content.scrollHeight + 'px';
            }
        });
    }

        $('#sub').click(function(){
            let comment = $('.add_comment').val();
            $.ajax({
                url: '/description_add',
                type: 'POST',
                data: {comment: comment},
                beforeSend: function (){

                },
                success: function(data){

                },
                error: function (){

                },
                complete: function() {
                    $("#desc").empty()
                    $.get('/ajax_get', function (data) {
                        for (let i = 0; i < data.length; i++) {
                            $("#desc").append(
                                '<div class="comm">' +
                                '<span>' + data[i].owner + '</span>' +
                                '<p>' + data[i].desc + '</p>' +
                                '</div>'
                            );
                        }
                    })
                }
            });
        });


});

