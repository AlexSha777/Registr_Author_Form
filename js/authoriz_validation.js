$(document).ready(function(){

  var login = '';
  var password = '';

  $('#btn').click(function(){
    login = $('#login').val();
    password = $('#password').val();

    console.log(login);
    console.log(password);

    if (login =='') {
      $('#login_error').html('<font color="red">Введите данные</font>');
    } else if (password == '') {
      $('#password_error').html('<font color="red">Введите данные</font>');
    } else {
    
      $.ajax({
            type:"POST",
            url:'authoriz_page.php',
            data:{'login':login, 'password':password},
      }).done(function(res) {
            console.log('Ответ получен: ', res);
            console.log(JSON.parse(res));
            console.log(JSON.parse(res).success);
            if (JSON.parse(res).success==0) {
                if (JSON.parse(res).login_error!='') {
                  $('#login_error').html(JSON.parse(res).login_error);
                } else {
                  $('#login_error').html('');
                }
                if (JSON.parse(res).password_error!='') {
                  $('#password_error').html(JSON.parse(res).password_error);
                } else {
                  $('#password_error').html('');
                }
            } else {
                console.log(JSON.parse(res));
                window.location.assign('index.html');
            }
        }).fail(function() { // если ошибка передачи
            console.log('Ошибка выполнения запроса!');
        });
    }
  });

});