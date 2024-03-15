// set variables  
var xs;
var sm;
var md;
var lg;
var xl;
var breakpoint;

// Checks if the span is set to display lock via CSS
function checkIfBlock (target) {
    var target = $(target).css('display') == 'block';
    return target;
}

// function to check the sizes
function checkSize (){
  // Set some variables to use with the if checks below

	xs = checkIfBlock('.breakpoint-check .xs');
	sm = checkIfBlock('.breakpoint-check .sm');
	md = checkIfBlock('.breakpoint-check .md');
	lg = checkIfBlock('.breakpoint-check .lg');
	xl = checkIfBlock('.breakpoint-check .xl');


	// add the breakpoint to the console
	console.clear();
	if( xs == true) {
		breakpoint = "xs - <576px";
		$("body").removeClass('xs sm md lg xl').addClass( "xs" );
	} 

	if( sm == true) {
		breakpoint = "sm - ≥576px";
		$("body").removeClass('xs sm md lg xl').addClass( "sm" );
	} 

	if( md == true) {
		breakpoint = "md - ≥768px";
		$("body").removeClass('xs sm md lg xl').addClass( "md" );
	} 

	if( lg == true) {
		breakpoint = "lg - ≥992px";
		$("body").removeClass('xs sm md lg xl').addClass( "lg" );
	} 

	if( xl == true) {
		breakpoint = "xl - ≥1200px";
		$("body").removeClass('xs sm md lg xl').addClass( "xl" );
	} 

} 

// Reload demo on  window resize
$( window ).resize( function(){
	checkSize();
});