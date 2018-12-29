var api_base = 'https://api.betterplace.org/de/api_v4/projects/';

var myId = 64343;

project_ids = [
  64408,
  64343,
  64472,
  64206,
  64311,
  64457,
  64486,
  10903,
  64439,
  64476,
  35021,
  49073,
  64480,
  1536,
  64186,
  64364,
  64474
];

previous_donations = [
  0,
  0,
  55,
  50,
  0,
  0,
  0,
  31,
  0,
  0,
  17990,
  0,
  0,
  5885,
  0,
  0,
  0
];

function getDonatedAmount(p_id) {
  return fetch(api_base + p_id, { method: 'GET', mode: 'cors' })
    .then(d => d.json())
    .then(d => d.donated_amount_in_cents / 100);
}

async function getCurrentStanding() {
  values = await Promise.all(project_ids.map(p_id => getDonatedAmount(p_id)));

  donations = values.map((v, i) => {
    return { id: project_ids[i], donation: v - previous_donations[i] };
  });
  donations.sort((a, b) => b.donation - a.donation);

  let idx = donations.findIndex(d => d.id === myId);
  let amount = donations[idx].donation;
  let diff = 0;
  if (idx === 0) {
    diff = amount - donations[1].donation;
  } else {
    // diff = donations[idx - 1].donation - amount;
    diff = donations[0].donation - amount;
  }

  result = {
    place: idx + 1,
    amount: amount,
    difference: diff
  };
  // console.log(result);
  return result;
}

function bplace_main() {

	r = getCurrentStanding();
	r.then(res => {
  		document.querySelector('.result').style.display = 'block';
  		document.querySelector('.placeholder').style.display = 'none';

  		document.querySelector('.amount-value').textContent = res.amount + ' EUR';
  		document.querySelector('.place-value').textContent = res.place + '. Platz';
  		if (res.place === 1) {
    			document.querySelector('.diff-negative').style.display = 'none';
  		} else {
    			document.querySelector('.diff-positive').style.display = 'none';
  		}

  		if (res.place === 1) {
    			document.querySelector('.result').classList.add('myGreen');
  		} else if (res.place < 5) {
    			document.querySelector('.result').classList.add('myYellow');
  		} else {
    			document.querySelector('.result').classList.add('myRed');
  		}

  		Array.from(document.querySelectorAll('.diff-value')).forEach(
    			d => (d.textContent = res.difference + ' EUR')
  		);
	}).catch(e => console.log(e));
}

// bplace_main()
