importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-app.js');
importScripts('https://www.gstatic.com/firebasejs/8.3.2/firebase-messaging.js');

 firebase.initializeApp({
    apiKey: "AIzaSyCYaWaObPCQB4vQMkEqQWSTYO1xzkMb-go",
    authDomain: "fireweb-77595.firebaseapp.com",
    projectId: "fireweb-77595",
    storageBucket: "fireweb-77595.appspot.com",
    messagingSenderId: "766761227624",
    appId: "1:766761227624:web:ba65e52041b351d30db2dd"
});

const messaging = firebase.messaging();
	messaging.setBackgroundMessageHandler(function(payload) {
    console.log(
        "[firebase-messaging-sw.js] Received background message ",
        payload,
    );
        
    const notificationTitle = "Background Message Title";
    const notificationOptions = {
        body: "Background Message body.",
        icon: "/itwonders-web-logo.png",
    };
  
    messaging.onMessage(function (payload) {
        const title = payload.notification.title;
        const options = {
            body: payload.notification.body,
            icon: payload.notification.icon,
        };
        new Notification(title, options);
    });

    return self.registration.showNotification(
        notificationTitle,
        notificationOptions,
    );
});