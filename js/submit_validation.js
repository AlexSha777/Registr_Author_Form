$(document).ready(function(){

  var login = '';
  var password = '';
  var password_conf = '';
  var email = '';
  var name = '';

  $('#btn').click(function(){
    login = $('#login').val();
    password = $('#password').val();
    password_conf = $('#password_conf').val();
    email = $('#email').val();
    name = $('#name').val();
    console.log(login);
    console.log(password);
    console.log(password_conf);
    console.log(email);
    console.log(name);

    if (login =='') {
      $('#login_error').html('<font color="red">Введите данные</font>');
    } else {
      $('#login_error').html('');
    }

    if (password == '') {
      $('#password_error').html('<font color="red">Введите данные</font>');
    } else {
      $('#password_error').html('');
    }

    if (password_conf == '') {
      $('#passwordconf_error').html('<font color="red">Введите данные</font>');
    } else {
      $('#passwordconf_error').html('');
    }
      
    if (email == '') {
      $('#email_error').html('<font color="red">Введите данные</font>');
    } else {
      $('#email_error').html('');
    }
    if (name == '') {
      $('#name_error').html('<font color="red">Введите данные</font>');
    } else {
      $('#name_error').html('');
    }
     

    if (login !='' && password != '' && password_conf != '' && email != '' && name != '') {
      $.ajax({
            type:"POST",
            url:'registration_page.php',
            data:{'login':login, 'password':password, 'password_conf':password_conf, 'email':email, 'name':name},
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
                
                if (JSON.parse(res).passwoedconf_error!='') {
                  $('#passwordconf_error').html(JSON.parse(res).passwordconf_error);
                } else {
                  $('#passwordconf_error').html('');
                }

                
                if (JSON.parse(res).email_error!='') {
                  $('#email_error').html(JSON.parse(res).email_error);
                } else {
                  $('#email_error').html('');
                }
                
                if (JSON.parse(res).name_error!='') {
                  $('#name_error').html(JSON.parse(res).name_error);
                } else {
                  $('#name_error').html('');
                }
                
            } else { 
                console.log(JSON.parse(res));
                window.location.href = 'authorization.php';
            }
        }).fail(function() { 
            console.log('Ошибка выполнения запроса!');
        });
    }
  });

});