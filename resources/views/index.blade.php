<script src="https://cdn.socket.io/4.4.0/socket.io.min.js"></script>
<script>
    const socket = io('http://localhost:3000', {
        withCredentials: true
    });
    console.log(socket)
    socket.on('connect', () => {
        const channelName = 'notifications.1'; // Get the relevant channel name dynamically
        socket.emit('auth', {
            channelName
        });
    });

    socket.on('notifications.1', notification => {
        // Display notification
        alert(notification);
    });
</script>
