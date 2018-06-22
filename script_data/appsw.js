// register service worker

if ('serviceWorker' in navigator) {
  //navigator.serviceWorker.register('/Biometrico/sw.js', { scope: '/Biometrico/' }).then(function(reg) {
    
    navigator.serviceWorker.register('https://webbiometric.mohansoft.com/sw.js', { scope: '/Biometrico/' }).then(function(reg) {
    if(reg.installing) {
      console.log('Service worker installing');
    } else if(reg.waiting) {
      console.log('Service worker installed');

    } else if(reg.active) {
      console.log('Service worker active');
      //console.log(globales);
    }

  }).catch(function(error) {
    // registration failed
    console.log(error);
    console.log('Registration failed with ' + error);
  });
}