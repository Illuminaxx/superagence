import Places from 'places.js';
import Map from './modules/map';
import 'slick-carousel';
import 'slick-carousel/slick/slick.css';
import 'slick-carousel/slick/slick-theme.css';

Map.init();

let inputAdress = document.querySelector('#property_address');
if(inputAdress !== null) {
    let place = Places({
        container: inputAdress
    })
    place.on('change', e => {
        document.querySelector('#property_city').value = e.suggestion.city
        document.querySelector('#property_postal_code').value = e.suggestion.postcode
        document.querySelector('#property_lat').value = e.suggestion.latlng.lat
        document.querySelector('#property_lng').value = e.suggestion.latlng.lng    
    })
}

let searchAdress = document.querySelector('#search_address');
if(searchAdress !== null) {
    let place = Places({
        container: searchAdress
    })
    place.on('change', e => {
        document.querySelector('#lat').value = e.suggestion.latlng.lat
        document.querySelector('#lng').value = e.suggestion.latlng.lng    
    })
}



// any CSS you require will output into a single css file (app.css in this case)
require('../css/app.css');

// Need jQuery? Install it with "yarn add jquery", then uncomment to require it.
const $ = require('jquery');

$('[data-slider]').slick({
    dots: true
});
$('select').select2();
let $contactButton = $('#contactButton');
$contactButton.click(e => {
    e.preventDefault();
    $('#contactForm').slideDown();
    $contactButton.slideUp();
})


// Suppression des éléments
document.querySelectorAll('[data-delete]').forEach(a => {
    a.addEventListener('click', e => {
        e.preventDefault()
        fetch(a.getAttribute('href'), {
                method: 'DELETE',
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({
                    '_token': a.dataset.token
                })
            }).then(response => response.json())
            .then(data => {
                if (data.success) {
                    a.parentNode.parentNode.removeChild(a.parentNode)
                } else {
                    alert(data.error)
                }
            })
            .catch(e => alert(e))
    })
})

console.log('Hello Webpack Encore! Edit me in assets/js/app.js');