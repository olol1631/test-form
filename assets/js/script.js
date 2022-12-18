$(function() {
    
    //Авторизация
    $('.input-submit').click(function(e){
        e.preventDefault();

        $('.error').each(function() {
            $(this).addClass('none');
        });

        let login = $('input[name="login"]').val();
        let password = $('input[name="password"]').val();
        console.log(login, password)
        
        let errors = []

        //Проверяем логин
        checkLogin(login, errors)

        //Проверяем пароль
        checkPassword(password, errors)

        //Если ошибок нет, отправляем запрос на сервер
        if(errors.length < 1){
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
        }
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

        let errors = []
        
        //Проверяем имя пользователя
        checkName(name, errors)

        //Проверяем логин
        checkLogin(login, errors)

        //Проверяем email
        checkEmail(email, errors)
        
        //Проверяем пароль
        checkPassword(password, errors)
        checkConfirmPassword(confirm_password, password, errors)

        //Если ошибок нет, отправляем запрос на сервер
        if(errors.length < 1){
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
                        data.forEach(function(el){
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
        }
        
        
    })

    //Изменение данных пользователя
    $('.update-btn').click(function(e){
        e.preventDefault();

        $('.error').each(function() {
            $(this).addClass('none');
        });

        let name = $('input[name="name"]').val();
        let login = $('input[name="login"]').val();
        let email = $('input[name="email"]').val();

        console.log(name, login, email)

        let errors = []

        checkName(name, errors)
        checkLogin(login, errors)
        checkEmail(email, errors)
        
        console.log(errors)

        //Если ошибок нет, отправляем запрос на сервер
        if(errors.length < 1){
            $.ajax({
                url: 'vendor/update.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    name: name,
                    login: login,
                    email: email                                
                },
                success: function(data){
                    if(data.status){
                        document.location.href = '/';
                    }else{
                        data.forEach(function(el){
                            if(el['type'] === 'login'){
                                $('.error-login').removeClass('none').text(el['message']);
                            }
                            if(el['type'] === 'email'){
                                $('.error-email').removeClass('none').text(el['message']);
                            
                            }
                            if(el['type'] === 'name'){
                                $('.error-name').removeClass('none').text(el['message']);
                            }
        
                        })
                    }
                }
            })
        }
    })
    //Изменение пароля
    $('.update-password').click(function(e){
        e.preventDefault();

        $('.error').each(function() {
            $(this).addClass('none');
        });

        let password = $('input[name="password"]').val();
        let new_password = $('input[name="new_password"]').val();
        let confirm_password = $('input[name="confirm_password"]').val();

        console.log(password, new_password, confirm_password)

        let errors = []
        
        checkConfirmPassword(confirm_password, new_password, errors)
        checkPassword(new_password, errors)

        console.log(errors)

        //Если ошибок нет, отправляем запрос на сервер
        if(errors.length < 1){
            $.ajax({
                url: 'vendor/update-password.php',
                type: 'POST',
                dataType: 'json',
                data: {
                    password: password,
                    new_password: new_password,
                    confirm_password: confirm_password
                                                  
                },
                success: function(data){
                    if(data.status){
                        document.location.href = '/';
                    }else{
                        data.forEach(function(el){
                            if(el['type'] === 'old_password'){
                                $('.old-password').removeClass('none').text(el['message']);
                            }
                            if(el['type'] === 'confirm_password'){
                                $('.error-password').removeClass('none').text(el['message']);
                            }
                            if(el['type'] === 'password'){
                                $('.error-password').removeClass('none').text(el['message']);
                            }
        
                        })
                    }
                }
            })
        }
        

    })

    //Функции
    //Проверка имени пользователя
    function checkName(name, errors){
        if(name.match(/[^а-яА-ЯёЁa-zA-Z]/)){
            $('.error-name').removeClass('none').text('Имя пользователя должно состоять только из букв и не может содержать пробелы');
            errors.push('name')
        }
        if(name.length < 2){
            $('.error-name').removeClass('none').text('Имя пользователя должно содержать не менее 2 символов');
            errors.push('name')
        }
        if(name === ''){
            $('.error-name').removeClass('none').text('Заполните поле');
            errors.push('name')
        }
    }

    //Проверка логина
    function checkLogin(login, errors){
        if(login.match(/\s/)){
            $('.error-login').removeClass('none').text('Логин не может содержать пробелы');
            errors.push('login')
        }
        if(login.length < 6){
            $('.error-login').removeClass('none').text('Логин должен содержать не менее 6 символов');
            errors.push('login')
        }
        if(login === ''){
            $('.error-login').removeClass('none').text('Заполните поле');
            errors.push('login')
        }
    }

    //Проверка email
    function checkEmail(email, errors){
        if(email.match(/\s/)){
            $('.error-email').removeClass('none').text('Email не может содержать пробелы');
            errors.push('email')
        }
        if(!email.match(/^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/)){
            $('.error-email').removeClass('none').text('Введите корректный email');
            errors.push('email')
        }
        if(email === ''){
            $('.error-email').removeClass('none').text('Заполните поле');
            errors.push('email')
        }
    }

    //Проверка пароля
    function checkConfirmPassword(confirm_password, password, errors){
        if(confirm_password !== password){
            $('.error-confirm').removeClass('none').text('Пароли не совпадают');
            errors.push('confirm_password')
        }
        if(confirm_password === ''){
            $('.error-confirm').removeClass('none').text('Заполните поле');
            errors.push('confirm_password')
        }
    }
    function checkPassword(password, errors){
        if(password.match(/\s/)){
            $('.error-password').removeClass('none').text('Пароль не может содержать пробелы');
            errors.push('password')
        }
        if(!password.match(/[a-zA-Z]/) || !password.match(/[0-9]/)){
            $('.error-password').removeClass('none').text('Пароль должен содержать буквы латинского алфавита и цифры');
            errors.push('password')
        }
        if(password.match(/[^a-zA-Z0-9]/)){
            $('.error-password').removeClass('none').text('Пароль не может содержать спецсимволы');
            errors.push('password')
        }
        if(password.length < 6){
            $('.error-password').removeClass('none').text('Пароль должен содержать не менее 6 символов');
            errors.push('password')
        }
        if(password === ''){
            $('.error-password').removeClass('none').text('Заполните поле');
            errors.push('password')
        }

    }
})