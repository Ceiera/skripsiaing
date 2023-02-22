<html>
  <head>
    <script src="https://cdn.textalk.com/websocket/v3/textalk-websocket.min.js"></script>
    <style>
      .chat-popup {
        position: fixed;
        bottom: 0;
        right: 0;
        border: 1px solid black;
        width: 300px;
        height: 400px;
        overflow: scroll;
        background-color: white;
        animation: pop-up 0.5s ease-in-out;
      }

      @keyframes pop-up {
        from {
          bottom: -400px;
        }
        to {
          bottom: 0;
        }
      }
    </style>
  </head>
  <body>
    <div class="chat-popup">
      <div id="chat-messages"></div>
      <input type="text" id="chat-input" />
      <button id="chat-send">Send</button>
      <button id="chat-toggle">Toggle Chat</button>
    </div>
    <?= $anu?>
    <script>
      const chatInput = document.getElementById('chat-input');
      const chatSend = document.getElementById('chat-send');
      const chatToggle = document.getElementById('chat-toggle');
      const chatMessages = document.getElementById('chat-messages');
      const chatPopup = document.querySelector('.chat-popup');

      // Connect to the Textalk Web Socket server
      const socket = new Textalk.websocket.socket();

      socket.on('open', () => {
        console.log('Connected to the Textalk Web Socket server');
      });

      socket.on('message', (event) => {
        const message = event.data;
        console.log(`Received message => ${message}`);
        chatMessages.innerHTML += `<p>${message}</p>`;

        // Store the message in the database
        socket.json.call('com.example.chat.store_message', { message: message }).then((result) => {
          console.log(`Stored message in the database with ID => ${result.id}`);
        }).catch((error) => {
          console.error(`Failed to store message in the database => ${error}`);
        });
      });

      chatSend.addEventListener('click', () => {
        const message = chatInput.value;
        console.log(`Sending message => ${message}`);
        socket.send(message);
        chatInput.value = '';
      });

      chatToggle.addEventListener('click', () => {
        if (chatPopup.style.bottom === '0px') {
          chatPopup.style.bottom = '-400px';
        } else {
          chatPopup.style.bottom = '0px';
        }
      });
      
    </script>
  </body>
</html>