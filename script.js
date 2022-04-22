var checkExist = setInterval(function() {
    if ($('#readmore').length) {
        $("#readmore").click(function() {
            console.log("button clicked")
            $(".content").slideToggle("fast");
            $(this).toggleClass("open");
        
            if ($(this).hasClass("open")) {
                $(this).html("Read less...");
            } else {
                $(this).html("Read more...");
            }
        })
       clearInterval(checkExist);
    }
}, 100); // Had to use an interval because for some reason jQuery declines to wait until an element exists before adding an onclick function, so this bodge to fix that.

function errorHandler() {
  setTimeout(function() {
    window.location = '/';
  }, 5000);
}

function historyBackWFallback() {
    const prevPage = window.location.href;

    window.history.go(-1);

    setTimeout(function(){ 
        if (window.location.href == prevPage) {
            window.location.href = "https://weerstand.lucangevare.nl";
        }
    }, 500);
}

function changeTitle(message) {
  document.title = "Error - Petitie";
  var existFunc = setInterval(function() {
    if (!(document.getElementById("extra-info") === null)) {
      document.getElementById("message").innerText = "Er is iets foutgegaan... Probeer het alstublieft opnieuw!"
      const extraInfo = document.getElementById("extra-info");
      extraInfo.style.display = "block";
      extraInfo.innerHTML = `U wordt in 5 seconden teruggestuurd.`;
      if (message.startsWith("Duplicate entry")) {
        extraInfo.innerHTML += "<br/>U hebt de petitie al ondertekend!"
      }
      console.log(message);

      clearInterval(existFunc);
      errorHandler();
    }
  }, 100);
}

function acceptCookies() {
  document.body.style.opacity = 1;
  document.body.style.backgroundColor = "transparent";
  window.localStorage.setItem("cookieconsent", true);
  var date = new Date();
  date.setTime(date.getTime()+365*24*60*60*1000);
  document.cookie += `;cookieconsent=TRUE;expires=${date.toUTCString()};path=/`; //See https://www.quirksmode.org/js/cookies.html for how annoying document.cookies work; I will continue to use it for this purpose though, so if for some reason window.localStorage doesn't work, I always have a fallback method
  document.getElementById("cookieModal").remove();
}

window.addEventListener("load", function() {
  if (!Boolean(document.cookie.split(";").length) || Boolean(window.localStorage.length)) { //Because obviously PHPSESSID exists
    document.getElementById("cookieModal").remove();
  }
})

function refreshCaptcha(){
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}