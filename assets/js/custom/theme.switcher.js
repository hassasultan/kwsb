"use strict";

// Force light mode by default - no theme switching
var dark = document.querySelector('#darkTheme');
var light = document.querySelector('#lightTheme');

// Always enable light theme and disable dark theme
if (dark && light) {
    dark.disabled = true;
    light.disabled = false;
}

// Set localStorage to light mode
localStorage.setItem('mode', 'light');

// Remove any existing mode switcher functionality
// No mode switching allowed - always light mode