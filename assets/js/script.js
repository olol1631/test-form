//Авторизация
$('.input-submit').click(function(e){
    e.preventDefault();

    let login = $('input[name="login"]').val();
    let password = $('input[name="password"]').val();
    console.log(login, password)

    $.ajax({
        url: 'vendor/signin.php',
        type: 'POST',
        dataType: 'json',
        data: {
            login: login,
            password: password
        },
        success: function(data){
            if(data.status){
                document.location.href = '/profile.php';
            }else{
                $('.message').removeClass('none').text(data.message);

            }
        }
    })

})

//Регистрация
$('.register-btn').click(function(e){
    e.preventDefault();

    $('.error').each(function() {
        $(this).addClass('none');
    });

    let name = $('input[name="name"]').val();
    let login = $('input[name="login"]').val();
    let email = $('input[name="email"]').val();
    let password = $('input[name="password"]').val();
    let confirm_password = $('input[name="confirm_password"]').val();

    $.ajax({
        url: 'vendor/signup.php',
        type: 'POST',
        dataType: 'json',
        data: {
            name: name,
            login: login,
            email: email,
            password: password,
            confirm_password: confirm_password            
        },
        success: function(data){
            if(data.status){
                document.location.href = '/';
            }else{
                console.log(data)
                console.log('data[0]' + data[0]['type'])
                data.forEach(function(el){
                    console.log(el)

                    if(el['type'] === 'login'){
                        $('.error-login').removeClass('none').text(el['message']);
                    }
                    if(el['type'] === 'email'){
                        $('.error-email').removeClass('none').text(el['message']);
                    }
                    if(el['type'] === 'confirm_password'){
                        $('.error-password').removeClass('none').text(el['message']);
                    }
                    if(el['type'] === 'password'){
                        $('.error-password').removeClass('none').text(el['message']);
                    }
                    if(el['type'] === 'name'){
                        $('.error-name').removeClass('none').text(el['message']);
                    }

                })
            }
        }
    })
})
