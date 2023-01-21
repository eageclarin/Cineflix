function togglePW(){
  document.querySelector('.eye').classList.toggle('slash');
  var password = document.querySelector('[name=password]');
  
  if(password.getAttribute('type') === 'password'){
    password.setAttribute('type', 'text');
  } else {
    password.setAttribute('type', 'password');
  }
}