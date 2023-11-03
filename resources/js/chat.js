import './app.js';

const idUser = document.querySelector('meta[name="user-id"]').getAttribute('content');

Pusher.logToConsole = true;

var channel = pusher.subscribe(`user.${idUser}`);
channel.bind('new.message', function (data) {
    axios.get('/api/user/' + data.message.sender_id)
        .then(res => {
            console.log(res.data);
            // const node1 = document.createElement('li');
            // const node2 = document.createElement('strong').innerHTML = res.data.name;
            // const node3 = document.createElement('span').innerHTML = data.message.message;
            // node1.appendChild(node2);
            // node1.appendChild(node3);
            // document.querySelector('#chat-history').appendChild(node1)
        })
        .catch(err => {
            console.log(err);
        });
});

