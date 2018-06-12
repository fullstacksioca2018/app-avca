$(document).ready(function(){

  var pathname = window.location.pathname;
  switch (pathname) {
    case '/reportes':
      $('#reportesnav').addClass('active');
      break;
    case '/reportes/panel':
      $('#panelnav').addClass('active');
      break;
    case '/reportes/pronostico':
      $('#panelpronostico').addClass('active');
      break;
  }

});