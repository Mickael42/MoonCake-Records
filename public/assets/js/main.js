
var stripe = Stripe('pk_test_3srX38B57yuBISFbxJL4bBru00LGXsaU9o');
var elements = stripe.elements();

// Custom styling can be passed to options when creating an Element.
// (Note that this demo uses a wider set of styles than the guide below.)
/* var style = {
    base: {
      color: '#32325d',
      fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
      fontSmoothing: 'antialiased',
      fontSize: '16px',
      '::placeholder': {
        color: '#aab7c4'
      }
    },
    invalid: {
      color: '#fa755a',
      iconColor: '#fa755a'
    }
  }; */

var elements = stripe.elements();
var cardElement = elements.create('card');
cardElement.mount('#card-element');


var cardholderName = document.getElementById('cardholder-name');
var cardButton = document.getElementById('card-button');
var clientSecret = cardButton.dataset.secret;

cardButton.addEventListener('click', function (ev) {
  stripe.handleCardPayment(
    clientSecret, cardElement, {
    payment_method_data: {
      billing_details: { name: cardholderName.value }
    }
  }
  ).then(function (result) {
    if (result.error) {
      var errorElement = document.getElementById('card-errors');
      errorElement.textContent = result.error.message;
    
    }  else {
   
    }
  });
});
