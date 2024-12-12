//eats and treats javascript

//display current copyright year
let currentYear = new Date();

  function currentDate(currentYear) {
	let copyrightYear = currentYear.getFullYear();
	document.querySelector(".copyrightYear").innerHTML = copyrightYear;
}

currentDate(currentYear);

let nav = document.querySelector(".navigationBar nav");

function displayMobileNav() {
	//alert("inside displayMobileNav()");
	//console.log(nav);
	if (nav.style.display === "block") {
		nav.style.display = "none";
	}
	else {
		nav.style.display = "block"
	}
}