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

    function username_determine (){
      let username = getCookie("username");
      console.log(username);
      if (username != "") {
        document.getElementById('logged').style.display = "block";
        document.getElementById("user_name").innerHTML = username;
      } else {
        document.getElementById('logged').style.display = "block";
        document.getElementById("user_name").innerHTML = '???User???';
      }
    }

    function checkCookies() {
      let username = getCookie("username");
      console.log(username);
      if (username != "") {
       
        document.getElementById('logged').style.display = "block";
        document.getElementById("user_name").innerHTML = username;
        

      } else {
        document.getElementById('logged').style.display = "none";
        document.getElementById("user_name").innerHTML = 'User';
        
      }
    }