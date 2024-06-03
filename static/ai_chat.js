
let isTrue = true;

function init(){
    fetch('auto_clean_history.php', {
        method: 'get', 
    })
    const dateChatDiv = document.getElementById('date_chat');
    const today = new Date();
  
    for (let i = 0; i < 7; i++) {
        const date = new Date();
        date.setDate(today.getDate() - i);

        const dateButton = document.createElement('button');
        dateButton.value = date.toLocaleDateString()
        
        dateButton.innerHTML = i === 0 ? 'Today' : date.toDateString();
        dateButton.className = 'date_button'; 
        if (i === 0) {
            dateButton.classList.add('active');
        }
        dateButton.onclick = function() {
        ChatHistory(this.value);
        close_history()
        };
        dateChatDiv.appendChild(dateButton);
    }
    ChatHistory(today.toLocaleDateString());
    dateButtons = document.querySelectorAll('.date_button');
    dateButtons.forEach(function(button) {
    button.addEventListener('click', function() {

        dateButtons.forEach(function(btn) {
            btn.classList.remove('active');
        });

        this.classList.add('active');
    });
});

    
}
function getCookie(name) {
    let cookies = document.cookie;
    let parts = cookies.split(name + "=");
    if (parts.length == 2) {
      return parts.pop().split(";").shift();
    }
    return null;
}

function directMessage(input){
    if (isTrue){
        document.getElementById('userInput').value = input;
        sendMessage();
    }
    
}

async function sendMessage() {
    const userInput = document.getElementById('userInput').value;
    document.getElementById('userInput').value = '';
    document.getElementById('userInput').style.height = "30px";

    const date = new Date();
    const time = date.toLocaleDateString();
    const user = document.getElementById('username').textContent.trim()

    if (!userInput.trim()) {
        return;
    }

    const sampleChat = document.getElementById('sample_display');
    if (sampleChat) {
        let autoMessage = sampleChat.textContent;
        sendMessageToServer(user,time,null,autoMessage);
    }
    
    displayMessage( userInput, "user_message", "user_messages");
    startWaiting();

    let Data = new FormData();
    Data.append('message', userInput);

    await fetch('generate_response.php', {
        method: 'POST', 
        body: Data
    })
    .then(response => response.json())
    .then(data => {
        var reply = data.choices[0].message.content
        stopWaiting();
        displayMessage(reply, "ai_message", "ai_messages");
        sendMessageToServer(user,time,userInput,reply);
    })
    .catch(error => {
        setTimeout(function() {
            console.error('Error:', error);
            if (error.message) {
                displayMessage(error, "ai_message", "ai_messages");
            } else {
                displayMessage('An error occurred', "ai_message", "ai_messages");
            }
            stopWaiting();  
        }, 5000);
        
    });

}

function startWaiting() {
    let dots = '';
    document.querySelector('.hover-element').style.cursor = 'not-allowed';
    document.getElementById('userInput').setAttribute('disabled', true);
    document.getElementById('userInput').style.cursor = 'not-allowed';
    document.querySelectorAll('#boxQuestion').forEach(function (box) {
        box.style.cursor = 'not-allowed';
    });
    document.getElementById('send-button').style.cursor = 'not-allowed';
    
    isTrue = false;

    const chatDiv = document.getElementById('chat');
    const messageElement = document.createElement('div');

    messageElement.id = 'generating-answer';
    messageElement.textContent = 'Generating answers';
    messageElement.className = 'ai_messages';

    chatDiv.appendChild(messageElement);
    chatDiv.scrollTop = chatDiv.scrollHeight;

    animationInterval = setInterval(() => {
        if (dots.length >= 3) {
            dots = '';
        } else {
            dots += '.';
        }
        messageElement.textContent = `Generating answers${dots}`;
    }, 500);
}

function stopWaiting() {
    clearInterval(animationInterval); 
    document.querySelector('.hover-element').style.cursor ='pointer'
    document.getElementById('userInput').removeAttribute('disabled');
    document.getElementById('userInput').style.cursor = 'text';
    document.querySelectorAll('#boxQuestion').forEach(function (box) {
        box.style.cursor = 'pointer';
    });
    isTrue = true;
    document.getElementById('send-button').removeAttribute('style');

    const messageElement = document.getElementById('generating-answer');
    if (messageElement) {
        messageElement.remove(); 
    }
}



function displayMessage(message, messageClass, className, sampleDisplay = false) {
    const chatDiv = document.getElementById('chat');
    const messagesDiv = document.createElement('div');
    messagesDiv.className = className;
    if (sampleDisplay) {
        messagesDiv.id = 'sample_display';
    }

    if (className === "user_messages") {
        const icon = document.createElement('img');
        icon.className = 'user_icon';
        icon.setAttribute('src', 'image/profile.jpg');
        messagesDiv.appendChild(icon);

    }else {
        let img=document.getElementById('ai_img')
        if(img==null){
            let icon = document.createElement('img');
            icon.className = 'ai_icon';
            icon.setAttribute('src', 'image/ai_img/ai_img.jpg');
            icon.setAttribute('id', 'ai_img');
            icon.setAttribute('onclick', 'open_popup()');
            messagesDiv.appendChild(icon);
        }else{
            img = img.cloneNode(true);
            img.className='ai_icon';
            messagesDiv.appendChild(img);
        }
        

    }
    

    const messageDiv = document.createElement('div');
    messageDiv.className = messageClass;
    messageDiv.innerText = message;
    messagesDiv.appendChild(messageDiv);

    chatDiv.appendChild(messagesDiv);

    chatDiv.scrollTop = chatDiv.scrollHeight;
}

function sendMessageToServer(user,date,message,response) {
    let Data = new FormData();

    Data.append('user', user);
    Data.append('date', date);
    Data.append('message', message);
    Data.append('response', response);

    fetch('save_chat.php', {
        method: 'POST', 
        body: Data
    })
    .then(response => console.log(response))
    .catch(error => {
        console.error('Error:', error);
    });

}


async function ChatHistory(date) {
    const chatDiv = document.getElementById('chat');
    var sampleDisplay = false
    const today = new Date().toLocaleDateString();
    const user = document.getElementById('username').textContent.trim();
    if (date === today) {
        sampleDisplay = true
        
    }

    let Data = new FormData();
    Data.append('date', date);
    Data.append('user', user); 

    chatDiv.innerHTML = '';
    fetch('get_chat_history.php', {
        method: 'POST', 
        body: Data
    })
    .then(response => response.json())
    .then(async data => {
        if (data.length === 0 && date === today){
            let yesterday = new Date();
            yesterday.setDate(yesterday.getDate() - 1);
            yesterday = yesterday.toLocaleDateString();
            var recentHistory = await recentChat(user,
                );

            if (recentHistory == null){
                let username = user === "Guest" ? "" : user;
                displayMessage("Hi "+username+"! I'm your personal coach. I can help you achieve your goal. What would you like to talk about today?", "ai_message", "ai_messages", sampleDisplay)
                return;
            }else{
                await summaryHistory(recentHistory,user);
            }

        }

        data.forEach(message => {
            if (message.message != null && message.message != "null") {
                displayMessage(message.message, "user_message", "user_messages")
            }
            displayMessage(message.response, "ai_message", "ai_messages")
        });
    })
}


async function recentChat(user, date) {
    let history = "";
    let Data = new FormData();
    Data.append('date', date);
    Data.append('user', user);

    try {
        const response = await fetch('get_chat_history.php', {
            method: 'POST', 
            body: Data
        });
        const data = await response.json();

        if (data.length === 0) {
            return null;
        }

        data.forEach(message => {
            if (message.message != null) {
                history += message.message + "\n";
            }
        });

        return history;
    } catch (error) {
        console.error('Error fetching chat history:', error);
        return null;
    }
}


async function summaryHistory(history,user){
    

    let Data = new FormData();
    Data.append('history', history);
    Data.append('username', user);


    await fetch('summary_history.php', {
        method: 'POST', 
        body: Data
    })
    .then(response => response.json())
    .then( async data => {
        var reply = data.choices[0].message.content
        displayMessage(reply, "ai_message", "ai_messages", true)
    })



}