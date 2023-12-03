
$(document).ready(function() {
    // alert('JQuery init');
});

document.getElementById('ccn').addEventListener('input', function (e) {
    var input = e.target;
    var trimmed = input.value.replace(/\s+/g, ''); // Видалення пробілів
    var digits = trimmed.replace(/\D/g, '');
    var formatted = '';
    for (var i = 0; i < digits.length; i++) {
        if (i > 0 && i % 4 === 0) {
            formatted += ' ';
        }
        formatted += digits[i];
    }
    input.value = formatted;
});
var selection = window.getSelection();





// const stripe = Stripe('pk_test_51OBw0AJcybMk0KW9RRCCBjEfg24oMedbMvcPf9wevuHuIicvsnet4ikPlltNcZhf52iw27NBQgDBkkXc01SEpvoi008JlPdTg5');
// const elements = stripe.elements();
// const cardElement = elements.create('card');
// cardElement.mount('#card-element');
// const paymentForm = document.getElementById('payment-form'); 


// clientSecret = document.getElementById('client-secret').value;

// $(document).ready(function() {
//     paymentForm.addEventListener('submit', function(event) {
//     event.preventDefault();
//         stripe.createToken(cardElement).then(function(result) {
//             if (result.error) {
//                 // Обробка помилки при отриманні токену
//                 console.error(result.error);
//             } else {
//                 // Отримання токену та передача його на сервер
//                 var token = result.token.id;
//                 input = $("payment-form").append($('<input type="hidden" name="stripeToken">').val(token));
//                 console.log(input);

//                 $.ajax({
//                     type: 'POST',
//                     url: '../data_processor/design-products.php',
//                     headers: {
//                       stripeToken:token
//                     },
//                     data: {
//                         stripeToken:token
//                     },
//                     success: (response) => {
//                       console.log('successful payment: ', response);
//                     },
//                     error: (response) => {
//                       console.log('error payment: ', response);
//                     }
//                   })

//             }
//          });
//     });
// });




































































































































// paymentForm.addEventListener('submit', function(event) {
//     event.preventDefault();
  

//     stripe.createToken(cardElement).then(function(result) {
//       if (result.error) {
//         // Обробка помилки при отриманні токену
//         console.error(result.error);
//       } else {
//         // Отримання токену та передача його на сервер
//         var token = result.token.id;
    //     console.log(token);
    //    console.log( $("payment-form").append($('<input type="hidden" name="stripeToken">').val(token)));
//        $.post(
//         "../data_processor/design-products.php", /* your route here */
//         { stripeToken: token},
//             function(data) {
//             console.log(data);
//             }
//         )
//         // console.log(token);
//         // $.ajax({ 
//         //     type: 'POST',
//         //     dataType: "json",
//         //     contentType: 'application/json',  
//         //     url: '../data_processor/design-products.php',
//         //     data: JSON.stringify({ token: token }),
//         //     success: function(response) {
//         //       console.log('Дані успішно передано на сервер', response);
//         //     },
//         //     error: function(xhr, status, error) {
//         //       console.error('Помилка при Ajax-запиті:', error);
//         //     }
//         //   });
//         }
//     });
//   });
  
// });











// form.addEventListener('submit', function(event) {
//     event.preventDefault();

//     stripe.createToken(cardElement).then(function(result) {
//         if (result.error) {
//             console.error(result.error);
//         } else {
//             const token = result.token;

//             // Отримайте дані зі форми
//             const formData = new FormData(form);

//             // Додайте токен до об'єкта FormData
//             formData.append('payment_method_token', token.id);

//             // Відправлення токену та інших даних на сервер за допомогою Fetch API
//             fetch('../data_processor/data.php', {
//                 method: 'POST',
//                 body: formData,
//             })
//             .then(response => {
//                 if (!response.ok) {
//                     console.error('Помилка відправки на сервер');
//                 }
//                 // Додаткова логіка, яку ви можете виконати, якщо сервер успішно обробив дані
//             })
//             .catch(error => {
//                 console.error('Помилка відправки на сервер:', error);
//             });
//         }
//     });
// });


















// const button = document.querySelector('.button');
// button.addEventListener('click', function() {
//     // event.preventDefault();
  
//     const url = '../data_processor/data.php';
//     const data = {
//         first_name: "Dima",
//         last_name: "Morykvas",
//         age: 28,
//     }
//     const dataPerson = JSON.stringify(data);

//     console.log(dataPerson);
//     fetch(url, {
//         method: "POST",
//         headers: {
//             'Content-Type': 'Content-Type:application/json;  charset=utf-8'
//         },
//         body: dataPerson, 
//     })
//     .then(function(response){
//         return response.text();
//     })  
//     .then(function(data) {
//         console.log(data);
//     })
//     .catch(error => console.error('Помилка відправки запиту:', error));
    
// });



////   TOKEN 

// form.addEventListener('submit', function(event) {
//     event.preventDefault();
    
//     stripe.createToken(cardElement).then(function(result) {
//         if (result.error) {
//             console.error(result.error);
//         } else {
//             const token = result.token;
//             // console.log(token.id);/
    
//             // Відправлення токену на сервер за допомогою Fetch API
            
//                 fetch('../data_processor/data.php', {
//                     method: 'POST',
//                     headers: {
//                         'Content-Type': 'application/json',
//                     },
//                     body: JSON.stringify({
//                         payment_method: token.id,
//                     }),
//                 })
//                 console.log(token.id)
//                 .then(response => {
//                     if (!response.ok) {
//                         console.error('Помилка відправки токену на сервер');
                    
//                     }
//                     return response.json(); // Повертаємо об'єкт JSON з сервера
//                 })
//                 .then(data => {
//                     console.log(data);
//                     // Додайте код для обробки відповіді від сервера, якщо потрібно
//                 })
//                 .catch(error => {
//                     console.error('Помилка відправки токену на сервер:', error);
//                 });
//         }
//     });




// form.addEventListener('submit', function(event) {
// event.preventDefault();
// stripe.createToken(cardElement).then(function(result) 
// {
//     if (result.error) {
//       console.error(result.error);
//     } else {
//       // Отриманий токен
//       console.log('ТОКЕН ВІДПРАВЛЕНИЙ В ОБРОБНИК');
      
//       const token = result.token;
//       console.log(token);

//       // Відправлення токену на сервер за допомогою Fetch API
//       fetch('../data_processor/data.php', {
//         method: 'POST',
//         headers: {
//           'Content-Type': 'application/json',
//         },
//         body: JSON.stringify({
//             //  token: token.id
//             payment_method_token: token.id,
//         }),
//       })
//       .then(response => {
//         if (!response.ok) {
//           console.error('Помилка відправки токену на сервер');
//         }
//         // Додаткова логіка, яку ви можете виконати, якщо сервер успішно обробив токен
//       })
//       .catch(error => {
//         console.error('Помилка відправки токену на сервер:', error);
//       });
//     }

//   });






















//   // Викликати stripe.createToken для отримання токену платіжного методу
//   stripe.createToken(cardElement).then(function(result) {

//     if (result.error) {
//         // Обробка помилки при отриманні токена
//         console.error(result.error);
//       } else {
//         // Доступ до токена
//         var token = result.token;
        
//         // Вивід деяких даних з токена
//         console.log('Card brand: ', token.card.brand);
//         console.log('Last 4 digits: ', token.card.last4);
//         console.log('Expiration month: ', token.card.exp_month);
//         console.log('Expiration year: ', token.card.exp_year);
        
//         // Ваша логіка для використання отриманих даних
//       }

//     });
    

// });




