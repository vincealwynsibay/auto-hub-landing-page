// Dual Slider
const rangeInput = document.querySelectorAll('.range-input input'),
  rangeDisplay = document.querySelectorAll('.range-display span'),
  range = document.querySelector('.slider .progress');

// dom loaded

range.style.left = (rangeInput[0].value / rangeInput[0].max) * 100 + '%';
range.style.right = 100 - (rangeInput[1].value / rangeInput[1].max) * 100 + '%';
let priceGap = 10000;
rangeInput.forEach((input) => {
  input.addEventListener('input', async (e) => {
    let minVal = parseInt(rangeInput[0].value),
      maxVal = parseInt(rangeInput[1].value);

    rangeDisplay[0].textContent = '₱' + new Intl.NumberFormat().format(minVal);
    rangeDisplay[1].textContent = '₱' + new Intl.NumberFormat().format(maxVal);
    console.log(minVal, maxVal, priceGap, maxVal - minVal);
    if (maxVal - minVal < priceGap) {
      console.log('nice1');
      if (e.target.className === 'range-min') {
        console.log('nice2');
        console.log(maxVal - priceGap);
        rangeInput[0].value = maxVal - priceGap;
      } else {
        console.log('nice3');
        console.log(minVal - priceGap);
        rangeInput[1].value = minVal + priceGap;
      }
    } else {
      range.style.left = (minVal / rangeInput[0].max) * 100 + '%';
      range.style.right = 100 - (maxVal / rangeInput[1].max) * 100 + '%';
    }
  });
});

// FORM
const searchForm = document.getElementById('searchForm');

searchForm.addEventListener('submit', function (event) {
  event.preventDefault();
  const make = document.getElementById('make').value;
  const sortBy = document.getElementById('sortby')
    ? document.getElementById('sortby').value
    : '';
  const transmission = document.getElementById('transmission').value;
  const fuel_type = document.getElementById('fuel_type').value;
  const minVal = document.getElementById('minVal').value;
  const maxVal = document.getElementById('maxVal').value;

  const queryParams = new URLSearchParams();
  if (sortBy) queryParams.append('sortBy', sortBy);
  queryParams.append('make', make);
  queryParams.append('transmission', transmission);
  queryParams.append('fuel_type', fuel_type);
  queryParams.append('min', minVal);
  queryParams.append('max', maxVal);

  const actionURL = 'Catalog.php' + '?' + queryParams.toString();

  searchForm.action = actionURL;

  searchForm.submit();
});
