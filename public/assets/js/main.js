
var stripe = Stripe('pk_test_3srX38B57yuBISFbxJL4bBru00LGXsaU9o');
var elements = stripe.elements();

var elements = stripe.elements();
var cardElement = elements.create('card');
cardElement.mount('#card-element');


var cardholderName = document.getElementById('cardholder-name');
var cardButton = document.getElementById('card-button');
var cardError = document.getElementById('card-errors');
var cardSuccess = document.getElementById('card-success');
var clientSecret = cardButton.dataset.secret;
var checkBox = document.getElementById('legal-notice');



cardButton.addEventListener('click', function (ev) {
  if (checkBox.checked === false) {
    return cardError.innerHTML = 'Veuillez  accepter les conditions de vente';
  } else if (cardholderName.value === "") {
    return cardError.innerHTML = 'Veuillez  préciser votre nom';
  } else {
    cardError.innerHTML = '';
    stripe.handleCardPayment(
      clientSecret, cardElement, {
      payment_method_data: {
        billing_details: { name: cardholderName.value }
      }
    }
    ).then(function (result) {
      if (result.error) {
        return cardError.innerHTML = result.error.message;
      } else {
        cardSuccess.innerHTML = 'Paiment en cours...';
        let idOrder = document.getElementById('id-order').value;
        window.location.pathname = '/confirmation/' + idOrder
      }
    });

  }

});
