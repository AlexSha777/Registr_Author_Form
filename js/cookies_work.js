    function getCookie(cname) {
      let name = cname + "=";
      let ca = document.cookie.split(';');
      for(let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == ' ') {
          c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
          return c.substring(name.length, c.length);
        }
      }
      return "";
    }



    function checkCookies() {
      let username = getCookie("username");
      console.log(username);
      if (username != "") {
       //show <p class="user">
        document.getElementById('logged').style.display = "block";
        document.getElementById("user_name").innerHTML = username;
        document.getElementById('not_logged').style.display = "none";

      } else {
        document.getElementById('logged').style.display = "none";
        document.getElementById("user_name").innerHTML = 'User';
        document.getElementById('not_logged').style.display = "block";
      }
    }