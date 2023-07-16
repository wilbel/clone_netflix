function detectCreditCardBrand(creditCardnumber) {
	var brand = false;
	var cards = [
		{ name: 'visa', gaps: [4, 8, 12], prefixes: '4', cvv: 3 },
		{ name: 'mastercard', gaps:[4, 8, 12], prefixes: '22,23,24,25,26,27,51,52,53,54,55,605,606,6062,6375,6376,63709', cvv:3 },
		{ name: 'amex', gaps: [4, 10],prefixes: '34,37', cvv:4 },
		{ name: 'diners', gaps: [4, 10],prefixes: '36,38,39,300,301,302,303,304,305', cvv:3 },
		{ name: 'cabal', gaps: [4, 8, 12], prefixes: '603,58965,6042,6043,6044', cvv:3 },
		{ name: 'naranja', gaps: [4, 8, 12], prefixes: '5895', cvv:3 },
		{ name: 'maestro', gaps: [4, 8, 12], prefixes: '57,59,67,69,500,503,507,561,581,585,586,600,602,5010,5011,5015,5018,5021,5023,5031,5036,5043,5045,5046,5047,5600,5605,6012,6016,6017,6049,6061,6364,6365,6366,6377,6390,6392,6393,50491,50491,63638,63704,601070', cvv:3}
	];
	var cc = cleanCard(creditCardnumber);
	var prefixes = generatePrefixes(cc);

	// SEARCH CREDIT CARD NUMBER
	prefixes.every(function(prefix) {
		cards.every(function (card) {
			var prefixes = card.prefixes.split(',');
			if (prefixes.indexOf(prefix) !== -1) {
				// FOUND!
				brand = card
				return false; // BREAK LOOP
			}
			return true; // KEEP LOOPING
		});
		return brand === false; // true => keep looping
	});
	return brand;
}

function cleanCard(cardNumber) {
	cardNumber = cardNumber.replace(/[^0-9]/g, '');
	return cardNumber;
}

//	busca por prefijo de 1, 2, 3, 4 y 5 DE LARGO
function generatePrefixes(cardNumber) {
	var prefixes = [];
	var str = cardNumber + ''; // Cast to 'String'
	var loops;
	var len = str.length;
	if (len >= 5) {
		loops = 5; // Take only 5
	} else {
		loops = len; // Take real length (less than 5)
	}
	for (let i = 1; i <= loops; i++) {
		var prefix = cardNumber.substr(0, i);
		prefixes.push(prefix);
	}
	return prefixes;
}
