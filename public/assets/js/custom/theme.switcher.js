"use strict";

var curentTheme = localStorage.getItem('mode');
var dark = document.querySelector('#darkTheme');
var light = document.querySelector('#lightTheme');
var switcher    = document.querySelector('#modeSwitcher');

if(curentTheme) {
  if(curentTheme == 'dark') {
    dark.disabled = !1;
    light.disabled = !0;
    
    //dark colors
    var colors = darkColor;

  }else if(curentTheme == 'light'){
    dark.disabled = !0;
    light.disabled = !1;
  }

  console.log(colors);

  switcher.dataset.mode = curentTheme;

}else{
  if($('body').hasClass('dark')) {
    var colors = darkColor;
    //update localStorage
    localStorage.setItem('mode', 'dark');
  }else{
    //update localStorage
    localStorage.setItem('mode', 'light');
  }
}



function modeSwitch() {
  console.log('abc');
  //check if current theme
  var curentTheme = localStorage.getItem('mode');
  //set current theme
  if(!curentTheme) {
    if($('body').hasClass('dark')) {
      dark.disabled = !1;
      light.disabled = !0;

      //update localStorage
      localStorage.setItem('mode', 'dark');

    }else{
      dark.disabled = !0;
      light.disabled = !1;
      //update localStorage
      localStorage.setItem('mode', 'light');
    }
  }else{
    //check if current theme is not switch mode
    if(curentTheme == 'dark') {
      dark.disabled = !0;
      light.disabled = !1;
      //update localStorage
      localStorage.setItem('mode', 'light');
    }else{
      dark.disabled = !1;
      light.disabled = !0;

      //update localStorage
      localStorage.setItem('mode', 'dark');
    }
  }
}

$('#modeSwitcher').on('click',function (e){
   e.preventDefault();
   modeSwitch();
   location.reload();
});