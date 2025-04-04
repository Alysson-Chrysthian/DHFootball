import '../bootstrap';

const messageDisplay = document.querySelector('.messages-display');
const chat = document.querySelector('.chat');
const contactId = chat.dataset.contact_id;
const emptyChat = document.querySelector('#empty-chat');

Echo.channel(`send.message.${contactId}`)
    .listen('.SendMessage', (e) => {
        
        if (emptyChat)
            emptyChat.remove();

        messageDisplay.innerHTML += `
            <div 
                class="
                    message recieved
                "
            >
                <p>${e.message}</p>
                <p>${e.sentAt}</p>
            </div>
        `;

    });