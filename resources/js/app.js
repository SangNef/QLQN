require('./bootstrap');

document.addEventListener('DOMContentLoaded', function() {
    const receiverId = document.querySelector('input[name="receiver_id"]').value;

    window.Echo.channel('messages.' + receiverId)
        .listen('MessageSent', (event) => {
            const messageContainer = document.querySelector('.mb-0.pb-40.h-full');
            const messageElement = document.createElement('div');
            messageElement.textContent = `${event.message.sender_id}: ${event.message.content}`;
            messageContainer.appendChild(messageElement);
            messageContainer.scrollTop = messageContainer.scrollHeight;
        });

    // Rest of your code...
});

