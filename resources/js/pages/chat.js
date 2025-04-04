import '../bootstrap';

const chat = document.querySelector('.chat');
const contactId = chat.dataset.contact_id;

Echo.channel(`send.message.${contactId}`)
    .listen('.SendMessage', (e) => {
        console.log(e);
    });