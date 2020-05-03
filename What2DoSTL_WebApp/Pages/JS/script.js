var check = function() {
    var str = document.getElementById('password').value;
    var count = str.length;
    if (count >= 8){
        document.getElementById('password').style.backgroundColor = '#b8ffbe';
    }
    if (document.getElementById('password').value ==
        document.getElementById('confirm_password').value){
        document.getElementById('message').style.color = 'green';
        document.getElementById('confirm_password').style.backgroundColor = '#b8ffbe';
        document.getElementById('message').innerHTML = 'Password Fields Match';
    } else {
        document.getElementById('message').style.color = 'red';
        document.getElementById('confirm_password').style.backgroundColor = '#faa3a0';
        document.getElementById('message').innerHTML = 'Password Fields Do not Match';
    }
  }