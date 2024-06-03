const userInput = document.getElementById('userInput');
const sendButton = document.getElementById('send-button');

userInput.addEventListener('input', function() {
  if (userInput.value.trim() !== '') {
    sendButton.classList.add('button-active');
  } else {
    sendButton.classList.remove('button-active');
  }
});

userInput.addEventListener('keydown', function(event) {
  if (event.key === 'Enter') {
    if (userInput.value.trim() !== '') {
      sendMessage();
      sendButton.classList.remove('button-active');
    }
    event.preventDefault();
  }
});

sendButton.addEventListener('click', function() {
    sendButton.classList.remove('button-active');
});


function adjustHeight(textarea) {
    var change=62;
    textarea.style.height = "30px"; 
    if((textarea.scrollHeight)>62){
      textarea.style.height = change + "px";
      change=textarea.scrollHeight;
    }else{
      textarea.style.height = "30px";
    }
  }

function open_popup(){
  const popup=document.getElementById('icon_window');
  popup.style.display='block';
  select_icon();
}

function close_popup(){
  const popup=document.getElementById('icon_window');
  popup.style.display='none';
}

function select_icon(){
  const avatar = document.querySelectorAll("#ai_img");
  const avatarOptionImages = document.querySelectorAll(".icon-option");
  
  avatarOptionImages.forEach(function (option) {
      option.addEventListener("click", function () {
          const newAvatarSrc = option.getAttribute("src");
          avatar.forEach(function (avatar) {
              avatar.setAttribute("src", newAvatarSrc);
          });
      });
  });
}

function open_popup(){
  const popup=document.getElementById('icon_window');
  popup.style.display='block';
  select_icon();
}

function close_popup(){
  const popup=document.getElementById('icon_window');
  popup.style.display='none';
}

function select_icon(){
  const avatar = document.querySelectorAll("#ai_img");
  const avatarOptionImages = document.querySelectorAll(".icon-option");
  
  avatarOptionImages.forEach(function (option) {
      option.addEventListener("click", function () {
          const newAvatarSrc = option.getAttribute("src");
          avatar.forEach(function (avatar) {
              avatar.setAttribute("src", newAvatarSrc);
          });
      });
  });
}

function display_history(){
  const popup=document.getElementById('history_window');
  popup.style.display='block';
  document.getElementById('date_history').style.display='block';
  
} 

function close_history(){
  const popup=document.getElementById('history_window');
  popup.style.display='none';
  document.getElementById('date_history').style.display='none';
}

// const navToggle = document.getElementById('navToggle');

// navToggle.addEventListener('click', function() {
//   const nav = document.getElementById('Navbar');
//   nav.classList.remove('horizontalNavbar');
//   nav.classList.add('verticalNavbar')
//   if (nav.style.display === 'block') {
//     nav.style.display = 'none';
// } else {
//     nav.style.display = 'block';
// }

// });


// window.addEventListener('resize', function() {
//   const nav = document.getElementById('Navbar');
//   if (window.innerWidth > 950) {
//     nav.style.display = 'flex';
//     nav.classList.remove('verticalNavbar');
//     nav.classList.add('horizontalNavbar');
//   } 
//   if (window.innerWidth <= 950) {
//     nav.style.display = 'none';
//     nav.classList.remove('horizontalNavbar');
//     nav.classList.add('verticalNavbar');
//   }
// });