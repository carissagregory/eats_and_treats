//eats and treats javascript

//display current copyright year
let currentYear = new Date();

  function currentDate(currentYear) {
	let copyrightYear = currentYear.getFullYear();
	document.querySelector(".copyrightYear").innerHTML = copyrightYear;
}

currentDate(currentYear);
