importScripts('https://www.gstatic.com/firebasejs/8.10.1/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.10.1/firebase-messaging.js');


firebase.initializeApp({
    apiKey: "AIzaSyDJqegX0LIbDcWXzBQNDu8kMUmlHOGMdxA",
    projectId: "test-app-2831e",
    messagingSenderId: "160329246652",
    appId: "1:160329246652:web:3d7ce24af4e0fc360d2db9"
});

const messaging = firebase.messaging();

messaging.onBackgroundMessage((payload) => {
    console.log('Received background message ', payload);
    // Customize notification here
    const notificationTitle = payload.data.title;
    const notificationOptions = {
        body: payload.data.body,
        // icon: '/firebase-logo.png'
    };
    self.registration.showNotification(notificationTitle,
        notificationOptions);
});
